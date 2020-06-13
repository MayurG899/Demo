<?php
class Checkout_field extends DataMapper
{
    var $table = 'be_ecommerce_checkout_custom_fields';

    public function create_or_edit($data)
    {
        if(isset($data['id']))
            $this->where('id', $data['id'])->get();
        $this->displayed_name = $data['displayed_name'];
        $this->input_name = str_replace(' ', '_', preg_replace("/[^A-Za-z0-9 ]/", '', $data['displayed_name']));
        $this->type = $data['type'];
        if(isset($data['options']))
            $this->options = $data['options'];
        $this->required = $data['required'];
        $this->active = $data['active'];
        $this->save();
    }
}
?>