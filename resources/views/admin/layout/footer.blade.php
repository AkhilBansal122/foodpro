<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date('Y')?>. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<!-- Bootstrap JS -->
	<script src="{{asset('/public/admin/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('/public/admin/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('/public/admin/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>



	<script src="{{asset('/public/admin/assets/plugins/input-tags/js/tagsinput.js')}}"></script>


	<script src="{{asset('/public/admin/assets/plugins/select2/js/select2.min.js')}}"></script>

	<script src="{{asset('/public/admin/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('/public/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

	<!--Ckediter-->
	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">

	<script src="{{asset('/public/admin/assets/plugins/chartjs/chart.min.js')}}"></script>
      <script src='{{asset("/public/admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js")}}'></script> 


 <script src="{{asset('/public/admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script> 
	 <script src="{{asset('/public/admin/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script> 




	 <script src="{{asset('/public/admin/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script> 
	 <script src="{{asset('/public/admin/assets/plugins/jquery-knob/excanvas.js')}}"></script> 
	 <script src="{{asset('/public/admin/assets/plugins/jquery-knob/jquery.knob.js')}}"></script> 


	<script src="{{asset('/public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	// <script src="{{asset('/public/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>


	<script src="{{asset('/public/admin/assets/js/customAdmin.js')}}"></script>

	
	<script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
	
	<script>
	
		tinymce.init({
		  selector: '#mytextarea'
		});
		tinymce.init({
		  selector: '#mytextarea2'
		});
		
	</script>
	
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{asset('/public/admin/assets/js/index.js')}}"></script>
	
	<script src="{{asset('/public/admin/assets/js/app.js')}}"></script>
	<script src="{{asset('/public/admin/assets/plugins/chartjs/custom-script.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



</body>


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 05:30:32 GMT -->
</html>
