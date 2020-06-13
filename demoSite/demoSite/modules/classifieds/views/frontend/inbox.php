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
            <h3 class="classifieds-search-results-margin30">View Messages Received</h3>
            <?if(!$all_messages->exists()):?>
              <h5 class="classifieds-search-results-margin30">You Have No Messages</h5>
            <?else:?>
                <? foreach ($all_messages as $message):?>
                    <?$sender = new User($message->from);?>
                    <?$sender_extend = $sender->extended->get();?>
                    <div class="row classifieds-inbox-boxdetails">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="<?=base_url('classifieds/profile/'.$message->from)?>">
                                    <img class="classifieds-inbox-image" src="<?=checkImagePath($sender->avatar)?>">
                                </a>
                            </div>
                            <div class="col-md-10 classifieds-inbox-fromtitle">
                                <div class="row">
								<p class="classifieds-inbox-title-font">From: <a href="<?=base_url('classifieds/profile/'.$message->from)?>"> <?=$sender->first_name.' '.$sender->last_name;?></a> &nbsp;&nbsp; <small>Username: <a href="<?=base_url('/classifieds/profile/'.$message->from)?>"> <?=$sender->username?></a></small></p>									
                                </div>
                                <div class="row">
                                    <p class="classifieds-inbox-title-date">At: <?=$message->time_of_creation?></p> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="classifieds-inbox-messagebox">
                                <?=$message->content?>
                                </p>
                            </div>
                        </div>
                        <?if($message->linked_product_id != '' && $message->linked_product_id != '0'):?>
                            <?$item = new ClassifiedsItem($message->linked_product_id);?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="classifieds-inbox-productinfo">
                                        Product of interest: 
                                        <a href="<?=base_url('classifieds/view_item/'.$item->id)?>" target="_blank"><?=$item->name?></a>
                                    </p>
                                </div>
                            </div>
                        <?endif;?>
                        <div class="row">
                            <div class="col-md-12">
								<a class="classifieds-inbox-messagereply-left btn btn-danger" href="<?=base_url('/classifieds/delete_message/'.$message->id)?>">Delete</a>
                                <a class="classifieds-inbox-messagereply-right btn btn-primary" href="<?=base_url('/classifieds/send_message?username='.$sender->username)?>">Reply Message</a>
                            </div>
                        </div>
                    </div>
                <?endforeach;?> 
            <?endif;?>
        </div>
    </div>
</div><!-- Modal -->