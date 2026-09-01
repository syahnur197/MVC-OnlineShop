		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content-wrapper -->

	<footer class="sticky-footer">
		<div class="container">
			<div class="text-center"><small>Copyright &copy; Awesome eStore</small></div>
		</div>
	</footer>

	<a class="scroll-to-top rounded" href="#page-top"><i class="fa fa-angle-up"></i></a>

	<?= $this->include('layout/_logout_modal') ?>

	<script src="<?= base_url('style/vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('style/vendor/popper/popper.min.js') ?>"></script>
	<script src="<?= base_url('style/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('style/js/jquery.easing.min.js') ?>"></script>
	<script src="<?= base_url('style/vendor/datatables/jquery.dataTables.js') ?>"></script>
	<script src="<?= base_url('style/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>
	<script src="<?= base_url('style/js/sb-admin.min.js') ?>"></script>
	<script src="<?= base_url('style/js/sb-admin-datatables.min.js') ?>"></script>
	<script>
		// Only turn the description box into a rich text editor when there is one.
		if (typeof CKEDITOR !== 'undefined' && document.querySelector('textarea[name="description"]')) {
			CKEDITOR.replace('description');
		}

		window.setTimeout(function () {
			$('.alert').fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
		}, 6000);
	</script>
</body>
</html>
