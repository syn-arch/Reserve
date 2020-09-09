const base_url = $('meta[name="base_url"]').attr('content');

// select2
$('.select2').select2()

// datatable
$('.datatable').dataTable();

// ubah akses role
$('.ubah_menu').click(function(){
	const id_menu = $(this).data('menu');
	const id_role = $(this).data('role');

	$.ajax({
		url : `${base_url}petugas/ubah_akses_role/${id_menu}/${id_role}`,
		method : 'post',
		success : function() {
			swal('Berhasil', 'Data berhasil diubah', 'success');
			window.location.reload(true)
		}
	})
})

// role
$(document).on('click', '.hapus_role', function(){
	hapus($(this).data('href'))
})