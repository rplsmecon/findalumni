<?php
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 *
 * Model ini digunakan untuk tabel post
 * dan comment
 */

class m_post extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * Kategori post pengumuman
	 */
	function addNewPost($arrData = array())
	{
		$this->db->insert('post',$data);
	}
	
	/*
	 * Fungsi getMyTimeline digunakan untuk membuat timeline
	 * user di mana data yang ditampilkan adalah
	 * post dengan post.post_to=this->session->userdata('angkatan')
	 * atau post.post.to='0' agar post yang ditujukan untuk semua
	 * angkatan ikut tampil
	 */
	function getMyTimeline($angkatan)
	{
		$query  = $this->db->query("SELECT * FROM post INNER JOIN user ON user.iduser=post.post_from INNER JOIN biodata ON biodata.iduser=user.iduser WHERE post.aktif='1' AND post.post_to='0' OR post.aktif='1' AND post.post_to='$angkatan' ORDER BY post.id DESC LIMIT 10");
		return $query;
	}
	
	function getTimelineByAngkatan($angkatan = null)
	{
		$query  = $this->db->query("SELECT * FROM post INNER JOIN user ON user.iduser=post.post_from INNER JOIN biodata ON biodata.iduser=user.iduser WHERE post.aktif='1' AND post.post_to='0' OR post.aktif='1' AND post.post_to='$angkatan' ORDER BY post.id DESC LIMIT 10");
		return $query;
	}
	
	function detail($postId)
	{
		$this->db->select('*');
		$this->db->from('post');
		$this->db->join('user', 'user.iduser = post.post_from');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('md5(post.id)',$postId);
		$this->db->where('post.aktif','1');
		$query  = $this->db->get('');
		return $query;
	}
	
	function deletePost($id,$idSaya)
	{
		
		//if($row->iduser==$this->session->userdata('idUser') || $this->session->userdata('level')=="1"):
		//$query  = $this->db->query("DELETE FROM post WHERE id='$id'");
		//else:
		$this->db->trans_start();
		if($this->session->userdata('level') <= 1):
		$query  = $this->db->query("UPDATE post SET aktif='0' WHERE md5(id)='$id' AND post_from='$idsaya'");
		elseif($this->session->userdata('level') > 1):
		$query  = $this->db->query("UPDATE post SET aktif='0' WHERE md5(id)='$id'");
		endif;
		$query  = $this->db->query("UPDATE comment SET aktif='0' WHERE comment_to='$id'");
		//endif;
		$this->db->trans_complete();
	}
	
	/*
	 * Kategori post komentar
	 */
	
	function addNewComment($data)
	{
		$this->db->insert('comment',$data);
	}
	
	
	function getComments($postId)
	{
		$this->db->select('*');
		$this->db->from('comment');
		$this->db->join('user', 'user.iduser = comment.comment_from');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('comment.comment_to',$postId);
		$this->db->where('comment.aktif','1');
		$query  = $this->db->get('');
		return $query;
	}
	
	/*
	 * Fungsi getMyUnreadComments digunakan untuk
	 * notifikasi pada topbar admin, mengambil dari
	 * tabel comment yang field comment.baca='0' dan
	 * comment.comment_to_user = this->session->userdata('idUser')
	 * dan comment.aktif=1
	 */
	function getMyUnreadComments()
	{
		$idSaya	= $this->session->userdata('idUser');
		$this->db->select('*');
		$this->db->from('comment');
		$this->db->join('user', 'user.iduser = comment.comment_from');
		$this->db->join('biodata', 'biodata.iduser = user.iduser');
		$this->db->where('comment.comment_to_user',$idSaya);
		$this->db->where('comment.baca','0');
		$this->db->where('comment.aktif','1');
		$this->db->order_by('comment.date','DESC');
		$query  = $this->db->get('');
		return $query;
	}
	
	function setCommentBaca($postId)
	{
		$query  = $this->db->query("UPDATE comment SET baca='1' WHERE comment_to='$postId'");
		return $query;
	}
	
	/*
	 * Fungsi deleteComment akan melakukan update field aktif
	 * menjadi 0 di post. Apabila level 1 maka hanya bisa
	 * menghapus post miliknya, apabila level > 1 bisa menghapus
	 * post milik siapa pun
	 */
	function deleteComment($commentId)
	{
		$idsaya = $this->session->userdata('idUser');
		if($this->session->userdata('level') > 0):
		$query  = $this->db->query("UPDATE comment SET aktif='0' WHERE id='$commentId'");
		else:
		$query  = $this->db->query("UPDATE comment SET aktif='0' WHERE id='$commentId' AND post_from='$idsaya'");
		endif;
		return $query;
	}

	/*
	 * Fungsi di bawah adalah fungsi baru yang ditambahkan
	 * setelah versi 1.1, fitur baru pada versi tersebut
	 * adalah fitur tanya jawab di mana berhubungan
	 * dengan tabel answer dan tabel question
	 * sebagai transaksional
	 */

	function addNewQuestion($arrData)
	{
		$this->db->insert('t_questions',$arrData);
	}

	function addNewAnswer($arrData)
	{
		$this->db->insert('t_answers',$arrData);
	}

	function getUnreadQuestions($idUser)
	{
		$where 		= "(q.active='1' AND q.to_iduser='$idUser' AND q.answered='0' AND q.seen='0') OR (q.from_iduser='$idUser' AND q.answered='1' AND a.seen='0')";
		$this->db->select('q.id q_id, a.id a_id, q.to_iduser, u.iduser,q.question,a.answer,b.namalengkap,u.username,u_to.username to_username');
		$this->db->from('t_questions q');
		$this->db->join('user u', 'u.iduser = q.from_iduser');
		$this->db->join('biodata b', 'b.iduser = u.iduser');
		$this->db->join('user u_to', 'u_to.iduser = q.to_iduser');
		$this->db->join('t_answers a', 'a.question_id = q.id', 'LEFT');
		$this->db->where($where,null,false);
		$this->db->order_by('q.created_date','DESC');
		$query  = $this->db->get('');
		return $query;
	}

	function getDetailQuestion($id)
	{
		$this->db->select('q.id q_id, a.id a_id, q.to_iduser, q.from_iduser, u.iduser,q.question,a.answer,b.namalengkap,u.username,u_to.username to_username');
		$this->db->from('t_questions q');
		$this->db->join('user u', 'u.iduser = q.from_iduser');
		$this->db->join('biodata b', 'b.iduser = u.iduser');
		$this->db->join('user u_to', 'u_to.iduser = q.to_iduser');
		$this->db->join('t_answers a', 'a.question_id = q.id', 'LEFT');
		$this->db->where('q.active','1');
		$this->db->where('q.id',$id);
		$query  = $this->db->get('');
		return $query->row();
	}

	function getAnsweredQuestion($idUser,$limit = 10)
	{
		$this->db->select('q.id q_id, a.id a_id, q.to_iduser, u.iduser,q.question,a.answer,b.namalengkap,u.username');
		$this->db->from('t_questions q');
		$this->db->join('user u', 'u.iduser = q.from_iduser');
		$this->db->join('biodata b', 'b.iduser = u.iduser');
		$this->db->join('t_answers a', 'a.question_id = q.id', 'LEFT');
		$this->db->where('q.active','1');
		$this->db->where('q.answered','1');
		$this->db->where('q.to_iduser',$idUser);
		$this->db->order_by('q.created_date','DESC');
		$this->db->limit($limit);
		$query  = $this->db->get('');
		return $query;
	}

	function updateQuestion($questionId,$arrData)
	{
			$this->db->where('id', $questionId);
			$this->db->update('t_questions', $arrData); 
	}

	function updateAnswer($questionId,$arrData)
	{
			$this->db->where('question_id', $questionId);
			$this->db->update('t_answers', $arrData); 
	}

}