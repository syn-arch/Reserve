$(function(){

	function updateTotal()
	{
		let total = 0;
		$(document).find('.total_harga').each(function (index, element) {
			total += parseInt($(element).val());
		});
		$('.total_bayar').val(total);
	}

	function updateKembalian()
	{
		const cash = $('.cash').val();
		const total_bayar = $('.total_bayar').val();
		const kembalian = parseInt(cash) - parseInt(total_bayar);
		$('.kembalian').val(kembalian);
	}

	$(document).on('click', '.tambah_kamar', function(){
		const id = $(this).data('id');
		$.get(`${base_url}kamar/get_kamar/${id}`, function(res){
			const data = JSON.parse(res);

			$('.detail-kamar').append(`
				<tr data-id=${data.id_kamar}>
				<td><input readonly type="text" name="id_kamar[]" value="${data.id_kamar}" class="form-control"></td>
				<td><input readonly type="text" name="harga[]" value="${data.harga}" class="form-control harga"></td>
				<td><input required type="number" name="diskon[]" value="0" class="form-control diskon" placeholder="Diskon"></td>
				<td><input required type="number" name="qty[]" value="1" class="form-control qty" placeholder="Qty"></td>
				<td><input readonly type="text" name="total_harga[]" value="${data.harga}" class="form-control total_harga"></td>
				<td>
				<a data-id="${data.id_kamar}" class="btn btn-danger hapus_detail_kamar"><i class="fa fa-trash"></i></a>
				</td>
				</tr>
				`);
			updateTotal();
			updateKembalian();
			
		});
		$('#modal-kamar').modal('hide');
	});

	$(document).on('keyup', '.diskon', function(){
		const diskon = $(this).val();
		const harga = $(this).closest('tr').find('.harga').val();
		let qty = $(this).closest('tr').find('.qty').val();

		(isNaN(qty)) ? qty_1 =  1 : qty_1 = qty;
		(isNaN(diskon)) ? diskon_1 =  0 : diskon_1 = diskon;

		let total_harga = parseInt(qty_1) * (parseInt(harga) - parseInt(diskon_1));

		(isNaN(total_harga)) ? total =  harga : total = total_harga;

		$(this).closest('tr').find('.total_harga').val(total);

		updateTotal();
		updateKembalian()
	});

	$(document).on('keyup', '.qty', function(){
		const qty = $(this).val();
		const harga = $(this).closest('tr').find('.harga').val();
		let diskon = $(this).closest('tr').find('.diskon').val();

		(isNaN(diskon)) ? diskon_1 =  0 : diskon_1 = diskon;
		(isNaN(qty)) ? qty_1 =  1 : qty_1 = qty;

		let total_harga = parseInt(qty_1) * (parseInt(harga) - parseInt(diskon_1));

		(isNaN(total_harga)) ? total = harga : total = total_harga;

		$(this).closest('tr').find('.total_harga').val(total);

		updateTotal();
		updateKembalian()
	});

	$('.cash').keyup(function(){
		const cash = $(this).val();
		const total_bayar = $('.total_bayar').val();
		const kembalian = parseInt(cash) - parseInt(total_bayar);
		$('.kembalian').val(kembalian);
	})

	$(document).on('click', '.hapus_detail_kamar', function(){
		$(this).closest('tr').remove();	
		updateTotal();
		updateKembalian()
	});

	$('.list_pengunjung').select2({
		minimumInputLength: 3,
		allowClear: true,
		placeholder: 'Nama pelanggan',
		ajax: {
			dataType: 'json',
			url: base_url+'pengunjung/list_pengunjung',
			delay: 800,
			data: function(params) {
				return {
					search: params.term
				}
			},
			processResults: function (data, page) {
				return {
					results: $.map(data, function(obj) {
						return {
							id: obj.id,
							text: obj.text
						};
					})
					// results: data.items
				};
			},
		}
	});

});