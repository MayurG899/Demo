    $('[data-click="show-main-image"]').click(function(e) {
        e.preventDefault();
        
        var targetContainer = '[data-id="main-image"]';
        var targetImage = '<img src="'+ $(this).attr('data-url') +'" />';
        var targetLi = $(this).closest('li');
        
        $(targetContainer).html(targetImage);
        $(targetLi).addClass('active');
        $('[data-click="show-main-image"]').closest('li').not(targetLi).removeClass('active');
    });

	var geocoder;
	var map;
	var address = document.getElementById("addressCoordinates").innerHTML;

	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(53.272393, -9.048774);
	  var myOptions = {
		zoom: 18,
		center: latlng,
		mapTypeControl: true,
		mapTypeControlOptions: {
		  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	  if (geocoder) {
		geocoder.geocode({
		  'address': address
		}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
			if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
			  map.setCenter(results[0].geometry.location);

			  var infowindow = new google.maps.InfoWindow({
				content: '<b>' + address + '</b>',
				size: new google.maps.Size(150, 50)
			  });

			  var marker = new google.maps.Marker({
				position: results[0].geometry.location,
				map: map,
				title: address
			  });
			  google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			  });
				var panorama = new google.maps.StreetViewPanorama(
					document.getElementById('pano'), {
					  position: results[0].geometry.location,
					  pov: {
						heading: 34,
						pitch: 10
					  }
					});
				map.setStreetView(panorama);
			} else {
			  alert("No results found");
			}
		  } else {
			  var latlng = new google.maps.LatLng(53.272393, -9.048774);
				var panorama = new google.maps.StreetViewPanorama(
					document.getElementById('pano'), {
					  position: latlng,
					  pov: {
						heading: 34,
						pitch: 10
					  }
					});
				map.setStreetView(panorama);
			
			console.log("Geocode was not successful for the following reason: " + status);
		  }
		});
	  }
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	$("#bookForm").on("submit", function () {
		var capacity = $("#capacity").text();
			capacity = parseInt(capacity);
		var booked_tickets = $('#tickets').val();
			booked_tickets = parseInt(booked_tickets);console.log(capacity);console.log(booked_tickets);
		if (booked_tickets > capacity) {
			$('#categs').text( "You can book max "+ capacity + " tickets!" ).show().fadeOut(4000);
			return false; 
		}
	});