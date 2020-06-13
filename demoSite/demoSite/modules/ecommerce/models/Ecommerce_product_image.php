<?php
class Ecommerce_product_image extends DataMapper
{
    var $table = 'ecommerce_product_images';

    var $has_one = array(
        'product' => array(
            'class' => 'Ecommerce_product',
            'other_field' => 'additional_image',
            'join_self_as' => 'image',
            'join_other_as' => 'product'
        )
    );
}
?>