<footer class="sticky-footer">
<div class="container">
  <div class="text-center">
    <small>Copyright © Awesome eStore 2017</small>
  </div>
</div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fa fa-angle-up"></i>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url();?>style/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>style/vendor/popper/popper.min.js"></script>
<script src="<?php echo base_url();?>style/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo base_url();?>style/js/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url();?>style/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url();?>style/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>style/vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url();?>style/js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="<?php echo base_url();?>style/js/sb-admin-datatables.min.js"></script>
<script src="<?php echo base_url();?>style/js/sb-admin-charts.min.js"></script>
</div>
</body>

</html>
<script src="<?php echo base_url();?>style/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>style/vendor/popper/popper.min.js"></script>
<script src="<?php echo base_url();?>style/js/shop.js"></script>
<script src="<?php echo base_url();?>style/vendor/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
		window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>

<script>
$(".nospace").on("keydown", function (e) {
    return e.which !== 32;
});
</script>