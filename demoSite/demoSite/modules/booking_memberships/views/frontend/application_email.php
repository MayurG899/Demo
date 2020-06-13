<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<link href="<?=base_url()?>themes/dashboard/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
		<link href="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?=base_url()?>themes/dashboard/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	</head>
	<body>
		<div class="row" style="padding:5px;border:1px solid #000;background:#eee;">
			<h4 class="text-center" style="text-align:center">Application form</h4>
			<div class="col-md-12">
				<?foreach($questionnaire as $key => $val):?>
					<p><b><span class="label label-warning" style="border:1px solid #000;padding:10px;background:#aaa;"><?=ucfirst(str_replace('_',' ',$key))?>:</span></b></p>
					<div class="alert alert-info" style="border:1px solid #aaa;background:lightblue;padding:10px">
						<p><?=$val?></p>
					</div><br/>
				<?endforeach;?>
			</div>
		</div>
	</body>
</html>