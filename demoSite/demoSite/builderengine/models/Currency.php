<?php
	class Currency extends DataMapper
	{
		var $table = 'be_currencies';

		public function create($data)
		{
			$this->name = $data['name'];
			$this->signature = $data['signature'];
			$this->symbol = $data['symbol'];
			$this->symbol_position = $data['symbol_position'];
			$this->save();
		}
	}
?>