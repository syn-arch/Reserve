<section class="invoice">
	<!-- title row -->
	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-shopping-cart"></i> INVOICE
				<small class="pull-right">Tanggal: <?php echo date('d-m-Y', strtotime($transaksi['tgl_transaksi'])) ?></small>
			</h2>
		</div>
		<!-- /.col -->
	</div>
	<!-- info row -->
	<div class="row invoice-info">
		<div class="col-sm-4 invoice-col">
			<address>
				<strong>Kasir : <?php echo $transaksi['nama_petugas'] ?></strong><br>
				<strong>Pengunjung : <?php echo $transaksi['nama_pengunjung'] ?></strong><br>
			</address>
		</div>
	</div>
	<!-- /.row -->

	<!-- Table row -->
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Kamar</th>
						<th>Nama Kamar</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Qty</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$this->db->join('kamar', 'id_kamar');
					$barang =  $this->db->get_where('detail_transaksi', ['id_transaksi' => $transaksi['id']])->result_array();
					foreach ($barang as $row) : ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['id_kamar'] ?></td>
							<td><?php echo $row['nama_kamar'] ?></td>
							<td><?php echo "Rp. " . number_format($row['harga']) ?></td>
							<td><?php echo "Rp. " . number_format($row['diskon']) ?></td>
							<td><?php echo $row['qty'] ?></td>
							<td><?php echo "Rp. " . number_format($row['total_harga']) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">
		</div>
		<!-- /.col -->
		<div class="col-xs-6">
			<p class="lead">Pembayaran</p>

			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<th>Total Bayar</th>
							<td><?php echo "Rp. " . number_format($transaksi['total_bayar']) ?></td>
						</tr>
						<tr>
							<th>Cash</th>
							<td><?php echo "Rp. " . number_format($transaksi['cash']) ?></td>
						</tr>
						<tr>
							<th>Kembalian</th>
							<td><?php echo "Rp. " . number_format($transaksi['cash'] - $transaksi['total_bayar']) ?></td>
						</tr>
					</tbody></table>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- this row will not appear when printing -->
		<div class="row no-print">
			<div class="col-xs-12">
				<a href="<?php echo base_url('transaksi/invoice_cetak/') . $transaksi['id'] ?>" type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Cetak</a>
				<a style="margin-right: 1em" href="<?php echo base_url('transaksi/tambah') ?>" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
			</div>
		</div>
	</section>