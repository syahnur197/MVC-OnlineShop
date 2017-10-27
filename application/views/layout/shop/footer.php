
	<div class="modal fade" id="alert_modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_title">></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_body">
				<p>Modal body text goes here.</p>
			</div>
			<div class="modal-footer" id="modal_footer">
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
			</div>
		</div>
	</div>

	
		<!-- Footer -->
		<footer class="py-5 mt-5 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; eShop Sdn. Bhd. 2017</p>
			</div>
			<!-- /.container -->
		</footer>

		<?php include ('logout.php') ?>

		<!-- Bootstrap core JavaScript -->
		<script src="<?php echo base_url();?>style/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url();?>style/vendor/popper/popper.min.js"></script>
		<script src="<?php echo base_url();?>style/js/shop.js"></script>
		<script src="<?php echo base_url();?>style/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">

			function selectCategory(categoryID, categoryName) {
				$.get("<?= site_url('Product/selectProductCategory')?>", { 'categoryID' : categoryID }, function(data){

					console.log(data);
					var string = "<h4>Search result for category \""+categoryName+"\"...</h4>";
					string += "<div class='row'>";
					for(var i = 0; i < data.length; i++) {
						string += "<div class='col-lg-4 col-md-6 mb-4'>"
							+ "<div class='card h-100'>"
								+ "<a href='<?= base_url(); ?>index.php/Shop/product/"+data[i]['product_id']+"'>"
									+ "<img class='card-img-top' src='<?= base_url();?>/"+data[i]['image_link']+"' alt='' height='300px'>"
									+ "<div class='card-body'>"
									+ "<h5 class='card-title'>"
									+ "<a href='<?= base_url(); ?>index.php/Shop/product/"+data[i]['product_id']+"'>"+data[i]['product_name']+"</a>"
									+ "</h5>"
									+ "<h6>"
									+ "B$ "+data[i]['price']+""
									+ "</h6>"
									+ "<p class='card-text'>"+data[i]['short_desc']+"</p>"
									+ "</div>"
									+ "<div class='card-footer'>"
									+ "<input type='number' name='quantity' class='form-control' placeholder='Quantity' id='quantity_"+data[i]['product_id']+"' />"
									+ "<input type='hidden' name='product_id' class='form-control' value='"+data[i]['product_id']+"'/>"
									+ "<br>"
									+ "<button class='pull-right btn btn-block btn-primary' type='button' onclick='addToCart("+data[i]['product_id']+")'>"
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
									$.get("<?php echo base_url(); ?>index.php/Product/searchActiveProduct", { 'search' : search }, function(data) {
										var string = "<h4>Search result for "+search+"...</h4>";
										string += "<div class='row'>";
										for(var i = 0; i < data.length; i++) {
											string += "<div class='col-lg-4 col-md-6 mb-4'>"
											+ "<div class='card h-100'>"
												+ "<a href='<?= base_url(); ?>index.php/Shop/product/"+data[i]['product_id']+"'>"
													+ "<img class='card-img-top' src='<?= base_url();?>/"+data[i]['image_link']+"' alt='' height='300px'>"
													+ "<div class='card-body'>"
													+ "<h5 class='card-title'>"
													+ "<a href='<?= base_url(); ?>index.php/Shop/product/"+data[i]['product_id']+"'>"+data[i]['product_name']+"</a>"
													+ "</h5>"
													+ "<h6>"
													+ "B$ "+data[i]['price']+""
													+ "</h6>"
													+ "<p class='card-text'>"+data[i]['short_desc']+"</p>"
													+ "</div>"
													+ "<div class='card-footer'>"
													+ "<input type='number' name='quantity' class='form-control' placeholder='Quantity' id='quantity_"+data[i]['product_id']+"' />"
													+ "<input type='hidden' name='product_id' class='form-control' value='"+data[i]['product_id']+"'/>"
													+ "<br>"
													+ "<button class='pull-right btn btn-block btn-primary' type='button' onclick='addToCart("+data[i]['product_id']+")'>"
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

		<script type="text/javascript">
	//set timer for alert messages
		window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>

	</body>

</html>