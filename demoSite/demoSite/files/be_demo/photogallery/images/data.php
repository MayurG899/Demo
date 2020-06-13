<?php

	$test_user = array(
		'first_name'        => 'John',
		'last_name'         => 'Doe',
		'username'          => 'photo_test_user_123456',
		'password'          => 'password',
		'email'             => 'john_doe_photo123456@johndoe.dom',
		'date_registered'   => time(),
		'avatar'            => base_url().'builderengine/public/img/avatar.png',
		'verified'          => 'yes',
	);
		
	$test_photos = array(
		array(
			str_replace(array(' ','`','"','.'), '_', 'Abstract Wall'),
			'Modern art = I could do that + Yeah, but you didn’t. - Craig Damraeur',
			base_url().'modules/photogallery/assets/test_content/Abstract Wall.jpg',
			'Art, Modern Art, Color, Wall ',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Artist Street Stall'),
			'Everything you can imagine is real - Pablo Picasso',
			base_url().'modules/photogallery/assets/test_content/Artist Street Stall.jpg',
			'Street, Market, Vendor, Stall, Man, Cobblestones, Paintings, Drawings, Color',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Sparkles'),
			'Life is a blank canvas and you need to throw all the paint on it you can. - Danny Kaye',
			base_url().'modules/photogallery/assets/test_content/Sparkles.jpg',
			'Blonde, Girl, Sparklers, Woods, Laughing',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Blue Shades'),
			'The sides of buildings should be like the top of lakes. I would fish through your window hoping to catch a smile. - Jarod Kintz',
			base_url().'modules/photogallery/assets/test_content/Blue Shades.jpg',
			'Sunglasses, Shades, Blue, Street',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Laughing'),
			'You only live once, but if you do it right, once is enough - Mae West',
			base_url().'modules/photogallery/assets/test_content/Laughing.jpg',
			'Tag,Flower,Oldeander,Second,Photo,Gallery,Photo 2',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Colorful Pier'),
			'Light must always win.	- Maurice Smith',
			base_url().'modules/photogallery/assets/test_content/Colorful Pier.jpg',
			'Color, Pier, Sea, Sunset',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Far Horizon'),
			'Though we travel the world over to find the beautiful, we must carry it with us, or we find it not. - Ralph Waldo Emerson',
			base_url().'modules/photogallery/assets/test_content/Far Horizon.jpg',
			'Man, Lake, Mountains, Nature, Sky',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Golden Light'),
			'Art is not what you see, but what you make others see	- Edgar Degas',
			base_url().'modules/photogallery/assets/test_content/Golden Light.jpg',
			'Light, Interior, Sky, Golden, Architecture, Color',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Guy in Jeep'),
			'I travel not to go anywhere, but to go. I travel for travels sake. The great affair is to move - Robert Louis Stevenson',
			base_url().'modules/photogallery/assets/test_content/Guy in Jeep.jpg',
			'Guy, Beard, Sunglasses, Jeep, Travel, Desert',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Hot Silhouette'),
			'You do not take a photograph, you make it - Ansel Adams',
			base_url().'modules/photogallery/assets/test_content/Hot Silhouette.jpg',
			'Hot, Fire, Shadow, Silhouette, Man',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Kiss Me'),
			'Speak softly, but carry a big can of paint - Banksy',
			base_url().'modules/photogallery/assets/test_content/Kiss Me.jpg',
			'Graffiti, Mural, Street, Color, Kiss, Couple, Man, Woman, Sailor,',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Red Heart'),
			'You know you are in love when you cannot fall asleep because reality is finally better than your dreams. - Dr. Seuss',
			base_url().'modules/photogallery/assets/test_content/Red Heart.jpg',
			'Heart, Red, Crayon, Paper, Table, Love',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Red House'),
			'I live in my own little world. But its ok, they know me here - Lauren Myracle',
			base_url().'modules/photogallery/assets/test_content/Red House.jpg',
			'Red, House, Street, Bicycle, Door',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Starry Night'),
			'Imagination will often carry us to worlds that never were. But without it we go nowhere. - Carl Sagan',
			base_url().'modules/photogallery/assets/test_content/Starry Night.jpg',
			'Stars, Man, Color, Cosmos, Nature',
		),
		array(
			str_replace(array(' ','`','"','.'), '_', 'Winding Road'),
			'The journey of a thousand miles begins with a single step - Lao Tzu',
			base_url().'modules/photogallery/assets/test_content/Winding Road.jpg',
			'Road, Desert, Red, Winding, Sky',
		),
	);
	$about_text = 'Lorem ipsum dolor sit amet, putant deleniti pro eu, ea ius ferri euismod. 
		Eum et doctus delicatissimi, sea te dicant fuisset pertinax. At debet oblique omnesque ius.
		Laudem prodesset vix ex. Agam sanctus has ea, liber dicant eam ea, an vis quis incorrupte assueverit.';

?>