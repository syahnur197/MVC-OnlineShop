<?php
/**
 * The line items of one cart or order. Shared by view_cart and view_order.
 *
 * @var list<App\Entities\CartItem> $items
 * @var float $total
 */
?>
<div class="table-responsive">
	<table class="table table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>No</th>
				<th>Product</th>
				<th class="text-right">Unit Price</th>
				<th class="text-right">Quantity</th>
				<th class="text-right">Price</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $index => $item) : ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td>
						<a href="<?= site_url('shop/product/' . $item->product_id) ?>"><?= esc($item->name) ?></a>
					</td>
					<td class="text-right">B$ <?= esc(number_format($item->price, 2)) ?></td>
					<td class="text-right"><?= esc($item->quantity) ?></td>
					<td class="text-right">B$ <?= esc(number_format($item->subtotal, 2)) ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td colspan="4" class="text-right"><strong>Total</strong></td>
				<td class="text-right"><strong>B$ <?= esc(number_format($total, 2)) ?></strong></td>
			</tr>
		</tbody>
	</table>
</div>
