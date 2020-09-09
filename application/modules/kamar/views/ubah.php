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
                        <a href="<?php echo base_url('kamar') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
               <div class="row">
                <div class="col-md-2"></div>
                   <div class="col-md-8">
                       <form method="POST" enctype="multipart/form-data">
                        <div class="form-group <?php if(form_error('id_kamar')) echo 'has-error'?>">
                          <label for="id_kamar">ID kamar</label>
                          <input readonly="" type="text" id="id_kamar" name="id_kamar" class="form-control" value="<?php echo $kamar['id_kamar'] ?>">
                          <?php echo form_error('id_kamar', '<small style="color:red">','</small>') ?>
                        </div>
                       <div class="form-group <?php if(form_error('nama_kamar')) echo 'has-error'?>">
                           <label for="nama_kamar">Nama kamar</label>
                           <input type="text" id="nama_kamar" name="nama_kamar" class="form-control nama_kamar" placeholder="Nama kamar" value="<?php echo $kamar['nama_kamar'] ?>">
                           <?php echo form_error('nama_kamar', '<small style="color:red">','</small>') ?>
                       </div>
                       <div class="form-group <?php if(form_error('harga')) echo 'has-error'?>">
                             <label for="harga">Harga</label>
                             <input type="text" id="harga" name="harga" class="form-control harga " placeholder="Harga" value="<?php echo $kamar['harga'] ?>">
                             <?php echo form_error('harga', '<small style="color:red">','</small>') ?>
                           </div>
                           <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?>">
                             <label for="keterangan">Keterangan</label>
                             <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"><?php echo $kamar['keterangan'] ?></textarea>
                             <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
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