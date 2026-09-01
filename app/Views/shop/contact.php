<div class="jumbotron center" style="min-height:350px; background:linear-gradient(rgba(0,0,0,.8), rgba(0,0,0,.8)), url('<?= base_url('style/assets/images/contact.jpeg') ?>') no-repeat center center fixed; background-size:cover;">
	<h1 class="text-center display-1 pt-5" style="color:white">Contact Us.</h1>
</div>

<div class="container">
	<?= $this->include('layout/_alerts') ?>

	<?= form_open(site_url('shop/contact')) ?>
		<p>Got something to share with us? Send us a message.</p>

		<div class="form-group">
			<label for="name">Full Name</label>
			<input type="text" id="name" class="form-control" name="name" value="<?= set_value('name') ?>" required>
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" id="email" class="form-control" name="email" value="<?= set_value('email') ?>" required>
		</div>

		<div class="form-group">
			<label for="body">Message</label>
			<textarea id="body" class="form-control" name="body" rows="5" required><?= set_value('body') ?></textarea>
		</div>

		<button type="submit" class="btn btn-primary btn-block">Submit</button>
	<?= form_close() ?>
</div>
