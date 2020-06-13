<?php
	class ajax extends Module_Controller
	{
		public function add_product_field()
		{
			$name = $_POST['name'];
			$value = $_POST['value'];
			$product_id = $_POST['product_id'];

			$field = new Ecommerce_field();
			$field->name = $name;
			$field->save();

			$product = new Ecommerce_product($product_id);
			$product->add_field($field->id, $value);
		}

		public function edit_product_field()
		{
			$product_id = $_POST['product_id'];
			$field_id = $_POST['field_id'];
			$field_name = $_POST['name'];
			$new_value = $_POST['value'];

			$field = new Ecommerce_field($field_id);
			$field->name = $field_name;
			$field->save();

			$product_field_value = new Product_value();
			$product_field_value->where('product_id', $product_id)->where('field_id', $field_id)->get();
			$product_field_value->value = $new_value;
			$product_field_value->save();
		}

		public function delete_product_field($product_id, $field_id)
		{
			$product_id = urldecode($product_id);
			$field_id = urldecode($field_id);

			$product_field_value = new Product_value();
			$product_field_value->where('product_id', $product_id)->where('field_id', $field_id)->get();
			$product_field_value->delete();
		}

		public function show_product_fields_table($product_id, $category_id)
		{
			$product = new Ecommerce_product($product_id);
			$category = new Ecommerce_category($category_id);
			$output = '';

			$product_fields_array = array();
            foreach($product->product_field->get() as $field)
            {
                $product_fields_array[] = $field->id;
            }
            $category_fields_array = array();
            foreach($category->category_field->get() as $field)
            {
                $category_fields_array[] = $field->id;
            }
            $differences_array = array_diff($product_fields_array, $category_fields_array);

            foreach($product->product_field->get() as $field)
            {
            	foreach($differences_array as $diff)
            	{
            		if($field->id == $diff)
                    {
                    	$output .= '
		            	<tr>
		                    <td style="width: 100px">
		                        <a class="edit-field-value btn btn-success" style="width:100%" field-id="'.$field->id.'">Edit</a>
		                        <div class="btn-group btn-group-vertical input-controls hidden-element" style="width:100%">
		                            <a class="btn btn-info update-field">Update</a>
		                            <a class="btn btn-default cancel-update">Cancel</a>
		                        </div>
		                    </td>
		                    <td>
		                        <div class="field-text">'.$field->name.'</div>
		                        <input type="text" class="hidden-element field-input field-input-name" value="'.$field->name.'">
		                    </td>
		                    <td>
		                        <div class="field-text">'.$field->get_value($product->id).'</div>
		                        <textarea cols="70" rows="5" type="text" class="hidden-element field-input field-input-value">'.$field->get_value($product->id).'</textarea>
		                    </td>
		                    <td style="width: 100px">
		                        <a class="delete-field-value btn btn-danger" style="width:100%" field-id="'.$field->id.'">Delete</a>
		                    </td>
		                </tr>';
                    }
            	}
			}
			echo $output;
		}

		public function add_category_field()
		{
			$name = $_POST['name'];
			$category_id = $_POST['category_id'];

			$field = new Ecommerce_field();
			$field->name = $name;
			$field->save();

			$category = new Ecommerce_category($category_id);
			$category->save_category_field($field);
		}

		public function edit_category_field()
		{
			$field_id = $_POST['field_id'];
			$field_name = $_POST['name'];

			$field = new Ecommerce_field($field_id);
			$field->name = $field_name;
			$field->save();
		}

		public function delete_category_field($category_id, $field_id)
		{
			$category = new Ecommerce_category($category_id);
			$field = new Ecommerce_field($field_id);
			$category->delete_category_field($field);
		}

		public function show_category_fields_table($category_id)
		{
			$category = new Ecommerce_category($category_id);
			$output = '';
			foreach($category->category_field->get() as $field)
			{
				$output .= '
            	<tr>
                    <td style="width: 100px">
                        <a class="edit-field-value btn btn-success" style="width:100%" field-id="'.$field->id.'">Edit</a>
                        <div class="btn-group btn-group-vertical input-controls hidden-element" style="width:100%">
                            <a class="btn btn-info update-field">Update</a>
                            <a class="btn btn-default cancel-update">Cancel</a>
                        </div>
                    </td>
                    <td>
                        <div class="field-text">'.$field->name.'</div>
                        <input type="text" class="hidden-element field-input field-input-name col-lg-12" value="'.$field->name.'">
                    </td>
                    <td style="width: 100px">
                        <a class="delete-field-value btn btn-danger" style="width:100%" field-id="'.$field->id.'">Delete</a>
                    </td>
                </tr>';
			}
			echo $output;
		}

		public function get_category_fields($category_id, $product_id = -1)
		{
			$category = new Ecommerce_category($category_id);

			$output = '';
			foreach($category->category_fields->get() as $field)
			{
				$value = '';
				if($product_id != -1)
				{
					$product = new Ecommerce_product($product_id);
					$value = $field->get_value($product_id);
				}

				$field_name = str_replace(' ', '_', $field->name);
				$output .= '
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2" for="categoryname">'.$field->name.'</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="category['.$field_name.']" type="text" value="'.$value.'" data-parsley-required="false" />
                    </div>
                </div>
				';
			}
			echo $output;
		}

		public function delete_checkout_field($id)
		{
			$checkout_field = new Checkout_field($id);
			$checkout_field->delete();
		}
	}
