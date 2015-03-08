<?php
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 *
 * Model ini digunakan untuk tabel chat
 */

class m_chat extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
    
	function getChatByAngkatan($angkatan)
	{
		$this->db->select('*');
        $this->db->from('chat');
		$this->db->join('user', 'user.iduser = chat.chat_from');
        $this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('chat.aktif','1');
		$this->db->where('chat.chat_to',$angkatan);
        $this->db->order_by('chat.chat_id','DESC');
        $query  = $this->db->get('',50);
        return $query;
	}
    
    function sendAngkatan()
    {
        $chat_from      = $this->session->userdata('idUser');
        $chat_to        = $this->session->userdata('angkatan');
		$date   		= date("c");
        $isi            = $this->input->post('pesan');
        if(!empty($isi)):
            $data=array(
                        'chat_from'=>$chat_from,
                        'chat_to'=>$chat_to,
                        'date'=>$date,
                        'chat_text'=>$isi,
                        'aktif'=>'1'
            );
            $this->db->insert('chat',$data);
        endif;
    }
}