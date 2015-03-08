<?php
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class m_user extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getUserBySession()
	{
		$idUser 	= $this->session->userdata('idUser');
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.iduser',$idUser);
		$this->db->where('user.aktif','1');
		$query  = $this->db->get('');
		return $query->row();
	}
	
	function getUserById($idUser)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.iduser',$idUser);
		$this->db->where('user.aktif','1');
		$query  = $this->db->get('');
		return $query;
	}
	
	function getUserByUsername($username)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.username',$username);
		$this->db->where('user.aktif','1');
		$query  = $this->db->get('');
		return $query->row();
	}
	
	function getUserByKeyword()
	{
		$q = mysql_real_escape_string($this->input->post('q'));
		$query		= $this->db->query("select * from user INNER JOIN biodata ON biodata.iduser=user.iduser WHERE biodata.namalengkap LIKE '%$q%' AND user.aktif='1' OR biodata.namapanggilan LIKE '%$q%' AND user.aktif='1' OR biodata.angkatan LIKE '%$q%'AND user.aktif='1'");
		return $query;
	}
	
	 function getUserByAngkatan($angkatan)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('biodata.angkatan',$angkatan);
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('');
		return $query;
	}
	
	function getUserActive($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.aktif','1');
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('',$perPage,$uri);
		return $query;
	}
	
	function getUserUnactive($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.aktif','0');
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('',$perPage,$uri);
		return $query;
	}
	
	
	function getUserAll($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
	   $this->db->order_by('biodata.angkatan','ASC');
		$query  = $this->db->get('',$perPage,$uri);
		
		return $query;
	}
	
	function getUserAngkatan($q,$perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('biodata.angkatan',$q);
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('',$perPage,$uri);
		
		return $query;
	}
	
	function getUserNama($q,$perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->like('biodata.namalengkap',$q);
		$this->db->or_like('biodata.namapanggilan',$q);
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('',$perPage,$uri);
		
		return $query;
	}
	
	function getUserAngkatanUnactive()
	{
		$angkatanku	= $this->session->userdata('angkatan');
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('user.aktif','0');
		$this->db->where('biodata.angkatan',$angkatanku);
		$this->db->order_by('biodata.namalengkap','ASC');
		$query  = $this->db->get('');
		return $query;
	}
	
	function getAdminAngkatan($q)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('biodata.angkatan',$q);
		$this->db->where('user.level >','0');
		$query  = $this->db->get('');
		
		return $query;
	}
	
	function updateUser($idUser,$data)
	{
		
		$this->db->where('iduser',$idUser);
		$this->db->update('biodata',$data);
	}
	
	function updatePassword($idUser)
	{
		$password         = md5($this->input->post('password'));
		$data=array(
					'password'=>$password
		);
		$this->db->where('iduser',$idUser);
		$this->db->update('user',$data);
	}
	
	function aktivasiUserById($idUser,$value)
	{
		$data=array(
					'aktif'=>$value
		);
		$this->db->where('iduser',$idUser);
		$this->db->update('user',$data);
	}
	
	function setAdminById($idUser,$value)
	{
		$data=array(
					'level'=>$value
		);
		$this->db->where('iduser',$idUser);
		$this->db->update('user',$data);
	}
	
	function transAngkatanById($idUser,$angkatan)
	{
		$data=array(
					'angkatan'=>$angkatan
		);
		$this->db->where('iduser',$idUser);
		$this->db->update('biodata',$data);
	}
}
