	<div class="modal fade" id="alertModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="alertModalTitle"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body" id="alertModalBody"></div>
				<div class="modal-footer" id="alertModalFooter"></div>
			</div>
		</div>
	</div>

	<footer class="py-5 mt-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Awesome eStore</p>
		</div>
	</footer>

	<?= $this->include('layout/_logout_modal') ?>

	<script src="<?= base_url('style/vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('style/vendor/popper/popper.min.js') ?>"></script>
	<script src="<?= base_url('style/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script>
		var shop = {
			addToCartUrl: <?= json_encode(site_url('user/cart/add')) ?>,
			searchUrl: <?= json_encode(site_url('products/search')) ?>,
			categoryUrl: <?= json_encode(site_url('products/category')) ?>,
			loggedIn: <?= json_encode(service('auth')->isCustomer()) ?>,
			loginUrl: <?= json_encode(site_url('account')) ?>,
			cartUrl: <?= json_encode(site_url('user/your_cart')) ?>,
			csrfName: <?= json_encode(csrf_token()) ?>,
			csrfHash: <?= json_encode(csrf_hash()) ?>
		};
	</script>
	<script src="<?= base_url('style/js/shop.js') ?>"></script>
</body>
</html>
