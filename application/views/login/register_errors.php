<p><?= $this->session->flashdata('errmsg'); //извежда грешките от set_flashdata  ?></p>
<p>Името  :<b><?php echo $this->session->userdata('user_name'); ?></b>вече е заето</p>
<?php echo anchor('login/logout', 'Изход'); ?>