<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<script>
$(document).ready(function(){
    $('.department-li').click(function(){
        $('.custom-child-subcategories').find('.active').removeClass('active');
    });
});
</script>
<div class="classifieds-top-bar">
<div class="breadcrumb-row">
	<div class="container classifieds">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <ol class="be-breadcrumb">
                <li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
                <li><a href="<?=base_url('/classifieds/profile/'.$member->id)?>"><?=$member->username?></a></li>
                <li class="active" style="pointer-events: none"><a href="#">Inbox Messages</a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename"> 
			<h2>Inbox Messages</h2>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<?$search = new Block('be_classifieds_search_section')?>
			<?$search->set_type('classifieds_search_section');?>
			<?$search->add_css_class('no-float-left');?>
			<?$search->show();?>
        </div>
    </div>
	</div>
</div>

<div class="container classifieds">
    
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="sidebar">    
                <div class="">
                    <div class="col-sm-12">
                        <?$user_panel = new Block('be_classifieds_category_user_panel_v1');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
				
            </div>        
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pull-right listings">
            <h3 class="classifieds-search-results-margin30">Send Message</h3>
            <form method="post">
                <input type="hidden" class="form-control" name="username" placeholder="Username" <?if (isset($username)) echo 'value="'.$username.'"';?> required>                                     
                <div class="form-group">
                    <label>Message:</label>
                    <textarea class="form-control" name="content" placeholder="Write your message to the Seller. Note: Abusive messages will not be tolerated and will result in your account being deleted." style="height:130px" required></textarea>
                </div>
                <?if(isset($_GET['item']) && $_GET['item'] != '0' && $_GET['item'] != ''):?>
                    <?$item = new ClassifiedsItem($_GET['item'])?>
                    <p style="margin-bottom: 15px">Product of interest: <a href="<?=base_url('classifieds/view_item/'.$item->id)?>" target="_blank"><strong><?=$item->name?></strong></a></p>
                <?endif;?>

                <button type="submit" class="classifieds-sendmessage-messagereply-right btn btn-success">Send Message</button>
                <button type="reset" class="classifieds-sendmessage-messagereply-right btn btn-inverse">Reset Text</button>
            </form>
        </div>
    </div>
</div><!-- Modal -->