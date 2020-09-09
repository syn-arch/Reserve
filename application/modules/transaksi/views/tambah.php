<form method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="pull-left">
            <div class="box-title">
              <h4><?php echo $judul ?></h4>
            </div>
          </div>
          <div class="pull-right">
            <div class="box-title">
              <a href="<?php echo base_url('transaksi') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="id_petugas" value="<?php echo $this->session->userdata('id_petugas'); ?>">
              <div class="form-group <?php if(form_error('nama_petugas')) echo 'has-error'?>">
                <label for="nama_petugas">Nama Petugas</label>
                <input readonly="" type="text" id="nama_petugas" name="nama_petugas" class="form-control nama_petugas " placeholder="Nama Petugas" value="<?php echo $this->session->userdata('nama_petugas'); ?>">
                <?php echo form_error('nama_petugas', '<small style="color:red">','</small>') ?>
              </div>
              <div class="form-group <?php if(form_error('id_pengunjung')) echo 'has-error'?>">
                <label for="id_pengunjung">Pengunjung</label>
                <select name="id_pengunjung" id="id_pengunjung" class="form-control list_pengunjung" required="">
                  <option value="">-- Pilih Pengunjung --</option>
                </select>
                <?php echo form_error('id_pengunjung', '<small style="color:red">','</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group <?php if(form_error('tgl_transaksi')) echo 'has-error'?>">
                <label for="tgl_transaksi">Tanggal Transaksi</label>
                <input type="datetime-local" id="tgl_transaksi" name="tgl_transaksi" class="form-control tgl_transaksi " placeholder="Tanggal Transaksi" value="<?php echo set_value('tgl_transaksi') ?>" required>
                <?php echo form_error('tgl_transaksi', '<small style="color:red">','</small>') ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?>">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
              </div>
            </div>
          </div>
          <hr>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group input-group">
                  <input readonly="" data-toggle="modal" data-target="#modal-kamar"  type="text" class="form-control" placeholder="Cari Kamar">
                  <span class="input-group-btn">
                    <button type="button" data-toggle="modal" data-target="#modal-kamar" class="btn btn-info btn-flat"><i class="fa fa-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Kode Kamar</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Diskon</th>
                      <th>Total Harga</th>
                      <th><i class="fa fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody class="detail-kamar">
                   
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" style="text-align: right;">Rp. </td>
                      <td><input type="number" name="total_bayar" readonly="" class="form-control total_bayar"></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align: right;">Cash </td>
                      <td><input type="number" name="cash" class="form-control cash"></td>
                    </tr>
                    <tr>
                      <td colspan="4" style="text-align: right;">Kembalian </td>
                      <td><input type="number" readonly="" class="form-control kembalian"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <button type="submit" class="btn btn-danger btn-block">Konfirmasi</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal -->
<div class="modal fade" id="modal-kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Cari kamar</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table" id="table-tambah-kamar" width="100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>ID Kamar</th>
                    <th>Nama Kamar</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                    <th><i class="fa fa-cogs"></i></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>