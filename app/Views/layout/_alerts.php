<?php
/**
 * Renders the flash messages set with ->with('success', ...) or ->with('error', ...).
 * Messages are plain text and escaped here, except the validation summaries the
 * controllers build with BaseController::errorList(), which arrive as markup.
 */
?>
<?php if (session()->has('success')) : ?>
	<div class="alert alert-success alert-dismissible mt-3" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?= esc(session('success')) ?>
	</div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
	<?php $error = session('error') ?>
	<?php if (str_starts_with((string) $error, '<div')) : ?>
		<div class="mt-3"><?= $error // Already-built markup from BaseController::errorList(). ?></div>
	<?php else : ?>
		<div class="alert alert-danger alert-dismissible mt-3" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= esc($error) ?>
		</div>
	<?php endif ?>
<?php endif ?>
