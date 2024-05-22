<script>
	function edit(id) {
		// alert(id);
		$.ajax({
			type: 'post',
			url: "<?= site_url('Test/formedit') ?>",
			data: {
				id: id
			},
			dataType: "json",
			success: function(response) {
				$('#judulHtml').html('Edit Data');
				$('#tambahmodal').modal('show');
				$('#kode_produk').val(response['kode_produk']);
				$('#nama').val(response['nama']);
				$('#harga').val(response['harga']);
				$('.statuss').val(response['status']).change();
				$('#id').val(response['id']);
				// alert(response['nama']);
			}
		});
	}

	function hapus(id) {
		Swal.fire({
			title: 'Hapus',
			text: `Yakin menghapus produk dengan id =${id} ?`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= site_url('Test/hapus') ?>",
					data: {
						id: id,
					},
					dataType: "json",
					success: function(response) {
						if (response.sukses) {
							Swal.fire({
								icon: 'success',
								title: 'Konfirmasi',
								text: response.sukses
							});
							tampildata();
						}
					}
				});
			}
		})
	}

	function tampildata() {
		table = $('#datatable2').DataTable({
			responsive: true,
			destroy: true,
			processing: true,
			serverSide: true,
			ajax: {
				url: "<?= site_url('Test/ambildata') ?>",
				type: "POST"
			},


		});
	}

	$(document).ready(function() {

		tampildata();

		$('#centangSemua').click(function(e) {
			if ($(this).is(':checked')) {
				$(".centangId").prop("checked", true);
			} else {
				$(".centangId").prop("checked", false);
			}
		});
		$('.formhapus').submit(function(e) {
			e.preventDefault();

			let jmldata = $('.centangId:checked');

			if (jmldata.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'Perhatian',
					text: 'Maaf tidak ada yang bisa dihapus, silahkan dicentang !'
				})
			} else {
				Swal.fire({
					title: 'Hapus Data',
					text: `Ada ${jmldata.length} data produk yang akan dihapus, yakin ?`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Hapus',
					cancelButtonText: 'Tidak'
				}).then((result) => {
					if (result.value) {
						// console.log($(this).serialize())
						$.ajax({
							type: "post",
							url: $(this).attr('action'),
							data: $(this).serialize(),
							dataType: "json",
							success: function(response) {
								if (response.sukses) {
									Swal.fire({
										icon: 'success',
										title: 'Berhasil',
										text: response.sukses
									})
									tampildata();
								}
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(xhr.status + "\n" + xhr.responseText + "\n" +
									thrownError);
							}
						});
					}
				})
			}
			return false;
		});


		$('#tomboltambah').click(function() {
			$('#kode_produk').val('');
			$('#nama').val('');
			$('#harga').val('');
			$('#id').val('');
			$('.statuss').val('').change();
			// $('.statuss select option[value=""]').attr("selected", true);
			$('#judulHtml').html('Tambah Data');
			$('#tambahmodal').modal('show');
		});


		$('.formsimpan').submit(function(e) {
			// alert($(this).attr('action'));
			$.ajax({
				type: "post",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: "json",
				success: function(response) {
					if (response.error) {
						$('.pesan').html(response.error).show();
					}
					if (response.sukses) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: response.sukses
						});
						tampildata();
						$('#tambahmodal').modal('hide');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
			return false;
		});
	});
</script>
