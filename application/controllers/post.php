<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 */

class Post extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
		$this->load->model('m_user');
		$this->load->model('m_post');
		$this->load->config('twitter');
		session_start();
		if($this->session->userdata('idUser')==''):
			if($this->uri->segment(2,0) != 'detail'):
				$next	= urlencode('http://'.$this->input->server('HTTP_HOST').$this->input->server('REQUEST_URI'));
				redirect('auth/login?next='.$next);
			endif;
		endif;
	}
	
	public function addnew()
	{
		if($this->input->post()):			
			$dataInput	= array(
						'post_from'	=> $this->session->userdata('idUser'),
						'post_to'	=> addslashes($this->input->post('angkatan')),
						'date'		=> date('c'),
						'judul'		=> addslashes($this->input->post('judul')),
						'isi'		=> $this->input->post('isi'),
						'aktif'		=> 1
			);
			$this->m_post->addNewPost($dataInput);
			redirect('home');
		endif;
		$data   = array(
						"title" 	=> "RPL SMKN 1 Purwokerto: Kirim Pengumuman",
						"menu" 		=> "post",
						"dataUser"	=> $this->m_user->getUserBySession(),
		);
		$this->load->view('addnewpost',$data);
	}
	
	public function detail($postId)
	{
		$postId		= addslashes($postId);
		if(empty($postId)):
			redirect('home');
		endif;
		$idSaya		= $this->session->userdata('idUser');
		$detailPost	= $this->m_post->detail($postId);
				foreach($detailPost->result() as $row):
					$data1['email']			= $row->email;
					$data1['namalengkap']	= $row->namalengkap;
					$data1['judul']			= $row->judul;
					$toUserId				= $row->iduser;
				endforeach;
		// Kalo $toUserId-nya sama dengan session, set komentar udah dibaca
		if($toUserId == $idSaya):
			$this->m_post->setCommentBaca($postId);
		endif;
		if($this->input->post()):
				// Input database
				$inputData	= array(
					'comment_from'		=> $this->session->userdata('idUser'),
					'comment_to'		=> $postId,
					'comment_to_user'	=> $toUserId,
					'date'				=> date('c'),
					'isi'				=> $this->input->post('isi'),
					'aktif'				=> 1
				);
				$this->m_post->addNewComment($inputData);
				
				// Kirim email
				$data1['namauser']	= $this->session->userdata('namalengkap');
				$this->load->library('email');
				$this->email->set_mailtype('html');
				$body   = $this->load->view('email/komentarbaru',$data1,TRUE);
				$this->email->from("no-reply@rplsmecon.com","RPL SMKN 1 Purwokerto"); 
				$this->email->to($data1['email']);
				$this->email->subject('Komentar Baru ['.$data1['judul'].']'); 
				$this->email->message($body); 
				$this->email->send();
				
				
				redirect('post/detail/'.$postId);
		endif;
		$post	= $this->m_post->detail($postId);
		foreach($post->result() as $row):
			$title	= (empty($row->judul)) ? "Tidak Ada Judul" : $row->judul;
		endforeach;
		$data   = array(
						"title" => 'RPL SMKN 1 Purwokerto: '.$title,
						"menu" => "",
						"dataUser" => $this->m_user->getUserBySession(),
						"dataPost" => $this->m_post->detail($postId),
						"dataComments" => $this->m_post->getComments($postId)
		);
		if($this->session->userdata('idUser')==""):
			$this->load->view('postdetailpublic',$data);
		else:
			$this->load->view('postdetail',$data);
		endif;
	}
	
	public function delcomment($commentId,$postId)
	{
		$this->m_post->deleteComment($commentId);
		redirect('post/detail/'.$postId);
	}
	
	public function hapus($id)
	{	
		$idsaya = $this->session->userdata('idUser');
		$this->m_post->deletePost($id,$idsaya);
		redirect('home');
	}
	
	public function generateTimeline()
	{
		$angkatan	= $this->input->get('angkatan');
		$dataTimeline = $this->m_post->getTimelineByAngkatan($angkatan);
		foreach($dataTimeline->result() as $row):
			$data[]	= array(
								'id' => md5($row->id),
								'username' => $row->username,
								'date' => $row->date,
								'judul' => $row->judul,
							);
		endforeach;
			$json = json_encode($data);

		echo isset($_GET['callback'])
			? "{$_GET['callback']}($json)"
			: $json;
	}

	/**
	** Tambahan setelah versi 1.1
	** fitur tanya jawab
	*/

	public function question($idUser,$username)
	{
		$arrQuestions	= array(
			'created_date'	=> date('c'),
			'from_iduser'	=> $this->session->userdata('idUser'),
			'to_iduser'		=> (int)$idUser,
			'question'		=> addslashes($this->input->post('question')),
			'answered'		=> '0',
			'active'		=> '1',
			'seen'			=> '0',
		);
		$this->m_post->addNewQuestion($arrQuestions);
		redirect('profil/lihat/'.addslashes($username));
	}

	public function answer($username,$idQuestion)
	{
		include_once APPPATH.'libraries/twitteroauth/twitteroauth.php';
		$arrAnswers	= array(
			'created_date'	=> date('c'),
			'question_id'	=> $idQuestion,
			'answer'		=> addslashes($this->input->post('answer')),
			'active'		=> '1',
			'seen'			=> '0',
		);
		$this->m_post->addNewAnswer($arrAnswers);
		$dataUpdate	= array(
			'answered' => '1'
		);
		$this->m_post->updateQuestion($idQuestion,$dataUpdate);
		if($this->input->post('tweet') == 1) {
			$dataQuestion		= $this->m_post->getDetailQuestion($idQuestion);
			$question 			= $dataQuestion->question;
			$username			= $this->session->userdata('username');
			$answer 			= addslashes($this->input->post('answer'));
			$dataUser			= $this->m_user->getUserBySession();
			$consumer_key 		= $this->config->item('consumer_key');
			$consumer_secret 	= $this->config->item('consumer_secret');
			$o_token 			= $dataUser->oauth_token;
			$o_token_secret 	= $dataUser->oauth_token_secret;
			$twitter 			= new TwitterOAuth($consumer_key, $consumer_secret, $o_token, $o_token_secret);
			$tweetContent		= $question.' — '.$answer.' http://rplsmecon.com/q/'.$username.'/'.$idQuestion;
			$twitter->post('statuses/update', array('status' => $tweetContent));

		}
		redirect('post/detailquestion/'.addslashes($username).'/'.(int)$idQuestion);
	}

	public function detailquestion($username,$idQuestion)
	{
		$username		= addslashes($username);
		$idQuestion		= (int)$idQuestion;

		$dataQuestion	= $this->m_post->getDetailQuestion($idQuestion);
		$dataProfil		= $this->m_user->getUserByUsername($username);
		//echo json_encode($dataQuestion); die;
		if($dataQuestion->to_iduser == $this->session->userdata('idUser')) {
			$dataUpdate	= array(
				'seen' => '1'
			);
			$this->m_post->updateQuestion($idQuestion,$dataUpdate);
		} else if ($dataQuestion->from_iduser == $this->session->userdata('idUser')) {
			$dataUpdate	= array(
				'seen' => '1'
			);
			$this->m_post->updateAnswer($idQuestion,$dataUpdate);
		}
		$data   = array(
						'title' 		=> 'RPL SMKN 1 Purwokerto: '.$dataQuestion->question,
						'menu' 			=> '',
						'dataUser' 		=> $this->m_user->getUserBySession(),
						'dataQuestion' 	=> $dataQuestion,
						'dataProfil'	=> $dataProfil,
		);
		$this->load->view('qa/questiondetail',$data);
	}
}
