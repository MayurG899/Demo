	//bulk delete
	$('#deleteChecked').on('click',function(e){
		e.preventDefault();

		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this data anymore!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel please!",
		  closeOnConfirm: true,
		  closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				//swal("Deleted!", "Your data will be permanently deleted.", "success");
				$('#deleteForm').submit();
			} else {
				// swal("Cancelled", "Your data is safe :)", "error");
				return false;
			}
		});
	});