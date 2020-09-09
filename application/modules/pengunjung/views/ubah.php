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
                        <a href="<?php echo base_url('pengunjung') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
               <div class="row">
                <div class="col-md-2"></div>
                   <div class="col-md-8">
                       <form method="POST" enctype="multipart/form-data">
                          <div class="form-group <?php if(form_error('tgl_pengunjung')) echo 'has-error'?>">
                            <label for="tgl_pengunjung">Tanggal Pengunjung</label>
                            <input type="date" id="tgl_pengunjung" name="tgl_pengunjung" class="form-control tgl_pengunjung " placeholder="Tanggal Pengunjung" value="<?php echo $pengunjung['tgl_pengunjung'] ?>">
                            <?php echo form_error('tgl_pengunjung', '<small style="color:red">','</small>') ?>
                          </div>
                          <div class="form-group <?php if(form_error('nama_lembaga')) echo 'has-error'?>">
                            <label for="nama_lembaga">Nama Lembaga</label>
                            <input type="text" id="nama_lembaga" name="nama_lembaga" class="form-control nama_lembaga " placeholder="Nama Lembaga" value="<?php echo $pengunjung['nama_lembaga'] ?>">
                            <?php echo form_error('nama_lembaga', '<small style="color:red">','</small>') ?>
                          </div>
                           <div class="form-group <?php if(form_error('nama_pengunjung')) echo 'has-error'?>">
                               <label for="nama_pengunjung">Nama Pengunjung</label>
                               <input type="text" id="nama_pengunjung" name="nama_pengunjung" class="form-control nama_pengunjung" placeholder="Nama Pengunjung" value="<?php echo $pengunjung['nama_pengunjung'] ?>">
                               <?php echo form_error('nama_pengunjung', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('alamat')) echo 'has-error'?>">
                             <label for="alamat">Alamat</label>
                             <input type="text" id="alamat" name="alamat" class="form-control alamat " placeholder="Alamat" value="<?php echo $pengunjung['alamat'] ?>">
                             <?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('no_telp')) echo 'has-error'?>">
                             <label for="no_telp">No Telepon</label>
                             <input type="text" id="no_telp" name="no_telp" class="form-control no_telp " placeholder="No Telepon" value="<?php echo $pengunjung['no_telp'] ?>">
                             <?php echo form_error('no_telp', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('no_fax')) echo 'has-error'?>">
                             <label for="no_fax">No Fax</label>
                             <input type="text" id="no_fax" name="no_fax" class="form-control no_fax " placeholder="No Fax" value="<?php echo $pengunjung['no_fax'] ?>">
                             <?php echo form_error('no_fax', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('no_hp')) echo 'has-error'?>">
                             <label for="no_hp">No HP</label>
                             <input type="text" id="no_hp" name="no_hp" class="form-control no_hp " placeholder="No HP" value="<?php echo $pengunjung['no_hp'] ?>">
                             <?php echo form_error('no_hp', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('email')) echo 'has-error'?>">
                             <label for="email">E-mail</label>
                             <input type="email" id="email" name="email" class="form-control email " placeholder="E-mail" value="<?php echo $pengunjung['email'] ?>">
                             <?php echo form_error('email', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('status')) echo 'has-error'?>">
                             <label for="status">Status</label>
                             <select name="status" id="status" class="form-control">
                               <option value="Kunjungan" <?php echo $pengunjung['status'] == 'Kunjungan' ? 'selected' : '' ?>>Kunjungan</option>
                               <option value="Order" <?php echo $pengunjung['status'] == 'Order' ? 'selected' : '' ?>>Order</option>
                             </select>
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-danger btn-block">Submit</button>
                           </div>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>