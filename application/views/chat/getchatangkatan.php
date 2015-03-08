
<?php
    if($dataChat->num_rows < 1):
        echo'<center>Hayuk ngobrol...</center>';
    endif;
    foreach($dataChat->result() as $row):
    $posisi    = ($row->chat_from==$this->session->userdata('idUser')) ? 'right' : 'left';
?>
<li class="<?=$posisi?>">
    <div class="image">
        <img src="<?=base_url('statics/uploads/'.$row->foto)?>" alt="">
    </div>
    <div class="message">
        <span class="caret"></span>
        <span class="name"><a href="<?=base_url('profil/lihat/'.$row->username)?>">@<?=$row->username?></a></span>
        <p><?=strip_tags($row->chat_text)?></p>
        <span class="time">
            <?=$this->rpl->tanggalLDMYHIS($row->date)?>
        </span>
    </div>
</li>
<div id="fokus"></div>
<?php endforeach; ?>