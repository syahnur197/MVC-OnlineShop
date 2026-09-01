/*
 * Shop front behaviour. The URLs, the CSRF token and whether somebody is logged in
 * are handed over by the page in the global `shop` object, defined in
 * app/Views/layout/shop/footer.php.
 */
$(function () {

	$('.list-group-item').on('click', function () {
		$('.fa', this)
			.toggleClass('fa-chevron-right')
			.toggleClass('fa-chevron-down');
	});

	// Live search. Empty box puts the original page content back.
	var originalContent = null;

	$('#search').on('keyup', function () {
		var term = $.trim($(this).val());

		if (originalContent === null) {
			originalContent = $('#content').html();
		}

		if (term === '') {
			$('#content').html(originalContent);
			return;
		}

		$.getJSON(shop.searchUrl, { q: term }, function (products) {
			$('#content').html(renderResults('Search results for "' + term + '"', products));
		});
	});
});

function selectCategory(categoryId, categoryName) {
	$.getJSON(shop.categoryUrl + '/' + categoryId, function (products) {
		$('#content').html(renderResults('Category: ' + categoryName, products));
	});
}

function addToCart(productId) {
	var quantity = parseInt($('#quantity_' + productId).val(), 10);

	if (!shop.loggedIn) {
		return showAlert('Please log in', 'You need a customer account to add products to a cart.',
			'<a class="btn btn-success" href="' + shop.loginUrl + '">Log in</a>' + closeButton());
	}

	if (isNaN(quantity) || quantity < 1) {
		return showAlert('Warning', 'Please enter a quantity of at least 1.', closeButton());
	}

	var payload = { product_id: productId, quantity: quantity };
	payload[shop.csrfName] = shop.csrfHash;

	$.post(shop.addToCartUrl, payload, function (data) {
		// CSRF tokens are single use, so keep the fresh one for the next request.
		if (data.csrfHash) {
			shop.csrfHash = data.csrfHash;
		}

		showAlert(
			data.title,
			data.message,
			data.success
				? '<a class="btn btn-success" href="' + shop.cartUrl + '">Go to cart</a>' + closeButton()
				: closeButton()
		);
	}, 'json').fail(function (xhr) {
		var body = xhr.responseJSON || {};
		showAlert(body.title || 'Something went wrong', body.message || 'Please try again.', closeButton());
	});
}

function renderResults(heading, products) {
	if (products.length === 0) {
		return '<h4>' + escapeHtml(heading) + '</h4><p>No products matched.</p>';
	}

	var html = '<h4>' + escapeHtml(heading) + '</h4><div class="row">';

	products.forEach(function (product) {
		html += '<div class="col-lg-4 col-md-6 mb-4">'
			+ '<div class="card h-100">'
			+ '<a href="' + product.url + '">'
			+ '<img class="card-img-top" src="' + product.image + '" alt="" height="300px">'
			+ '</a>'
			+ '<div class="card-body">'
			+ '<h5 class="card-title"><a href="' + product.url + '">' + escapeHtml(product.name) + '</a></h5>'
			+ '<h6>B$ ' + escapeHtml(product.price) + '</h6>'
			+ '<p class="card-text">' + escapeHtml(product.short_description) + '</p>'
			+ '</div>'
			+ '<div class="card-footer">'
			+ '<input type="number" min="1" class="form-control" placeholder="Quantity" id="quantity_' + product.id + '">'
			+ '<br>'
			+ '<button class="btn btn-block btn-primary" type="button" onclick="addToCart(' + product.id + ')">'
			+ '<span class="fa fa-shopping-cart pull-left"></span> Add to cart'
			+ '</button>'
			+ '</div></div></div>';
	});

	return html + '</div>';
}

function showAlert(title, message, footer) {
	$('#alertModalTitle').text(title);
	$('#alertModalBody').text(message);
	$('#alertModalFooter').html(footer);
	$('#alertModal').modal('show');
}

function closeButton() {
	return '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
}

function escapeHtml(value) {
	return $('<div>').text(value === null || value === undefined ? '' : value).html();
}
