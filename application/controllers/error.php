<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function e404()
	{
		$this->load->view('error/404');
	}
}