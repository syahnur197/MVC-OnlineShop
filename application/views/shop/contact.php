<div class="jumbotron center" style="min-height: 350px; background:linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url(<?= base_url('style/assets/images/contact.jpeg')?>) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;">
	<h1 class="text-center display-1 pt-5" style="color: white;">Contact Us.</h1> 
</div>

<div class="container">
	<?= $this->session->flashdata('message');?>
	<?= form_open('shop/addContact');?>
	<p>Got something to share with us? Send us a message!</p>
	
	<?php echo form_error('full_name'); ?>
	<label>Full Name</label>
	<input type="text" class="form-control" name="full_name" value="<?= set_value('full_name'); ?>"/>
	
	<?php echo form_error('e-mail'); ?>
	<label>Email</label>
	<input type="email" class="form-control" name="e-mail" value="<?= set_value('e-mail'); ?>"/>
	
	<?php echo form_error('message'); ?>
	<label>Message</label>
	<textarea class="form-control" name="message"><?= set_value('message'); ?></textarea>
	<br>
	<input type="submit" value="Submit" class="btn btn-primary form-control"/>
	<?= form_close(); ?>
</div>