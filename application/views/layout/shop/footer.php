
		<!-- Footer -->
		<footer class="py-5 mt-5 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; eShop Sdn. Bhd. 2017</p>
			</div>
			<!-- /.container -->
		</footer>

		<?php include ('logout.php')?>

		<!-- Bootstrap core JavaScript -->
		<script src="<?php echo base_url();?>style/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url();?>style/vendor/popper/popper.min.js"></script>
		<script src="<?php echo base_url();?>style/js/shop.js"></script>
		<script src="<?php echo base_url();?>style/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">

			function selectCategory(categoryID, categoryName) {
				$.get("<?= site_url('Product/selectProductCategory')?>", { 'categoryID' : categoryID }, function(data){
						var string = "<h4>Search result for category \""+categoryName+"\"...</h4>";
						string += "<div class='row'>";
						for(var i = 0; i < data.length; i++) {
							string += "<div class='col-lg-4 col-md-6 mb-4'>"
								+ "<div class='card h-100'>"
									+ "<a href='<?= base_url(); ?>index.php/Shop/product'><img class='card-img-top' src='http://placehold.it/700x400' alt=''></a>"
									+ "<div class='card-body'>"
										+ "<h5 class='card-title'>"
											+ "<a href='<?= base_url(); ?>index.php/Shop/product'>"+data[i]['product_name']+"</a>"
										+ "</h5>"
										+ "<h6>"
											+ "B$ "+data[i]['price']+""
										+ "</h6>"
										+ "<p class='card-text'>"+data[i]['description']+"</p>"
									+ "</div>"
									+ "<div class='card-footer'>"
										+ "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>"
										+ "<button class='pull-right btn btn-block btn-primary' type='button'>"
											+ "<span class='fa fa-shopping-cart pull-left'></span>"
											+ "Add to cart"
										+ "</button>"
									+ "</div>"
								+ "</div>"
							+ "</div>";
						}
						string += "</div>";
							$("#content").html(string);
				}, 'json');
			}

			$(document).ready(function(){
				$("#search").keyup(function() {
					var search = $("#search").val();
					$.get("<?php echo base_url(); ?>index.php/Product/searchProduct", { 'search' : search }, function(data) {
						var string = "<h4>Search result for "+search+"...</h4>";
						string += "<div class='row'>";
						for(var i = 0; i < data.length; i++) {
							string += "<div class='col-lg-4 col-md-6 mb-4'>"
								+ "<div class='card h-100'>"
									+ "<a href='<?= base_url(); ?>index.php/Shop/product'><img class='card-img-top' src='http://placehold.it/700x400' alt=''></a>"
									+ "<div class='card-body'>"
										+ "<h5 class='card-title'>"
											+ "<a href='<?= base_url(); ?>index.php/Shop/product'>"+data[i]['product_name']+"</a>"
										+ "</h5>"
										+ "<h6>"
											+ "B$ "+data[i]['price']+""
										+ "</h6>"
										+ "<p class='card-text'>"+data[i]['description']+"</p>"
									+ "</div>"
									+ "<div class='card-footer'>"
										+ "<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>"
										+ "<button class='pull-right btn btn-block btn-primary' type='button'>"
											+ "<span class='fa fa-shopping-cart pull-left'></span>"
											+ "Add to cart"
										+ "</button>"
									+ "</div>"
								+ "</div>"
							+ "</div>";
						}
						string += "</div>";
							$("#content").html(string);
					}, 'json');
				});
			});
		</script>

	</body>

</html>