<!-- General JS Scripts -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script> -->

<script src="<?= base_url();?>assets/modules/jquery.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js'></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="<?= base_url();?>assets/modules/popper.js"></script>
<script src="<?= base_url();?>assets/modules/tooltip.js"></script>
<script src="<?= base_url();?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url();?>assets/modules/moment.min.js"></script>
<script src="<?= base_url();?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<!-- <script src="<?= base_url();?>assets/modules/summernote/summernote-bs4.js"></script> -->
<script src="<?= base_url();?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="<?= base_url();?>assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url();?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url();?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<script src="<?= base_url();?>assets/modules/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url();?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url();?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url();?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<!-- <script src="<?= base_url();?>assets/modules/jquery.sparkline.min.js"></script> -->
<!-- <script src="<?= base_url();?>assets/modules/chart.min.js"></script> -->
<!-- <script src="<?= base_url();?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script> -->

<script src="<?=base_url();?>assets/modules/summernote/summernote.min.js"></script>
<script>

		var option = {
        tabsize: 2,
        height: 400,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    };

		$(document).ready(function() {
			$('#content').summernote(option);
			$('#e_content').summernote(option);
			$('#how_to').summernote(option);
			$('#e_how_tot').summernote(option);
			$('#description').summernote(option);
			$('#e_description').summernote(option);
		});
	</script>


<!-- Page Specific JS File -->

<script type="text/javascript">
  $(document).ready(function() {
    $(".inputtags").tagsinput('items');
  })
</script>
<script src="<?= base_url();?>assets/js/page/modules-sweetalert.js"></script>
<script src="<?= base_url();?>assets/js/page/modules-datatables.js"></script>


<!-- Template JS File -->
<script src="<?= base_url();?>assets/js/scripts.js"></script>
<script src="<?= base_url();?>assets/js/custom.js"></script>

