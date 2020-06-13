<?
	class ClassifiedsItem extends DataMapper 
	{	
		var $table = 'be_classifieds_items';

		var $has_one = array(
            'category' => array(
				'class' => 'ClassifiedsCategory',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'category',			
			),
			'member' =>	array(
				'class' => 'ClassifiedsMember',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'member',				
			),
			'currency' => array(
				'class' => 'Currency',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'currency',			
			),
			'review' => array(
				'class' => 'ClassifiedsReview',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'review',			
			),
			'watching_member' => array(
	            'class' => 'ClassifiedsWatchList',
	            'other_field' => 'watchlist',
	            'join_table' => 'classifieds_user_watchlist',
	            'join_self_as' => 'item',
	            'join_other_as' => 'member'
	           ),
	        'posting_member' => array(
	            'class' => 'User',
	            'other_field' => 'posted_item',
	        ),		
		);
		var $has_many = array(
			'image' => array(
				'class' => 'ClassifiedsImage',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'image',			
			),
			'report' => array(
				'class' => 'ClassifiedsAdReport',
				'other_field' => 'item',
				'join_self_as' => 'item',
				'join_other_as' => 'report',
			), 
		);

		public function how_much_time_ago()
		{
			if($this->last_renew_time == '')
				$difference = time() - $this->time_of_creation;
			else
            	$difference = time() - $this->last_renew_time;

            if($difference < 60)
                $before = date('s', $difference).' sec';
            else if($difference < 3600)
                $before = date('i', $difference).' mins';
            else if($difference < 86400)
                $before = date('G', $difference).' hours';
            else if($difference < 2629744)
                $before = date('j', $difference).' days';
            else if($difference < 31556926)
                $before = date('n', $difference).' months';
            else
                $before = date('y', $difference).' years';
            if($this->last_renew_time != '')
            	$before .=' (renew)';

            return $before;
		}

		public function get_like_name($name)
		{
			$this->db->select('*');
			$this->db->like('name', $name);
			$query = $this->db->get('be_classifieds_items');
			$res = array();
			foreach($query->result() as $result){
				array_push($res,$result->id);
			}
			return $res;
		}

		public function get_like_description($description)
		{
			$this->db->select('*');
			$this->db->like('description', $description);
			$query = $this->db->get('be_classifieds_items');
			$res = array();
			foreach($query->result() as $result){
				array_push($res,$result->id);
			}
			return $res;
		}

		public function get_like_name_or_description($keyword)
		{
			$this->db->select('*');
			$this->db->like('name', $keyword);
			$this->db->or_like('description', $keyword);
			$query = $this->db->get('be_classifieds_items');
			$res = array();
			foreach($query->result() as $result){
				array_push($res,$result->id);
			}
			return $res;
		}
	}