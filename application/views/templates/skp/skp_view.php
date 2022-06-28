<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h4><b><?php echo $title1?></b></h4>
      </div>
      <!--
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      !-->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo $title2?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> 
            <div class="col-sm-12 row">
                <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/add_peserta" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a></div>
                <br></br>
            </div>             
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style=text-align:center>NO</th>
                  <th style=text-align:center>NAMA</th>
                  <th style=text-align:center>NAMA KEGIATAN</th>
                  <th style=text-align:center>INSTANSI ASAL</th>                          
                  <th style=text-align:center>TANGGAL</th>
                  <th style=text-align:center width="150px">Aksi</th>
                </tr>
              </thead>
              <tbody> 
                <?php $no=1; foreach ($datapeserta as $item) { ?>                                              
                <tr>
                  <td><?php echo $no++;?></td>
                    <?php if ($item->status == 'Non Aktiv') {
                      echo "<td class='bg-danger'>".$item->nama_peserta."</td>";
                    }else{
                      echo "<td>".$item->nama_peserta."</td>";
                    }?>                    
                  <td><?php echo $item->nama_kegiatan?></td>
                  <td><?php echo $item->instansi_asal;?></td>
                  
                  <td><?php echo $item->tanggal;?></td>
                  <td style=text-align:center>
                    <?php if ($item->status == 'Non Aktiv') {?>
                      <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/print_sertifikat/<?php echo $this->myencryption->encode($item->id_peserta); ?>" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-btn fa-print"></i>Cetak</a></div>
                    <?php }else{ ?>
                      <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/edit_peserta/<?php echo $this->myencryption->encode($item->id_peserta); ?>" class="btn btn-warning btn-xs"><i class="fa fa-btn fa-pencil"></i>edit</a></div>
                      <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/print_sertifikat/<?php echo $this->myencryption->encode($item->id_peserta); ?>" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-btn fa-print"></i>Cetak</a></div>
                      <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/edit_peserta/<?php echo $this->myencryption->encode($item->id_peserta); ?>" class="btn btn-danger btn-xs"><i class="fa fa-btn fa-trash"></i>Hapus</a></div>
                    <?php }?>
                  </td>
                <?php }?>   
                </tr>
              </tbody>
            </table>              
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->