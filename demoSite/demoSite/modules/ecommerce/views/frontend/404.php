<? add_action('be_foot', "init_404")?>
<?
	function init_404()
	{
		echo'
			<script src="'.base_url().'modules/ecommerce/assets/js/libs/modernizr.custom.js"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/plugins/jquery.placeholder.js').'"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/plugins/smoothscroll.js').'"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/404.js').'"></script>		
		';
	}	
?>
<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<!--Adding Media Queries Support for IE8-->
<!--[if lt IE 9]>
  <script src="js/plugins/respond.js"></script>
<![endif]-->
	<div class="page-404">
		<div class="content">
			<div class="inner">
			<div class="block">
			  <span>404</span>
				<p>Sorry... Page not found.</p>
				<a class="btn btn-default" href="<?=base_url()?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Homepage</a>
				<!--  <p><span>OR</span>Try to search site</p>
				  <form class="search-404" method="get" autocomplete="off">
					<input class="form-control" type="text" name="search" placeholder="Search">
					<button type="submit"></button>
				  </form>-->
			</div>
		  </div>
		</div>
	</div>