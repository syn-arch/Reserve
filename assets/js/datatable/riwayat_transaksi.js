$(function(){

	const transaksiTable = $('#table-transaksi').dataTable({ 
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url + "transaksi/get_transaksi_json",
			"type": "POST"
		},
		"columns": [
		{"data" : "id"},
		{"data": "tgl_transaksi"},
		{"data": "nama_pengunjung"},
		{"data": "alamat"},
		{
			"data": "total_bayar",
			render: $.fn.dataTable.render.number( '.', '.', 0, '')
		},
		{
			"data": "cash",
			render: $.fn.dataTable.render.number( '.', '.', 0, '')
		},
		{
			"data": "kembalian",
			"render" : function(data, type, row) {
				return row.cash - row.total_bayar
			}
			// render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp. ')
		},
		{
			"data": "id",
			"render" : function(data, type, row) {
				return `<a title="invoice" class="btn btn-info" href="${base_url}transaksi/invoice/${data}"><i class="fa fa-eye"></i></a>
				<a title="ubah" class="btn btn-warning" href="${base_url}transaksi/ubah/${data}"><i class="fa fa-edit"></i></a>
				<a title="hapus" class="btn btn-danger hapus_transaksi" data-href="${base_url}transaksi/hapus/${data}"><i class="fa fa-trash"></i></a>`
			}
		}
		],
	})

	$(document).on('click', '.hapus_transaksi', function(){
		hapus($(this).data('href'))
	})

})