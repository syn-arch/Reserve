<?php $pengaturan = $this->db->get('pengaturan')->row_array(); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $judul ?></title>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <style type="text/css" media="all">
        @font-face {
            font-family: dot-metrix;
            src: url(http://localhost/e_pos_an/assets/font/dot.TTF);
        }
        *{
            font-family: dot-metrix;
        }
        tr > td{
            text-align: right;
        }
        tr > td:nth-child(1) {
            text-align: left;
        }
        body { 
            color: #000; 
        }
        #wrapper { 
            max-width: 100%; margin: 0 auto; padding-top: 20px; 
        }
        .btn { 
            margin-bottom: 5px; 
        }
        .table { 
            border-radius: 3px; 
        }
        .table th { 
            background: #f5f5f5; 
        }
        h3 { 
            margin: 5px 0; 
        }
        tfoot tr th:first-child { 
            text-align: right; 
        }
        
        @media print {
            * {
                font-family: dot-metrix;
            }
            .no-print { 
                display: none; 
            }
            #wrapper { 
              width: 100%; min-width: 250px; margin: 0 auto; 
          }
          #receiptData { 
           width: 100%; min-width: 250px; margin: 0 auto; 
       }

   }
</style>
</head>
<body onload="window.print()">
    <div id="wrapper">
        <div id="receiptData" style="width: 720px; min-width: 250px; margin: 0 auto;">
            <table border="1" width="100%">
                <tr>
                    <td colspan="5" style="padding-right:5px; text-align: right"> KBM JLPL</td>
                    <td rowspan="2" style="padding:5px"><img width="100" src="<?php echo base_url('assets/img/perhutani.png') ?>" alt=""></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding:5px; text-align: right"> PATUHA RESORT CIWIDEY BANDUNG</td>
                </tr>
                <tr>
                    <th colspan="1" style="padding: 5px;">No</th>
                    <td colspan="4" style="text-align: left; padding: 5px;"><u><?php echo $transaksi['id'] ?></u></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="1" style="padding: 5px;">Telah Diterima Dari</th>
                    <td colspan="4" style="text-align: left; padding: 5px;"><u><?php echo $transaksi['nama_pengunjung'] ?></u></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="1" style="padding: 5px;">Uang Sejumlah</th>
                    <td colspan="4" style="text-align: left; padding: 5px;"><u><?php echo ucwords(terbilang($transaksi['cash'])) . " Rupiah" ?></u></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="7" style="padding: 5px;">Untuk Pembayaran</th>
                </tr>
                <tr>
                    <td colspan="7">
                        <table width="100%">
                         <?php
                         $this->db->join('kamar', 'id_kamar');
                         $barang =  $this->db->get_where('detail_transaksi', ['id_transaksi' => $transaksi['id']])->result_array();
                         foreach ($barang as $row) : ?>
                            <tr>
                                <td></td>
                                <td style="padding: 5px"><?php echo $row['nama_kamar'] ?></td>
                                <td style="padding: 5px"><?php echo $row['qty'] ?></td>
                                <td style="padding: 5px"><?php echo number_format($row['harga']) ?></td>
                                <td style="padding: 5px"><?php echo number_format($row['diskon']) ?></td>
                                <td style="padding: 5px"><?php echo number_format($row['total_harga']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 5px; text-align: left;">Rp. <h3 style="display: inline-block;"><i><?php echo number_format($transaksi['total_bayar']) ?></i></h3></td>
                    <td colspan="3"></td>
                    <td colspan="2" style="text-align: center;">Ciwidey, <?php echo  tgl_indo(date('Y-m-d', strtotime($transaksi['tgl_transaksi']))) ?></td>
                </tr>
                <tr>
                    <td colspan="5" rowspan="2"></td>
                    <td colspan="2" rowspan="2" style="text-align: center; padding-top: 40px">
                        <?php echo $transaksi['nama_petugas'] ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<!-- start -->
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">  
        <div id="buttons" style="text-transform:uppercase;" class="no-print">
            <hr>
            <span class="pull-right col-xs-12">
                <button onclick="window.print();" class="btn btn-block btn-primary">CETAK</button>
            </span>
            <span class="col-xs-12">
                <a class="btn btn-block btn-success" href="<?php echo base_url('transaksi/tambah') ?>">Kembali Ke transaksi</a>
            </span>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>