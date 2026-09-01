<?php
/**
 * Shared by add_product and edit_product.
 *
 * @var App\Entities\Product|null $product    Null when adding.
 * @var list<App\Entities\Category> $categories Top level categories with their children.
 * @var string $action Form target.
 * @var string $submitLabel
 */
$product ??= null;
$currentImage = $product?->image_path ?? 'style/assets/images/no_image.png';
?>
<?= form_open_multipart($action, ['class' => 'form-horizontal']) ?>
	<div class="card mb-3">
		<div class="card-header"><?= esc($submitLabel) ?> Product</div>
		<div class="card-body">
			<div class="form-group">
				<label class="control-label">Image</label>
				<div class="row">
					<div class="col-md-4">
						<img src="<?= base_url($currentImage) ?>" id="productImage" class="img-thumbnail">
						<input type="file" accept="image/*" name="image" onchange="previewImage(this)">
						<?php if ($product !== null) : ?>
							<small class="form-text text-muted">Leave empty to keep the current picture.</small>
						<?php endif ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label" for="name">Product Name</label>
				<input id="name" type="text" class="form-control" name="name" value="<?= set_value('name', $product->name ?? '') ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label" for="price">Price</label>
				<input id="price" type="number" step="0.01" min="0.01" class="form-control" name="price" value="<?= set_value('price', $product->price ?? '') ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label" for="short_description">Short Description</label>
				<input id="short_description" type="text" class="form-control" name="short_description" maxlength="50" value="<?= set_value('short_description', $product->short_description ?? '') ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label" for="description">Long Description</label>
				<textarea id="description" name="description" class="form-control" rows="8"><?= set_value('description', $product->description ?? '') ?></textarea>
			</div>

			<div class="form-group">
				<label class="control-label" for="category_id">Category</label>
				<select id="category_id" class="form-control" name="category_id" required>
					<?php foreach ($categories as $category) : ?>
						<?php foreach ($category->children as $child) : ?>
							<option value="<?= $child->id ?>" <?= (int) set_value('category_id', $product->category_id ?? 0) === $child->id ? 'selected' : '' ?>>
								<?= esc($category->name) ?>: <?= esc($child->name) ?>
							</option>
						<?php endforeach ?>
					<?php endforeach ?>
				</select>
			</div>

			<button type="submit" class="btn btn-primary btn-block"><?= esc($submitLabel) ?></button>
		</div>
	</div>
<?= form_close() ?>

<script>
	function previewImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#productImage').attr('src', e.target.result).width(300).height(300);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
