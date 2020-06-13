<?php
class Admin extends BE_Controller
{
	// [MenuItem ("Account Dashboard/Show")]
	public function cp()
	{
		redirect(base_url('cp/dashboard'),'location');
	}
}