<?php
	class Ecommerce_currency extends DataMapper
	{
		var $table = 'ecommerce_currencies';

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