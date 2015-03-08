<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_user');
		session_start();
		if($this->session->userdata('idUser')==""):
			redirect('auth/login');
		endif;
	}
	
	public function index()
	{
        $data   = array(
                        "title"			=> "RPL SMKN 1 Purwokerto: Beranda",
						"menu"			=> "home",
						"dataUser"		=> $this->m_user->getUserBySession(),
						"dataTimeline"	=> $this->m_post->getMyTimeline($this->session->userdata('angkatan'))
        );
		$this->load->view('home',$data);
	}
}