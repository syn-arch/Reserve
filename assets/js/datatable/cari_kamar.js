$(function(){

	const kamarTable = $('#table-tambah-kamar').dataTable({ 
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
				return `
				<button class="btn btn-info tambah_kamar" data-id="${data}"><i class="fa fa-plus"></i></button>
				`
			}
		}
		],
	})

})