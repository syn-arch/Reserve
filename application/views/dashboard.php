<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $this->db->get('petugas')->num_rows(); ?></h3>

        <p>Data Petugas</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="<?php echo base_url('petugas') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $this->db->get('kamar')->num_rows(); ?></h3>

        <p>Data kamar</p>
      </div>
      <div class="icon">
        <i class="fa fa-bed"></i>
      </div>
      <a href="<?php echo base_url('master/kamar') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $this->db->get('pengunjung')->num_rows(); ?></h3>

        <p>Data Pengunjung</p>
      </div>
      <div class="icon">
        <i class="fa fa-archive"></i>
      </div>
      <a href="<?php echo base_url('master/pengunjung') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $this->db->get('transaksi')->num_rows(); ?></h3>

        <p>Data Transaksi</p>
      </div>
      <div class="icon">
        <i class="fa fa-credit-card"></i>
      </div>
      <a href="<?php echo base_url('transaksi') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>