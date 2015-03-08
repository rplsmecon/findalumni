<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class Chat extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_chat');
		$this->load->model('m_user');
		session_start();
	}
	
	public function index()
	{
        echo "Hai";
	}
    
    public function angkatan()
    {
        $data   = array(
                        "title" => "RPL SMKN 1 Purwokerto: Chat Angkatan",
						"menu" => "chatroom",
						"dataUser" => $this->m_user->getUserBySession(),
        );
		$this->load->view('chat/angkatan',$data);
    }
    
    public function getchatangkatan()
    {
        if($this->input->post()):
            $this->m_chat->sendAngkatan();
        endif;
        $myAngkatan = $this->session->userdata('angkatan');
        $data   = array(
						"dataChat" => $this->m_chat->getChatByAngkatan($myAngkatan),
        );
		$this->load->view('chat/getchatangkatan',$data);
    }
	
	public function generateChatAngkatan()
	{
		$myAngkatan = $this->input->get('angkatan');
		$dataChat = $this->m_chat->getChatByAngkatan($myAngkatan);
		foreach($dataChat->result() as $row):
			$data[]	= array(
								'posisi' => ($row->chat_from==$this->session->userdata('idUser')) ? 'right' : 'left',
								'username' => $row->username,
								'date' => $row->date,
								'text' => $row->chat_text,
							);
		endforeach;
			$json = json_encode($data);

        echo isset($_GET['callback'])
            ? "{$_GET['callback']}($json)"
            : $json;
	}
}