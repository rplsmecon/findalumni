<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class Profil extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_post');
		session_start();
		if($this->session->userdata('idUser')==""):
			$next	= urlencode('http://'.$this->input->server('HTTP_HOST').$this->input->server('REQUEST_URI'));
			redirect('auth/login?next='.$next);
		endif;
	}
	
	public function edit()
	{
		$data   = array(
						"title" => "RPL SMKN 1 Purwokerto: Edit Profil",
						"menu" => "profil",
						"dataUser" => $this->m_user->getUserBySession()
		);
		$this->load->view('profil/editprofil',$data);
	}
	
	public function lihat()
	{
		$username    	= addslashes($this->uri->segment(3,0));
		$dataProfil		= $this->m_user->getUserByUsername($username);
		if(empty($dataProfil->iduser)) {
			redirect();
		}
		$dataQuestion	= $this->m_post->getAnsweredQuestion($dataProfil->iduser,10);
		$data   = array(
						"title" 		=> "RPL SMKN 1 Purwokerto: Profil",
						"menu" 			=> "profil",
						"dataUser" 		=> $this->m_user->getUserBySession(),
						"dataProfil" 	=> $dataProfil,
						'dataQuestion'	=> $dataQuestion,
		);
		$this->load->view('profil/lihatprofil',$data);
	}
	
	public function cari()
	{
		$data   = array(
						"title" => "RPL SMKN 1 Purwokerto: Pencarian",
						"menu" => "profil",
						"dataUser" => $this->m_user->getUserBySession(),
						"dataProfil" => $this->m_user->getUserByKeyword()
		);
		$this->load->view('profil/cari',$data);
	}
	
	public function seangkatan()
	{
		$data   = array(
						"title" => "RPL SMKN 1 Purwokerto: Teman Seangkatan",
						"menu" => "seangkatan",
						"dataUser" => $this->m_user->getUserBySession(),
						"dataProfil" => $this->m_user->getUserByAngkatan($this->session->userdata('angkatan'))
		);
		$this->load->view('profil/seangkatan',$data);
	}
	
	public function updateprofil()
	{
		$idUser    = $this->session->userdata('idUser');
		// Upload dulu fotonya deh biar nggak ribet
		$config['upload_path']		= './statics/uploads';
		$config['allowed_types']	= 'gif|jpg|png|jpeg';
		$config['max_size']			= '10000';
		$config['max_width'] 		= '10024';
		$config['max_height']		= '1768';

		$this->load->library('upload', $config);
		
		// Set data
		$inputData 	= array(
					'namalengkap'	=> addslashes($this->input->post('namalengkap')),
					'namapanggilan'	=> addslashes($this->input->post('namapanggilan')),
					'gender'		=> addslashes($this->input->post('gender')),
					'tgl_lahir'		=> addslashes($this->input->post('tgl_lahir')),
					'hp'			=> addslashes($this->input->post('hp')),
					'bbm'			=> addslashes($this->input->post('bbm')),
					'alamat'		=> $this->input->post('alamat'),
					'bio'			=> $this->input->post('bio'),
					'universitas'	=> addslashes($this->input->post('universitas')),
					'perusahaan'	=> addslashes($this->input->post('perusahaan')),
		);
		if($this->upload->do_upload('foto')) {
			$foto				= $this->upload->data();
			$inputData['foto']	= $foto['file_name'];
		}
		$data['insert'] = $this->m_user->updateUser($idUser,$inputData);
		$this->load->vars($data);
		redirect('profil/edit');
	}
	
	public function updatepassword()
	{
		$idUser    = $this->session->userdata('idUser');
		$data['insert'] = $this->m_user->updatePassword($idUser);
		$this->load->vars($data);
		redirect('profil/edit');
	}
}
