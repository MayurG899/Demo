<?if($product_reviews_count > 0) :?>
    <?foreach ($product_reviews as $product_review) :?>
        <div class="review">
            <div class="row">
                <div class="col-md-6">
				<?
					$reviewer = new User();
					$reviewer = $reviewer->where('username',$product_review->user)->get();
					if($reviewer->exists())
						$rev_user = ucfirst($reviewer->first_name).' '.ucfirst($reviewer->last_name);
					else
						$rev_user = ucfirst($product_review->user);
				?>
                    <span><b><?=$rev_user?></b></span>
                    <?for($i = 0; $i < $product_review->rating; $i++) :?>
                        <span><img class="star_image img-ecommerce-second-theme" src="<?=base_url('modules/ecommerce/assets/images/rating_images/full-star.png')?>"></span>
                    <?endfor;?>
                </div>
                <div class="col-md-4">
                    <span><?=date('d/m/Y H:i:s', $product_review->date_added)?></span>
                </div>
                <?if(($product_review->user == $user->username) || $this->users->is_admin()):?>
                    <div class="col-md-2">
                        <a href="<?=base_url()?>ecommerce/delete_review/<?=$product_review->id?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Remove</a>
                    </div>
                <?endif;?>
            </div>
            <?if(!empty($product_review->content)):?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p class="reviews_content"><?=$product_review->content?></p>
                    </div>
                </div>
            <?endif;?>
        </div>
    <?endforeach;?>
<?else :?>
    <h3 class="reviews-message-color">No reviews yet</h3>
<?endif;?>