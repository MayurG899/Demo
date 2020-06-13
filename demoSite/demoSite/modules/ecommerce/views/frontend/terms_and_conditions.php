<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<div class="content">
	<div class="container">
		<div class="row-fluid">
				<?
				$block1 = new Block("be-ecommerce-terms-and-conditions");
	            $block1->add_css_class('col-lg-12');
	            $block1->set_content("
              	<h2 style="text-align: center">Terms and conditions</h2>
              	<p class="main-meta" style="text-align: center">Quick tour around the BuilderEngine Editing
              	At the bottom of this page in the footer, you will find the EDIT THIS WEBSITE link to log into your website to start editing.
              	To start editing this page, you need to activate the editors - do this by clicking on the "ADMIN" button to the top right of your
              	screen. This will now display an top bar on your screen with editing options. Follow the rest of the quick instructions below or visit the BuilderEngine website for detailed tutorials <a href=\"http://www.builderengine.com\">BuilderEngine Website.</a></p>
            	");
            	$block1->show();
				?>
		</div>
	</div>
</div>