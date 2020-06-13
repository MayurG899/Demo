<?
	class ClassifiedsCategory extends DataMapper 
	{	
		var $table = 'classifieds_categories';

		var $has_many = array(
			'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'category',
				'join_self_as' => 'category',
				'join_other_as' => 'item',
			),
		);

        public function has_children()
        {
            $all_categories = new ClassifiedsCategory();
            foreach($all_categories->where('parent', $this->id)->get() as $category)
            {
                return true;
            }
            return false;
        }
	}
