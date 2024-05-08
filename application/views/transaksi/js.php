<script>
	$("#pilihproduk").select2({
		width: '100%'
	});
	$(document).ready(function() {
		$('#pilihproduk').on('change', function() {

			var data_id = $(this).val();
			$.ajax({
				url:"<?php echo base_url() ?>/transaksi/getDataProduk",
				data:"data_id="+data_id,
				method:'post',
				dataType:'json',
				success:function(data){
					alert('ok');
				}
			})
		});
	});
</script>
