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
                        <?php if ($this->input->get('dari')): ?>
                        <a href="<?php echo base_url('laporan/export/' . $this->input->get('dari') . '/' . $this->input->get('sampai')) ?>" class="btn btn-success"><i class="fa fa-sign-in"></i> Export Excel</a>
                        <?php else: ?>
                        <a href="<?php echo base_url('laporan/export') ?>" class="btn btn-success"><i class="fa fa-sign-in"></i> Export Excel</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group <?php if(form_error('dari')) echo 'has-error'?>">
                                <label for="dari">Dari Tanggal</label>
                                <input type="date" id="dari" name="dari" class="form-control dari " placeholder="Dari Tanggal" value="<?php echo set_value('dari') ?>">
                                <?php echo form_error('dari', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group <?php if(form_error('sampai')) echo 'has-error'?>">
                                <label for="sampai">Sampai Tanggal</label>
                                <input type="date" id="sampai" name="sampai" class="form-control sampai " placeholder="Sampai Tanggal" value="<?php echo set_value('sampai') ?>">
                                <?php echo form_error('sampai', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-danger">Submit</button>
                            </div> 
                        </form>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Kamar</th>
                                <th>Nama Kamar</th>
                                <th>Harga</th>
                                <th>Jumlah Disewa</th>
                                <th>Jumlah Transaksi</th>
                                <th>Subtotal</th>
                                <th>Jumlah Diskon</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($laporan as $row): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['id_kamar'] ?></td>
                                    <td><?php echo $row['nama_kamar'] ?></td>
                                    <td><?php echo "Rp. " . number_format($row['harga']) ?></td>
                                    <td><?php echo $row['jumlah_disewa'] ?></td>
                                    <td><?php echo $row['jumlah_transaksi'] ?></td>
                                    <td><?php echo "Rp. " . number_format($row['subtotal']) ?></td>
                                    <td><?php echo "Rp. " . number_format($row['jumlah_diskon']) ?></td>
                                    <td><?php echo "Rp. " . number_format($row['total_pendapatan']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
