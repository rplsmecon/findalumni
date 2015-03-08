<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		session_start();
		if($this->session->userdata('idUser')==""):
			$next	= urlencode('http://'.$this->input->server('HTTP_HOST').$this->input->server('REQUEST_URI'));
			redirect('auth/login?next='.$next);
		endif;
	}
	
	public function data()
	{
        if($this->session->userdata('level')<1):
            redirect('home');
        endif;
        
        $category = $this->uri->segment(3,0);
        if(empty($category)):
            redirect('home');
        endif;
        if($category=="aktif"):
			if($this->session->userdata('level')<2):
				redirect('home');
			endif;
            $config['base_url'] = base_url('user/data/aktif');
            $titlenya           = "RPL SMKN 1 Purwokerto: User Aktif";
            $getnya             = $this->m_user->getUserActive("20",$this->uri->segment(4));
            $getsemuanya        = $this->m_user->getUserActive(NULL,NULL);
        elseif($category=="nonaktif"):
			if($this->session->userdata('level')<2):
				redirect('home');
			endif;
            $config['base_url'] = base_url('user/data/nonaktif');
            $titlenya           = "RPL SMKN 1 Purwokerto: User Nonaktif";
            $getnya             = $this->m_user->getUserUnactive("20",$this->uri->segment(4));
            $getsemuanya        = $this->m_user->getUserUnactive(NULL,NULL);
        elseif($category=="semua"):
			if($this->session->userdata('level')<2):
				redirect('home');
			endif;
            $config['base_url'] = base_url('user/data/semua');
            $titlenya           = "RPL SMKN 1 Purwokerto: Semua User";
            $getnya             = $this->m_user->getUserAll("20",$this->uri->segment(4));
            $getsemuanya        = $this->m_user->getUserAll(NULL,NULL);
        elseif($category=="angkatan"):
            $config['base_url'] = base_url('user/data/angkatan');
            $titlenya           = "RPL SMKN 1 Purwokerto: Semua User Angkatan ".$this->session->userdata('angkatan');
            $getnya             = $this->m_user->getUserAngkatan($this->session->userdata('angkatan'),"20",$this->uri->segment(4));
            $getsemuanya        = $this->m_user->getUserAngkatan($this->session->userdata('angkatan'),NULL,NULL);
        elseif($category=="nama"):
			if($this->session->userdata('level')<2):
				redirect('home');
			endif;
            $q                  = $this->input->post('nama');
            $config['base_url'] = base_url('user/data/angkatan');
            $titlenya           = "RPL SMKN 1 Purwokerto: Semua User Bernama ".$q;
            $getnya             = $this->m_user->getUserNama($q,"20",$this->uri->segment(4));
            $getsemuanya        = $this->m_user->getUserNama($q,NULL,NULL);
        else:
            redirect('home');
        endif;
		$listuser 				    = $getsemuanya;
		$config['total_rows']		= $listuser->num_rows;
		$config['per_page'] 		= '20';
		$config['uri_segment']		= 4;
		$config['full_tag_open']	= '<span>';
		$config['full_tag_close']	= '</span>';
		$this->pagination->initialize($config);
        $data   = array(
                        "title" => $titlenya,
						"menu" => "user",
						"dataUser" => $this->m_user->getUserBySession(),
                        "dataUserAll" => $getnya
        );
		$this->load->view('user',$data);
	}
    
    function aktivasi()
    {
        if($this->session->userdata('level')<1):
            redirect('home');
        endif;
        
        $idUser    = $this->uri->segment(3,0);
        $value      = $this->uri->segment(4,0);
		$dataUser = $this->m_user->getUserById($idUser);
        if($value=="1"):    
            foreach($dataUser->result() as $row):
                $data['namalengkap']    = $row->namalengkap;
                $data['email']          = $row->email;
                $this->load->library('email');
                $this->email->set_mailtype('html');
                $body   = $this->load->view('email/akunaktif',$data,TRUE);
                $this->email->from('no-reply@rplsmecon.com',$this->session->userdata('namalengkap').' [Admin]'); 
                $this->email->to($data['email']);
                $this->email->subject('Akun Kamu Sudah Aktif'); 
                $this->email->message($body); 
                $this->email->send();
            endforeach;
        elseif($value=="0"):
			foreach($dataUser->result() as $row):
                $data['namalengkap']    = $row->namalengkap;
                $data['email']          = $row->email;
                $this->load->library('email');
                $this->email->set_mailtype('html');
                $body   = $this->load->view('email/akunnonaktif',$data,TRUE);
                $this->email->from('no-reply@rplsmecon.com',$this->session->userdata('namalengkap').' [Admin]'); 
                $this->email->to($data['email']);
                $this->email->subject('Akun Kamu Dinonaktifkan'); 
                $this->email->message($body); 
                $this->email->send();
            endforeach;
		endif;
        $data['insert'] = $this->m_user->aktivasiUserById($idUser,$value);
        $this->load->vars($data);
		redirect('user/data/angkatan');
    }
    function setadmin()
    {
        if($this->session->userdata('level')<2):
            redirect('home');
        endif;
        
        $idUser    = $this->uri->segment(3,0);
        $value      = $this->uri->segment(4,0);
        $data['insert'] = $this->m_user->setAdminById($idUser,$value);
        $this->load->vars($data);
		redirect('user/data/semua');
    }
	
	function transferangkatan()
    {
        if($this->session->userdata('level')<1):
            redirect('home');
        endif;
        
        $idUser    	= $this->uri->segment(3,0);
        $angkatan	= $this->input->post('angkatan');
        $data['insert'] = $this->m_user->transAngkatanById($idUser,$angkatan);
        $this->load->vars($data);
		redirect('user/data/angkatan');
    }
}