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
              <div class="col-sm-12 text-center">
                <h4><b>Kegiatan <?php echo $instansi?></b></h4>
              </div>
              <div class="col-sm-12">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style=text-align:center>NO</th>
                      <th style=text-align:center>NAMA KEGIATAN</th>
                      <th style=text-align:center>TANGGAL KEGIATAN</th>
                      <th style=text-align:center>QUOTA PESERTA</th>                          
                      <th style=text-align:center>PESERTA</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php $no=1; foreach ($datapeserta as $item) { ?>                                              
                    <tr>                     
                        <td ><?php echo $no++;?></td>
                        <td ><?php echo $item->nama_kegiatan;?></td>
                        <td ><?php echo date('d-m-Y',strtotime($item->tanggal)) ;?></td>
                        <td ><?php echo $item->quota_peserta?></td>
                        <td ><?php echo $item->jmlh_peserta;?></td>                                  
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
</div>
<!-- /page content -->