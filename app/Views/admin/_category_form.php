<?php
/**
 * Shared by add_category and manage_category.
 *
 * @var App\Entities\Category|null   $category Null when adding.
 * @var list<App\Entities\Category>  $parents  Top level categories.
 * @var string $action
 * @var string $submitLabel
 */
$category ??= null;
$selectedParent = (int) set_value('parent_id', $category->parent_id ?? 0);
?>
<?= form_open($action, ['class' => 'form-horizontal']) ?>
	<div class="card mb-3">
		<div class="card-header"><?= esc($submitLabel) ?> Category</div>
		<div class="card-body">
			<div class="form-group">
				<label class="control-label" for="name">Category Name</label>
				<input id="name" type="text" class="form-control" name="name" value="<?= set_value('name', $category->name ?? '') ?>" required>
			</div>

			<div class="form-group">
				<label class="control-label" for="parent_id">Parent Category</label>
				<select id="parent_id" class="form-control" name="parent_id">
					<option value="0" <?= $selectedParent === 0 ? 'selected' : '' ?>>No Parent</option>
					<?php foreach ($parents as $parent) : ?>
						<?php if ($category !== null && $parent->id === $category->id) { continue; // a category cannot be its own parent ?>
						<?php } ?>
						<option value="<?= $parent->id ?>" <?= $selectedParent === $parent->id ? 'selected' : '' ?>>
							<?= esc($parent->name) ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<button type="submit" class="btn btn-primary btn-block"><?= esc($submitLabel) ?></button>
		</div>
	</div>
<?= form_close() ?>
