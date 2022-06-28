

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

              <?php echo form_open('skp/simpan_edit_peserta','id="form_custom" class="form-horizontal form-label-left"' );?>
              <?php foreach ($data_peserta as $dp) { ?> 
                <div class="form-group">
                  <label for="id_jenis_kegiatan" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Seminar/Kegiatan<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="id_jenis_kegiatan" class="form-control" id="id_jenis_kegiatan">                            
                      <option value="<?php echo $dp->id_jenis_kegiatan ?>"><?php echo $dp->nama_kegiatan ?></option>
                      <?php foreach ($jenis_kegiatan as $item) {
                        echo "<option value=".$item->id_jenis_kegiatan.">".$item->nama_kegiatan."</option>";
                      }?>                                                                    
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_peserta">Nama Peserta<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $dp->nama_peserta ?>" type="text" id="nama_peserta" name="nama_peserta" required="required" class="form-control col-md-7 col-xs-12">
                   
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instansi_asal">Instansi Asal <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $dp->instansi_asal ?>" type="text" id="instansi_asal" name="instansi_asal" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label for="sebagai" class="control-label col-md-3 col-sm-3 col-xs-12">Sebagai<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="sebagai" class="form-control" id="sebagai">                            
                      <option value="<?php echo $dp->sebagai ?>"><?php echo $dp->keterangan ?></option>
                      <?php foreach ($jenis_peserta as $item) {
                        echo "<option value=".$item->id.">".$item->keterangan."</option>";
                      }?>                                                                    
                    </select>
                  </div>
                </div>                
                <div class="form-group">
                  <label for="no_hp" class="control-label col-md-3 col-sm-3 col-xs-12">NO HP<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $dp->no_hp ?>" id="no_hp" name="no_hp" class="form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $dp->email ?>" id="email" name="email" class="form-control col-md-7 col-xs-12"  type="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat" class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Jalan/Desa
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="<?php echo $dp->alamat ?>" id="alamat" name="alamat" class="form-control col-md-7 col-xs-12" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="provinsi" class="control-label col-md-3 col-sm-3 col-xs-12">Propinsi
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="provinsi" class="form-control" id="provinsi">                            
                      <option value="<?php echo $dp->id_provinsi ?>"><?php echo $dp->nama_prop ?></option>
                      <?php foreach ($provinsi as $prov) {
                        echo "<option value=".$prov->id.">".$prov->nama."</option>";
                      }?>                                                                    
                    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="kabupaten" class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="kab" class="form-control" id="kabupaten">    
                      <option value="<?php echo $dp->id_kabupaten ?>"><?php echo $dp->nama_kab ?></option>
                    </select>
                  </div>
                </div>                
                <div class="form-group">
                  <label for="kecamatan" class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="kecamatan" class="form-control" id="kecamatan">                            
                      <option value="<?php echo $dp->id_kecamatan ?>"><?php echo $dp->nama_kec ?></option>
                     
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="desa" class="control-label col-md-3 col-sm-3 col-xs-12">Desa</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="desa" class="form-control" id="desa">                            
                      <option value="<?php echo $dp->id_desa ?>"><?php echo $dp->nama_desa ?></option>
                                                                                   
                    </select>
                  </div>
                </div>
                <div>
                  <input type="hidden" id="id_url" value="<?php echo base_url()?>"/>
                  <input type="hidden" name="id_peserta" id="id_peserta" value="<?php echo $dp->id_peserta ?>"/>
                  <input type="hidden" name="id_instansi" id="id_instansi" value="<?php echo $this->session->userdata('id_instansi');?>"/>
                  <input type="hidden" name="input_by" id="input_by" value="<?php echo $this->session->userdata('id_user');?>"/>
                  <input type="hidden" name="input_date" id="input_date"  value="<?php echo date("Y-m-d H:i:s");?>"/>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input type="button" class="btn btn-primary" value="Batal" onclick="location.href = '<?php echo base_url()?>index.php/skp';">
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
                </div>
              <?php  }?>     
              <?php  echo form_close(); ?>

             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- /page content -->


