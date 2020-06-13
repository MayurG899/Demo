<?php
	class SocialLink extends DataMapper
	{
		var $table = 'be_social_links';

		public function create($data)
		{
			$this->name = $data['name'];
			$this->url = $data['url'];
			$this->icon = $data['icon'];
			$this->image = $data['image'];
			$this->save();
		}

		public function icon($socialLinkName)
		{
			$this->where('name',$socialLinkName)->get();
			return '<a href="'.$this->url.'" target="_blank" class="be-social-link" ><i class="fa '.$this->icon.' be-social-icon"></i></a>';
		}

		public function image($socialLinkName)
		{
			$this->where('name',$socialLinkName)->get();
			return '<a href="'.$this->url.'" target="_blank" class="be-social-link" ><img src="'.$this->image.'" class="be-social-image" alt="'.$this->name.'" /></a>';
		}

		public function url($socialLinkName)
		{
			$this->where('name',$socialLinkName)->get();
			return '<a href="'.$this->url.'" target="_blank" class="be-social-link" ><span class="be-social-name">'.$this->name.'</span></a>';
		}

		public function name($socialLinkName)
		{
			$this->where('name',$socialLinkName)->get();
			return $this->name;
		}
	}
?>