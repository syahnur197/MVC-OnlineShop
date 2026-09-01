<div class="content-wrapper">
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Dashboard</a></li>
			<li class="breadcrumb-item active">Read Message</li>
		</ol>

		<?= $this->include('layout/_alerts') ?>

		<div class="card mb-3">
			<div class="card-header">Message</div>
			<div class="card-body">
				<label><strong>Full Name</strong></label>
				<p><?= esc($message->name) ?></p>

				<label><strong>E-Mail</strong></label>
				<p><a href="mailto:<?= esc($message->email, 'attr') ?>"><?= esc($message->email) ?></a></p>

				<label><strong>Message</strong></label>
				<p><?= nl2br(esc($message->body)) ?></p>
			</div>
			<div class="card-footer">
				<i class="fa fa-clock-o"></i> <?= esc($message->created_at?->format('d M Y H:i') ?? '-') ?>
			</div>
		</div>
