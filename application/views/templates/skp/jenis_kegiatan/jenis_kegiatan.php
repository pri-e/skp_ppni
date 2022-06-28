


<!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h4><b><?php echo $title1?></b></h4>
        </div>        
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
                  
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="col-sm-12 row">
                <div class="btn-group"><a href="<?php echo base_url();?>index.php/skp/add_jkegiatan" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a></div>
                <br></br>
              </div>
              <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style=text-align:center>NO</th>
                    <th style=text-align:center>NAMA KEGIATAN</th>
                    <th style=text-align:center>TANGGAL</th>
                    <th style=text-align:center>TEMPAT</th>
                    <th style=text-align:center>NO SKP</th>                          
                    <th style=text-align:center>PENYELENGGARA</th>
                    <th style=text-align:center>STATUS</th>
                    <th style=text-align:center width="100px">REG ONLINE</th>
                    <th style=text-align:center width="220px">Aksi</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php $no=1; foreach ($kegiatan as $item) { ?>                   
                  <tr>
                      <?php if ($item->verif_admin==TRUE) {?>
                        <?php if ($item->status=="Aktif") {?>
                          <td class="bg-success"><?php echo $no++;?></td>
                          <td class="bg-success"><?php echo $item->nama_kegiatan?></td>
                          <td class="bg-success"><?php echo $item->tanggal?></td>
                          <td class="bg-success"><?php echo $item->tempat?></td>
                          <td class="bg-success"><?php echo $item->no_skp;?></td>                    
                          <td class="bg-success"><?php echo $item->instansi;?></td>
                          <td class="bg-success"><?php echo $item->status;?></td>
                          <td class="bg-success"><?php echo $item->reg_online;?></td>
                          <td class="bg-success" style=text-align:center>
                            <b>Kegiatan Sedang Berlangsung</b>
                          </td>
                        <?php }else{ ?>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $item->nama_kegiatan?></td>
                          <td><?php echo $item->tanggal?></td>
                          <td><?php echo $item->tempat?></td>
                          <td><?php echo $item->no_skp;?></td>                    
                          <td><?php echo $item->instansi;?></td>
                          <td><?php echo $item->status;?></td>
                          <td><?php echo $item->reg_online;?></td>
                          <td style=text-align:center>
                            <b>Kegiatan Sudah Selesai</b>
                          </td>
                        <?php }?>
                      <?php }else{?>
                        <td class="bg-danger"><?php echo $no++;?></td>
                        <td class="bg-danger"><?php echo $item->nama_kegiatan?></td>
                        <td class="bg-danger"><?php echo $item->tanggal?></td>
                        <td class="bg-danger"><?php echo $item->tempat?></td>
                        <td class="bg-danger"><?php echo $item->no_skp;?></td>                    
                        <td class="bg-danger"><?php echo $item->instansi;?></td>
                        <td class="bg-danger"><?php echo $item->status;?></td>
                        <td class="bg-danger"><?php echo $item->reg_online;?></td>
                        <td class="bg-danger" style=text-align:center>
                          <a href="<?php echo base_url();?>index.php/skp/edit_jkegiatan/<?php echo $this->myencryption->encode($item->id_jenis_kegiatan);?>" class="btn btn-xs btn-warning" role="button"><span class="fa fa-pencil"></span> Edit</a>
                          <a href="<?php echo base_url();?>index.php/skp/hapus_jkegiatan/<?php echo $this->myencryption->encode($item->id_jenis_kegiatan);?>" class="btn btn-xs btn-danger" role="button"><span class="fa fa-trash"></span> Hapus</a>
                        </td>
                      <?php }?>                            
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

