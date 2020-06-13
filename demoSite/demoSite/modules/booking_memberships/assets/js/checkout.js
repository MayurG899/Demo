/**Checkout Calculation**/

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function calculateAddons(chkname,chktype,chkprice,op){
	var reset = 0;
	var basePrice = $('#mPrice').attr('data-price');
	basePrice = parseFloat(basePrice);
	var addonPrice = $('#addon_value').val();
	addonPrice = parseFloat(addonPrice);
	if(op == 'add')
		if(addonPrice == 0.00)
			if(chktype == 'flat')
				addons = (addonPrice + chkprice).toFixed(2);
			else
				addons = ((basePrice * chkprice) / 100).toFixed(2);
		else
			if(chktype == 'flat')
				addons = (addonPrice + chkprice).toFixed(2);
			else
				addons = (addonPrice + ((basePrice * chkprice) / 100)).toFixed(2);
	else
		if(chktype == 'flat')
			addons = (addonPrice - chkprice).toFixed(2);
		else
			addons = (addonPrice - ((basePrice * chkprice) / 100)).toFixed(2);
	if(!$('.addOnChk:checked').length)
		$('#addon_value').val(reset.toFixed(2));
	else
		$('#addon_value').val(addons);
}

function calculateVoucher(option,price){

	var reset = 0;
	var basePrice = $('#mPrice').attr('data-price');
	basePrice = parseFloat(basePrice);

	if(option == 'flat'){
		voucherDiscount = '-' + price.toFixed(2);
	}else{
		voucherDiscount = '-' + ((basePrice * price) / 100).toFixed(2);
	}
	$('#voucher_value').val(voucherDiscount);
}

function calculateUsergroupDiscount(option,price){

	var reset = 0;
	var basePrice = $('#mPrice').attr('data-price');
	basePrice = parseFloat(basePrice);

	if(option == 'flat'){
		usergroupDiscount = '-' + price.toFixed(2);
	}else{
		usergroupDiscount = '-' + ((basePrice * price) / 100).toFixed(2);
	}
	$('#usergroupdiscount_value').val(usergroupDiscount);
}

function calculateSubTotal(){

	var reset = 0;
	var basePrice = $('#mPrice').attr('data-price');
	basePrice = parseFloat(basePrice);
	var addons = 0;
	var voucherDiscount = 0;
	var usergroupDiscount = 0;

	if($('#addon_value').length){
		addons = $('#addon_value').val();
		addons = parseFloat(addons);
	}
	if($('#voucher_value').length){
		voucherDiscount = $('#voucher_value').val();
		voucherDiscount = parseFloat(voucherDiscount);
	}
	if($('#usergroupdiscount_value').length){
		usergroupDiscount = $('#usergroupdiscount_value').val();
		usergroupDiscount = parseFloat(usergroupDiscount);
	}

	var subtotal = (((basePrice + addons) + voucherDiscount) + usergroupDiscount).toFixed(2);
	//$('#sPrice').val(subtotal);
	return subtotal;
}

function calculateVat(){

	if($('#vatPercent').length){
		var subtotal = calculateSubTotal();
		subtotal = parseFloat(subtotal);
		var vatRate = $('#vatPercent').attr('data-percent');
		vatRate = parseFloat(vatRate);
		
		var vat = ((subtotal * vatRate) / 100).toFixed(2);
		return vat;
	}else
		return 0;
}

function calculateTotal(){

	var subtotal = calculateSubTotal();
	subtotal = parseFloat(calculateSubTotal());
	var vat = calculateVat();
	vat = parseFloat(vat);
	
	var total = (subtotal + vat);
	var stripe_total = total;
	subtotal = addCommas(subtotal.toFixed(2));
	vat = addCommas(vat.toFixed(2));
	total = addCommas(total.toFixed(2));

	$('#sPrice').html(subtotal);
	$('#vatAmount').html(vat);
	$('#tPrice').html(total);
	if($('#amount').length)
		$('#amount').val(stripe_total);
}
$(document).ready(function(){

	var start = 0;
	$('#addon_value').val(start.toFixed(2));
	$('#voucher_value').val(start.toFixed(2));
	$('#usergroupdiscount_value').val(start.toFixed(2));

	// AddOns
    $('.addOnChk').change(function(){
		var chkname = $(this).attr('data-name');
        var chktype = $(this).attr('data-type');
		var chkprice = parseFloat($(this).attr('data-price'));
        if($(this).is(":checked"))
			op = 'add';
        else
			op = 'sub';

		calculateAddons(chkname,chktype,chkprice,op);
		calculateTotal();
    });

	//Vouchers
	$('#vouchers').change(function(event){
		$('#voucherError').html(' ');
		$('#voucher_value').val(start.toFixed(2));
		var code_id = $(this).val();
		if($(this).val() == ''){
			$('#voucher_code').val('').css('border', '1px solid #dfd9d9').attr('readonly','readonly');
			$('#voucher_value').val(start.toFixed(2));
		}else
			$('#voucher_code').removeAttr('readonly').val('').css('border', '1px solid #dfd9d9').attr('data-voucher-id',code_id);
		calculateTotal();
	});

	$('#voucher_code').keyup(function(event){
		var membership_id = $('#membership_id').val();
		var voucher_code = $(this).val();
		var voucher_id = $(this).attr('data-voucher-id');
		$.ajax({
			type: 'POST',
			url: site_root + '/booking_memberships/ajax/check_voucher_code/' + membership_id ,
			data: {'voucher_code' : voucher_code, 'voucher_id' : voucher_id},
			success: function(data){
				var data = $.parseJSON(data);
				console.log(data);
				if(data.status == 'true'){
					if(data.expired == 'false'){
						price = parseFloat(data.price);
						calculateVoucher(data.price_opt,price);
						calculateTotal();
						$('#voucherError').html('Code Validated <i class="fa fa-check-circle" style="color:#00acac"></i>');
						$('#voucher_code').addClass('animated flash').css('border','3px solid #00acac').attr('readonly','readonly');
					}else{
						$('#voucherError').html('Voucher Expired <i class="fa fa-times" style="color:red"></i>');
					}
				}else{
					$('#voucherError').html('Wrong code <i class="fa fa-times" style="color:red"></i>');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("Error, status = " + textStatus + ", " + "error thrown: " + errorThrown);
			}
		});
	});

	//Usergroups
	$('#usergroupdiscounts').change(function(event){
		var price = $(this).val();
		var option = $(this).attr('data-option');
		var uid = $('option:selected', this).attr('data-uid');
		if($(this).val() == ''){
			$('#usergroupdiscount_value').val(start.toFixed(2));
		}else{
			price = parseFloat(price);
			calculateUsergroupDiscount(option,price);
		}
		$('#uid').val(uid);
		calculateTotal();
	});
});