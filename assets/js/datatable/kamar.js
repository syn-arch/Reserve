$(function(){

	const kamarTable = $('#table-kamar').dataTable({ 
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url + "kamar/get_kamar_json",
			"type": "POST"
		},
		"columns": [
		{"data" : "id"},
		{"data" : "id_kamar"},
		{"data": "nama_kamar"},
		{
			"data": "harga",
			render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp. ')
		},
		{"data": "keterangan"},
		{
			"data": "id_kamar",
			"render" : function(data, type, row) {
				return `<a title="ubah" class="btn btn-warning" href="${base_url}kamar/ubah/${data}"><i class="fa fa-edit"></i></a>
				<a title="hapus" class="btn btn-danger hapus_kamar" data-href="${base_url}kamar/hapus/${data}"><i class="fa fa-trash"></i></a>`
			}
		}
		],
	})

	$(document).on('click', '.hapus_kamar', function(){
		hapus($(this).data('href'))
	})

})