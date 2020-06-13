<?php
class Service_payment_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Ecommerce";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Service Payment 1";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$service_name = $this->block->data('service_name');
		$service_type = $this->block->data('service_type');
		$service_price = $this->block->data('service_price');
		$button_text = $this->block->data('text');
		$button_type = $this->block->data('button_type');

		$button_types = array(
			"default" => "Default Button",
			"primary" => "Primary Button",
			"success" => "Success Button",
			"info" => "Info Button",
			"warning" => "Warning Button",
			"inverse" => "Inverse Button",
			"outline" => "Outline Button",
			"colors" => "Theme Button",
			"danger" => "Danger Button"
		);

		$this->admin_input('service_name','text', 'Service Name: ', $service_name);
		$this->admin_input('service_type','text', 'Service Type: ', $service_type);
		$this->admin_input('service_price','number', 'Service Price: ', $service_price);
		$this->admin_select('button_type', $button_types, 'Button Types: ', $button_type);
		$this->admin_input('text','text', 'Text: ', $button_text);
    }

    public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
            $content = array();
            $content[0] = new stdClass();
			$content[0]->service_name = 'Service Booking';
			$content[0]->service_type = 'Membership';
			$content[0]->service_price = 9.99;
            $content[0]->text = "Book Now";
            $content[0]->type = "colors";

            $this->block->set_data('content', $content, true);
        }
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');
		$CI->load->module('ecommerce');
		$CI->load->library('cart');
		$this->block->set_data('editorAndSettingsEnabled',1);
        $this->set_initial_values_if_empty();
        $content = $this->block->data('content');
        $single_element = '';
        //generic animations
        $this->load_generic_styles();
        //
		$service_name = $this->block->data('service_name');
		$service_type = $this->block->data('service_type');
		$service_price = $this->block->data('service_price');
		$button_text = $this->block->data('text');
		$button_type = $this->block->data('button_type');

		if(isset($_POST['submit-'.$this->block->get_id()])){
			$cart_content = $CI->cart->contents();
			$count = count($cart_content);
			$product_info = array(
				"id" => 'block-'.$this->block->get_id(),
				"qty" => $_POST['quantity'],
				"price" => $_POST['price'],
				"name" => $_POST['name'],
				"service_type" => $_POST['service_type'],
				"image" => base_url('builderengine/public/img/no_preview.png'),
				"shipping_id" => 1,
				"options" => array(),
			);
			$CI->cart->product_name_rules = '[:print:]';
			if($count > 0){
				foreach($cart_content as $item){
					if(strpos($item['id'],'block') !== FALSE){
						if($item['id'] == 'block-'.$this->block->get_id() && $_POST['service_type'] == $item['service_type']){
							$data['rowid'] = $item['rowid'];
							$data['qty'] = $item['qty'] + $_POST['quantity'];
							$CI->cart->update($data);
						}else{
							$CI->cart->insert($product_info);
						}
					}else
						$CI->cart->remove($item['rowid']);
				}
			}else
				$CI->cart->insert($product_info);

			//print_r($CI->cart->contents());exit;
			redirect(base_url('ecommerce/checkout'),'location');
		}

        $output = '';
        foreach($content as $key => $element)
        {
            $element = (object)$element;
			if(!empty($button_type))
				$element->type = $button_type;
			if(!empty($button_text))
				$element->text = $button_text;
			if(!empty($service_name))
				$element->service_name = $service_name;
			if(!empty($service_type))
				$element->service_type = $service_type;
			if(!empty($service_price))
				$element->service_price = $service_price;
            $output .= '
				<div block-editor="ckeditor" id="service-payment-container-'.$this->block->get_id().'">
				
					<div class="beblocks-Pricing-box beblocks-highlight block-colors-light-bg">
						<div class="beblocks-price-title beblocks-spacing-box block-colors-dark">
						<h4>'.$element->service_name.'</h4>
						</div>

					<hr />
					<div class="beblocks-spacing-box block-colors-light block-colors-light-bg">
					<div class="beblocks-price"><span class="beblocks-price-sm">@</span><span class="beblocks-price-lg">'.$element->service_price.'</span></div>
					<div class="beblocks-price-tenure">Price</div>
					</div>

					<hr />
					<div class="beblocks-pricing-features beblocks-spacing-grid block-colors-light block-colors-light-bg">
						<ul>
							<li>24/7 Workspace Access</li>
							<li>1 Coffee <strong>Free</strong></li>
							<li>Heating &amp; Internet</li>
							<li><strong>1 Workspace Seat</strong></li>
							<li>2 Month License</li>
							<li>Premium Support</li>
						</ul>
					</div>

					<hr />
					<form method="post" class="block-colors-light block-colors-light-bg">
							<input type="hidden" name="price" value="'.$element->service_price.'" />
							Quantity<input type="number" name="quantity" class="servicebookingqty" title"quantity" value="1"/>
							<input type="hidden" name="name" value="'.$element->service_name.'" />
							<input type="hidden" name="service_type" value="'.$element->service_type.'" />
							<br/>
							<button field_name="content-'.$key.'-button" class="designer-editable btn btn-lg btn-'.$element->type.'" type="submit" name="submit-'.$this->block->get_id().'" >'.$element->text.'</button>
							<br/>
						</form>
					</div>

            	</div>';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'service-payment-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>