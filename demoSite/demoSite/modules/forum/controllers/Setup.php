<?php
	class Setup extends Module_Controller
	{
		public function install()
		{
			echo "Installed";
			$this->module->name = "Forum";
			$this->module->version = "1.0";
			$this->setup_database();
			return true;
		}

		public function setup_database()
		{
			$this->db->execute_file();
		}
	}