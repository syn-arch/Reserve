$(function(){

	const pengunjungTable = $('#table-pengunjung').dataTable({ 
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url + "pengunjung/get_pengunjung_json",
			"type": "POST"
		},
		"columns": [
		{"data" : "id_pengunjung"},
		{"data": "tgl_pengunjung"},
		{"data": "nama_lembaga"},
		{"data": "nama_pengunjung"},
		{"data": "alamat"},
		{"data": "no_telp"},
		{"data": "no_fax"},
		{"data": "no_hp"},
		{"data": "email"},
		{"data": "status"},
		{
			"data": "id_pengunjung",
			"render" : function(data, type, row) {
				return `<a title="ubah" class="btn btn-warning" href="${base_url}pengunjung/ubah/${data}"><i class="fa fa-edit"></i></a>
				<a title="hapus" class="btn btn-danger hapus_pengunjung" data-href="${base_url}pengunjung/hapus/${data}"><i class="fa fa-trash"></i></a>`
			}
		}
		],
	})

	$(document).on('click', '.hapus_pengunjung', function(){
		hapus($(this).data('href'))
	})

})