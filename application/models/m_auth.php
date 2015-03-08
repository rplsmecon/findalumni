<?php
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 * 
 * Model ini digunakan untuk otentikasi
 */

class m_auth extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getAuth($fbId,$tokenSecret)
	//echo $fbId; die;
	{
        $username		= addslashes($this->input->post('username'));
        $password   	= md5($this->input->post('password'));
		$passwordAsli  	= addslashes($this->input->post('password'));
		$date			= date("c");
		$user_ip		= $this->input->ip_address();
		$user_agent		= $this->input->user_agent();
		$fb_id			= "";
		$twitter_id		= "";
		if($this->session->userdata('fb_id') != ""):
			$fb_id		= $this->session->userdata('fb_id');
			$bio		= $this->session->userdata('fb_bio');
			$birthday	= $this->session->userdata('fb_birthday');
			$location	= $this->session->userdata('fb_location');
		endif;
		if($this->session->userdata('user_id') != ""):
			$twitter_id			= $this->session->userdata('user_id');
			$o_token			= $this->session->userdata('o_token');
			$o_token_secret		= $this->session->userdata('o_token_secret');
			$twitter_username	= $this->session->userdata('screen_name');
			$twitter_bio		= addslashes($this->session->userdata('twitter_bio'));
		endif;
		
		if($fbId != "0"):
			$query      = $this->db->query("SELECT * FROM user,biodata WHERE user.fb_id='$fbId' AND biodata.iduser=user.iduser");
		elseif($tokenSecret != "0"):
			$query      = $this->db->query("SELECT * FROM user,biodata WHERE user.oauth_token_secret='$tokenSecret' AND biodata.iduser=user.iduser");
		elseif($fbId=="0" && $tokenSecret=="0"):
			$query      = $this->db->query("SELECT * FROM user,biodata WHERE user.username='$username' AND user.password='$password' AND biodata.iduser=user.iduser");
		endif;
		$status		= $query->num_rows();
			if($status==1):
				if($fbId != "0"):
					$query2		= $this->db->query("SELECT * FROM user,biodata WHERE user.fb_id='$fbId' AND biodata.iduser=user.iduser AND user.aktif='1'");
				elseif($tokenSecret != "0"):
					$query2		= $this->db->query("SELECT * FROM user,biodata WHERE user.oauth_token_secret='$tokenSecret' AND biodata.iduser=user.iduser AND user.aktif='1'");
				elseif($fbId=="0" && $tokenSecret=="0"):
					$query2		= $this->db->query("SELECT * FROM user,biodata WHERE user.username='$username' AND biodata.iduser=user.iduser AND user.aktif='1'");
				endif;
				
				$status2	= $query2->num_rows();
				if($status2 > 0):
					$login	= '2';
				else:
					$login	='1';
				endif;
			else:
				$login = '0';
			endif;
		$hasil      = ($login == 2)? $query->result() : $login;
		$hasilLogin	= ($login == 2)? '1' : '0';
		$this->db->trans_start();
		if($this->session->userdata('fb_id') != ""):
			$query		= $this->db->query("UPDATE user inner join biodata on biodata.iduser=user.iduser SET user.fb_id='$fb_id', user.last_login='$date', user.last_login_from_ip='$user_ip', user.last_login_from_agent='$user_agent' WHERE user.username='$username'");
		elseif($this->session->userdata('user_id') != ""):
			$query		= $this->db->query("UPDATE user inner join biodata on biodata.iduser=user.iduser SET user.tw_id='$twitter_id', user.tw_username='$twitter_username', user.oauth_token='$o_token', user.oauth_token_secret='$o_token_secret', user.last_login='$date', user.last_login_from_ip='$user_ip', user.last_login_from_agent='$user_agent' WHERE user.username='$username'");
			$queryBio	= $this->db->query("UPDATE user inner join biodata on biodata.iduser=user.iduser SET biodata.bio='$twitter_bio' WHERE user.username='$username' AND biodata.bio=''");
		else:
			$query		= $this->db->query("UPDATE user SET last_login='$date', last_login_from_ip='$user_ip', last_login_from_agent='$user_agent' WHERE username='$username'");	
		endif;
			$query		= $this->db->query("INSERT INTO login_logs(date,username,password,status) VALUES('$date','$username','$passwordAsli','$hasilLogin')");
		$this->db->trans_complete();
        return $hasil;
    }
	
	function doRegister()
	{
		$username			= addslashes($this->input->post('username'));
		$email				= addslashes($this->input->post('email'));
		$password			= md5($this->input->post('password'));
		$namalengkap		= addslashes($this->input->post('namalengkap'));
		$angkatan			= addslashes($this->input->post('angkatan'));
		$date				= date("c");
		$fb_id				= "";
		$bio				= "";
		$birthday			= "";
		$location			= "";
		$o_token			= "";
		$o_token_secret		= "";
		$twitter_username	= "";
		if($this->session->userdata('fb_id') != ""):
			$fb_id			= $this->session->userdata('fb_id');
			$bio			= $this->session->userdata('fb_bio');
			$birthday		= $this->session->userdata('fb_birthday');
			$location		= $this->session->userdata('fb_location');
			$this->session->unset_userdata('fb_id');
		endif;
		if($this->session->userdata('user_id') != ""):
			$twitter_id			= $this->session->userdata('user_id');
			$o_token			= $this->session->userdata('o_token');
			$o_token_secret		= $this->session->userdata('o_token_secret');
			$twitter_username	= $this->session->userdata('screen_name');
			$bio				= addslashes($this->session->userdata('twitter_bio'));
		endif;
		$this->db->trans_start();
			$query	= $this->db->query("INSERT INTO user(username,email,password,fb_id,tw_id,tw_username,oauth_token,oauth_token_secret,created_date,aktif) VALUES('$username','$email','$password','$fb_id','$twitter_id','$twitter_username','$o_token','$o_token_secret','$date','0')");
			$iduser	= $this->db->insert_id();
			$query	= $this->db->query("INSERT INTO biodata(iduser,namalengkap,angkatan,bio,foto) VALUES('$iduser','$namalengkap','$angkatan','$bio','none.jpg')");
		$this->db->trans_complete();
		
	}
	
	/*
	 * Fungsi cekUsername dan cekEmail digunakan untuk mengecek
	 * apakah sudah ada atau belum untuk keperluan
	 * registrasi
	 */
	function cekUsername()
	{
		$username	= addslashes($this->input->post('username'));
		$this->db->where('username',$username);
		$this->db->from('user');
		$query		= $this->db->get('');
		$hasil      = ($query->num_rows() > 0)? 1 : 0;
        return $hasil;
	}
	
	function cekEmail($email)
	{
		$email	= addslashes($email);
		$this->db->where('email',$email);
		$this->db->from('user');
		$query		= $this->db->get('');
		$hasil      = ($query->num_rows() > 0)? 1 : 0;
        return $hasil;
	}
	
	function cekFbId($id)
	{
		$this->db->where('fb_id',$id);
		$this->db->from('user');
		$query		= $this->db->get('');
		$hasil      = ($query->num_rows() > 0)? 1 : 0;
        return $hasil;
	}
	
	function cekTwitterOauth($oauth_token_secret)
	{
		$this->db->where('oauth_token_secret',$oauth_token_secret);
		$this->db->from('user');
		$query		= $this->db->get('');
		$hasil      = ($query->num_rows() > 0)? 1 : 0;
        return $hasil;
	}
	
	/* Fungsi untuk curl json dari google
	 * recaptcha
	 */
	function getCurlData($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;
	}
}
