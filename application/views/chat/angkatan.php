<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
        <?=$this->load->view('include/header')?>
			<div id="main">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<div class="box">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-comments-alt"></i>
                                        RPL-Chat (Angkatan <?=$this->session->userdata('angkatan')?>)
                                    </h3>
                                </div>
                                <div class="box-content nopadding scrollable" data-height="400" data-start="bottom" data-visible="true">
                                    <ul class="messages withlist">
                                        <li class="left">
                                            <div class="image">
                                                <img src="img/demo/user-1.jpg" alt="">
                                            </div>
                                            <div class="message">
                                                <span class="caret"></span>
                                                <span class="name">Jane Doe</span>
                                                <p>Lorem ipsum aute ut ullamco et nisi ad. </p>
                                                <span class="time">
                                                    12 minutes ago
                                                </span>
                                            </div>
                                        </li>
                                        <li class="right">
                                            <div class="image">
                                                <img src="img/demo/user-2.jpg" alt="">
                                            </div>
                                            <div class="message">
                                                <span class="caret"></span>
                                                <span class="name">John Doe</span>
                                                <p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum adipisicing nisi Excepteur eiusmod ex culpa laboris. Lorem ipsum est ut...</p>
                                                <span class="time">
                                                    12 minutes ago
                                                </span>
                                            </div>
                                        </li>
                                        <li class="left">
                                            <div class="image">
                                                <img src="img/demo/user-3.jpg" alt="">
                                            </div>
                                            <div class="message">
                                                <span class="caret"></span>
                                                <span class="name">Jane Doe</span>
                                                <p>Lorem ipsum commodo quis dolor voluptate et in Excepteur. Lorem ipsum amet dolor qui cupidatat in anim reprehenderit quis id culpa consequat non culpa. Lorem ipsum in culpa aliquip incididunt cupidatat dolore irure cupidatat aute cupidatat quis nulla. </p>
                                                <span class="time">
                                                    12 minutes ago
                                                </span>
                                            </div>
                                        </li>
                                        <li class="left">
                                            <div class="image">
                                                <img src="img/demo/user-5.jpg" alt="">
                                            </div>
                                            <div class="message">
                                                <span class="caret"></span>
                                                <span class="name">Jane Doe</span>
                                                <p>Lorem ipsum sed culpa in aliquip amet Ut exercitation. </p>
                                                <span class="time">
                                                    12 minutes ago
                                                </span>
                                            </div>
                                        </li>
                                        <li class="left">
                                            <div class="image">
                                                <img src="img/demo/user-6.jpg" alt="">
                                            </div>
                                            <div class="message">
                                                <span class="caret"></span>
                                                <span class="name">Jane Doe</span>
                                                <p>Lorem ipsum labore Excepteur consequat nostrud cillum sed voluptate do fugiat occaecat minim qui qui consequat et fugiat. </p>
                                                <span class="time">
                                                    12 minutes ago
                                                </span>
                                            </div>
                                        </li>
                                        <li class="typing">
                                            <span class="name">John Doe</span> is typing <img src="img/loading.gif" alt="">
                                        </li>
                                        <li class="insert">
                                            <form method="POST" class='form-messages'>
                                                <div class="text">
                                                    <input type="text" name="text" placeholder="Tulis di sini..." class="input-block-level" autocomplete="off">
                                                </div>
                                                <div class="submit">
                                                    <button type="submit"><i class="icon-share-alt"></i></button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                    <div class="user-list">
                                        <h4>Userlist</h4>
                                        <ul>
                                            <li>
                                                <div class="image">
                                                    <img src="img/demo/user-6.jpg" alt="">
                                                </div>
                                                <div class="username">
                                                    John Doe
                                                </div>
                                            </li>
                                            <li>
                                                <div class="image">
                                                    <img src="img/demo/user-5.jpg" alt="">
                                                </div>
                                                <div class="username">
                                                    John Doe
                                                </div>
                                            </li>
                                            <li>
                                                <div class="image">
                                                    <img src="img/demo/user-3.jpg" alt="">
                                                </div>
                                                <div class="username">
                                                    John Doe
                                                </div>
                                            </li>
                                            <li>
                                                <div class="image">
                                                    <img src="img/demo/user-1.jpg" alt="">
                                                </div>
                                                <div class="username">
                                                    Jane Doe
                                                </div>
                                            </li>
                                            <li class="invite">
                                                <a href="#" class='btn btn-block btn-text-left'><i class="icon-plus-sign"></i> Invite people</a>
                                                <a href="#" class='btn btn-block btn-text-left btn-danger'><i class="icon-signout"></i> Leave chat</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>