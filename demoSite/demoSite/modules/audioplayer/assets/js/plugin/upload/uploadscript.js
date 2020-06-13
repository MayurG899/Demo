$(function(){

    var ul = $('#uploadP ul');

    $('#dropP a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#uploadP').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#dropP'),
		maxNumberOfFiles: 1,
		maxFileSize: 50000000,
		acceptFileTypes: /(\.|\/)(mpeg|mp3|ogg)$/i,
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
		
			if(data.files[0]['type'] != 'audio/ogg' && data.files[0]['type'] != 'audio/mpeg' && data.files[0]['type'] != 'audio/mp3')
				{ 
					alert("Only .ogg, .mp3, and .mpeg file types are allowed."); 
					return; 
				}
			var fors = $('#forsP');

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
           //var jqXHR = data.submit();
			var jqXHR = data.submit().success(function(result, textStatus, jqXHR){

				var json = JSON.parse(result);
				var status = json['status'];

				if(status == 'error'){
					data.context.addClass('error');

					setTimeout(function(){
						data.context.fadeOut('slow');
					},1000);
				}
				else
				{
					$('#dropP').addClass('animated fadeOutUp').fadeOut('slow').remove();
					$('#uploadFormP').fadeIn('slow').show('slow');
					fors.find('#uploadedFileP').val(data.files[0].name);
				}

			});
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});