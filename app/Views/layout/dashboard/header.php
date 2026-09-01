<?php
/** Shared by both panels: the admin dashboard and the customer account area. */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= esc($title ?? '') ?></title>

	<link href="<?= base_url('style/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('style/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('style/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">
	<link href="<?= base_url('style/css/sb-admin.css') ?>" rel="stylesheet">
	<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
