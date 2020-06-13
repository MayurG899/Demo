<script>
$(document).ready( function () {
  $("#products-order-by").change( 
    function(){ 
      var search = "<?=$search?>";
      if($(this).val() == 0)
        return;
      if(search == true)
        window.location.href = '<?=base_url()?>ecommerce/search/<?=$keyword?>?order=' + $(this).val();
      else
        window.location.href = '<?=base_url()?>ecommerce/category/<?=$keyword?>?order=' + $(this).val();
    } 
  );
});
</script>
<div class="row top-shop-option" style="margin-top: 40px">
    <div class="col-lg-12">
        <select class="pointer fsize13 pull-right" id="products-order-by" style="float:left !important">
            <option value='0'<?if(isset($_GET['order']) && $_GET['order'] == 0) echo 'selected';?>>Sort By</option>
            <option value='1'<?if(isset($_GET['order']) && $_GET['order'] == 1) echo 'selected';?>>Name (A-Z)</option>
            <option value='2'<?if(isset($_GET['order']) && $_GET['order'] == 2) echo 'selected';?>>Name (Z-A)</option>
            <option value='3'<?if(isset($_GET['order']) && $_GET['order'] == 3) echo 'selected';?>>Price (Low-High)</option>
            <option value='4'<?if(isset($_GET['order']) && $_GET['order'] == 4) echo 'selected';?>>Price (High-Low)</option>
        </select>
    </div>
</div>