<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 * 
 * Controller ini digunakan untuk otentikasi
 */
class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth');
		$this->load->model('m_user');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->config('twitter');
		session_start();
	}

	public function login()
	{
		// Twitter dulu
		include_once APPPATH.'libraries/twitteroauth/twitteroauth.php';
		$consumer_key = $this->config->item('consumer_key');
        $consumer_secret = $this->config->item('consumer_secret');
		$o_token 		= $this->session->userdata('o_tok');
        $o_token_secret = $this->session->userdata('o_tok_secret');
		$twitter 		= new TwitterOAuth($consumer_key, $consumer_secret, $o_token, $o_token_secret);

		// Baru fb
		$fb_api_key		= "624926667628582";
		$fb_secret_key	= "c7e23ab10f8d0f98cd0b69e46596e972";
		// Kalo udah masuk alihin ke Home aja
		if($this->session->userdata('idUser')!=""):
			redirect('home');
		endif;
		
		// Set pesan kosong dulu
		$pesan	= NULL;
		if($this->input->get('fb')=='1'):
			$pesan	= "Akun Facebook kamu belum terhubung ke RPL ID.";
		endif;
		
		if($this->input->get('tw')=='1'):
			$pesan	= "Akun Twitter kamu belum terhubung ke RPL ID.";
		endif;
		
		// Kalo dapet inputan dari fb
		if (isset($_GET['code']) AND !empty($_GET['code'])):
			$code = $_GET['code'];
			// parsing result
			parse_str($this->m_auth->getCurlData("https://graph.facebook.com/oauth/access_token?client_id=$fb_api_key&redirect_uri=" . urlencode(base_url('auth/login')) ."&client_secret=$fb_secret_key&code=" . urlencode($code)));
			redirect('auth/login?access_token='.$access_token);
		endif;
		
		if(!empty($_GET['access_token'])):
			// Ambil info user
			$fbUserInfo = json_decode($this->m_auth->getCurlData("https://graph.facebook.com/me?access_token=".$_GET['access_token']), true);
			//print_r($fbUserInfo); die;
			if(!empty($fbUserInfo['id'])):
				$dataFbId	= $this->m_auth->cekFbId($fbUserInfo['id']);
				if($dataFbId < 1):
					$flashdata = array(
						'fb_id'			=> $fbUserInfo['id'],
						'fb_bio'		=> $fbUserInfo['bio'],
						'fb_birthday'	=> date("d/m/Y",strtotime($fbUserInfo['birthday'])),
						'fb_location'	=> $fbUserInfo['location']['name'],
					);
					$this->session->set_userdata($flashdata);
					//echo $this->session->userdata('fb_id').'<br/>'.$this->session->userdata('fb_bio'); die;
					redirect('auth/login?fb=1');
				endif;
			endif;
		endif;
		// Selesai ngurusin fb
		
		// Kalo dapet inputan dari Twitter
		if(isset($_REQUEST['oauth_verifier'])):
			//Ambil session
			$access_token 	= $twitter->getAccessToken($_REQUEST['oauth_verifier']);
			$cekTwitter		= $this->m_auth->cekTwitterOauth($access_token['oauth_token_secret']);
			//echo $cekTwitter; die;
			//$twitter->post('statuses/update', array('status' => "Aku baru login RPL Find Alumni loh. Yang anak RPL SMKN 1 Purwokerto daftar ya di http://rpl.smkn1purwokerto.sch.id."));
			if($cekTwitter < 1):
				$dataTwitter 	= $twitter->get('account/verify_credentials');
				echo $dataTwitter->description;
				$dataToken = array(
					'twitter_id' 	=> null,
					'o_token' 		=> $access_token['oauth_token'],
					'o_token_secret'=> $access_token['oauth_token_secret'],
					'user_id' 		=> $access_token['user_id'],
					'screen_name' 	=> $access_token['screen_name'],
					'twitter_bio'	=> $dataTwitter->description,
				);
				$this->session->set_userdata($dataToken);
				redirect('auth/login?tw=1');
			endif;
		endif;
		// Selesai ngurusin twitter
		
		// Kalo ada inputan
		if($this->input->post() || !empty($_GET['access_token']) || !empty($_REQUEST['oauth_verifier'])):
			if(isset($fbUserInfo['id'])):
				$auth	= $this->m_auth->getAuth($fbUserInfo['id'],"0");
			elseif(isset($_REQUEST['oauth_verifier'])):
				//echo $access_token['oauth_token_secret']; die;
				$auth	= $this->m_auth->getAuth("0",$access_token['oauth_token_secret']);
			else:
				$auth	= $this->m_auth->getAuth("0","0");
			endif;
			// Kalo dapet balikan dari $this->m_auth->getAuth()
			if($auth):
				if($auth==1):
					$pesan	= "<b>Ups...</b> Akun kamu belum aktif nih. Tunggu diaktifin dulu sama kakak admin ya.";
				else:
					foreach($auth as $row):
						$data['idUser']			= $row->iduser;
						$data['username']		= $row->username;
						$data['email']			= $row->email;
						$data['namalengkap']	= $row->namalengkap;
						$data['fotoUser']		= $row->foto;
						$data['angkatan']		= $row->angkatan;
						$data['level']			= $row->level;
					endforeach;
					$userdata = array(
						'idUser' 		=> $data['idUser'],
						'username' 		=> $data['username'],
						'email' 		=> $data['email'],
						'password' 		=> $this->input->post('password'),
						'namalengkap' 	=> $data['namalengkap'],
						'fotoUser' 		=> $data['fotoUser'],
						'angkatan' 		=> $data['angkatan'],
						'level' 		=> $data['level'],
					);
					$this->session->set_userdata($userdata);
					$twitter->post('statuses/update', array('status' => "Aku baru login RPL Find Alumni loh. Yang anak RPL SMKN 1 Purwokerto daftar ya di http://s.id/rpl1. @RPL_Smecon"));
					$next	= ($this->input->get('next'))? urldecode($this->input->get('next')) : 'home';
					redirect($next);
				endif;
			// Kalo nggak dapet balikan, cek kode errornya
			else :
				if($auth=='0'):
					$pesan	= "<b>Ups...</b> Username dan Password tidak cocok";
				endif;
			endif;
		endif;
		
        $data   = array(
                        "title" 		=> "RPL SMKN 1 Purwokerto: Masuk",
						"pesan" 		=> $pesan,
						"fb_api_key"	=> $fb_api_key
        );
		if($this->input->get('facebook')=='1'):
			$this->load->view('fblogin',$data);
		else:
			$this->load->view('login',$data);
		endif;
	}
	
	public function register()
	{
		$fb_api_key		= "624926667628582";
		$fb_secret_key	= "c7e23ab10f8d0f98cd0b69e46596e972";
		// Kalo udah masuk alihin ke Home aja
		if($this->session->userdata('idUser')!=""):
			redirect('home');
		endif;
		
		// Set pesan kosong dulu
		$pesan	= NULL;
		
		// Kalo ada inputan
		if($this->input->post()):
			$dataUsername	= $this->m_auth->cekUsername();
			$dataEmail		= $this->m_auth->cekEmail();
			if($dataUsername || $dataEmail > 0):
				$pesan	= '<b>Gagal!</b> Username atau Email sudah digunakan.';
			else:
				// Cek captcha dulu
				$google_url		= "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha		= $_POST['g-recaptcha-response'];
				$secret			= '6LfMBf8SAAAAAJPj-vDsjUTdTHa0pbfYFR9CgKMB';
				$ip				= $_SERVER['REMOTE_ADDR'];
				$url			= $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
				$res			= $this->m_auth->getCurlData($url);
				$res			= json_decode($res, true);
				if(!$res['success']):
					$pesan	= '<b>Gagal!</b> Captcha salah.';
				else:
					$this->m_auth->doRegister();
					// Kirim mail ke pendaftar
					$data1['namalengkap']    = $this->input->post('namalengkap');
					$data1['email']    = $this->input->post('email');
					$data1['username']    = $this->input->post('username');
					$data1['password']    = '****';
					$this->load->library('email');
					$this->email->set_mailtype('html');
					$body   = $this->load->view('email/barudaftar',$data1,TRUE);
					$this->email->from("no-reply@rplsmecon.com","RPL SMKN 1 Purwokerto"); 
					$this->email->to($data1['email']);
					$this->email->subject('Selamat Datang di RPL'); 
					$this->email->message($body); 
					//$this->email->send();
					// Kirim email ke admin
					$dataUser = $this->m_user->getAdminAngkatan($this->input->post('angkatan'));
					foreach($dataUser->result() as $row):
						$data['namalengkap']    = $row->namalengkap;
						$data['email']          = $row->email;
						$data['namauser']		= $this->input->post('namalengkap');
						$this->load->library('email');
						$this->email->set_mailtype('html');
						$body   = $this->load->view('email/userbaru',$data,TRUE);
						$this->email->from("no-reply@rplsmecon.com","RPL SMKN 1 Purwokerto"); 
						$this->email->to($data['email']);
						$this->email->subject('Akun Baru Aktifin Gih ['.$data['namauser'].']'); 
						$this->email->message($body); 
						$this->email->send();
					endforeach;
					redirect('auth/successregister');
				endif;
			endif;
		endif;
		
        $data   = array(
                        "title" => "RPL SMKN 1 Purwokerto: Daftar",
						"pesan" => $pesan,
						"fb_api_key"	=> $fb_api_key
        );
		$this->load->view('register',$data);
	}
	
	public function twitterlogin()
	{
		// Twitter oauth
		include_once APPPATH.'libraries/twitteroauth/twitteroauth.php';
		$consumer_key = $this->config->item('consumer_key');
        $consumer_secret = $this->config->item('consumer_secret');
		$oauth = new TwitterOAuth($consumer_key,$consumer_secret);
		$oauthRequest = $oauth->getRequestToken($callback);
		$this->session->set_userdata("o_tok",$oauthRequest['oauth_token']);
        $this->session->set_userdata("o_tok_secret",$oauthRequest['oauth_token_secret']);
		$registerUrl = $oauth->getAuthorizeURL($oauthRequest);
        redirect($registerUrl);
	}
	
	public function successregister()
	{
        $data   = array(
                        "title" => "RPL SMKN 1 Purwokerto: Berhasil Mendaftar",
        );
		$this->load->view('successregister',$data);
	}

	
	public function forgotpassword()
	{
        $data   = array(
                        "title" => "RPL SMKN 1 Purwokerto: Lupa Password",
        );
		$this->load->view('forgotpassword',$data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
	
	/* Fungsi-fungsi berikut digunakan untuk validasi username & email
	 * dengan cara mengecek ke database apakah sudah ada atau belum dan
	 * dipanggil lewat ajax di frontend
	 */
	
	function cekusername()
	{
		$dataUsername	= $this->m_auth->cekUsername();
		echo $dataUsername;
	}
	
	function cekemail()
	{
		$email		= mysql_real_escape_string($this->input->post('email'));
		$dataEmail	= $this->m_auth->cekEmail($email);
		echo $dataEmail;
	}
}