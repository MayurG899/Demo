<?php
class Ecommerce_review extends DataMapper {
    var $table = 'be_ecommerce_reviews';

    var $has_one = array(
        "product" => array(
            'class' => 'Ecommerce_product',
            'other_field' => 'review',
            'join_self_as' => 'review',
            'join_other_as' => 'product',
        )
    );

    public function get_average_product_rating($id) {
        $reviews = new Ecommerce_review();
        $total_review_count = $reviews->where('product_id', $id)->count();
        if($total_review_count == 0) {
            return 0;
        }

        $product_reviews = $reviews->where('product_id', $id)->get();
        $sum_temp = 0;

        foreach ($product_reviews as $review) {
            $sum_temp += $review->rating;
        }
        $average = $sum_temp / $total_review_count;

        return floor($average * 10) / 10;
    }
}
?>