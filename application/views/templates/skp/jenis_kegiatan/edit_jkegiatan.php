

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
              <?php echo form_open('skp/simpan_jkegiatan','id="form_custom" class="form-horizontal form-label-left"' );?>
                <?php foreach ($data_jkegiatan as $item) {?>                
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_kegiatan">Nama Kegiatan<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="nama_kegiatan" class="form-control col-md-7 col-xs-12" rows="3" name="nama_kegiatan" required="required"><?php echo $item->nama_kegiatan?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="quota_peserta" class="control-label col-md-3 col-sm-3 col-xs-12">Quota Peserta<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="quota_peserta" class="form-control col-md-7 col-xs-12" type="text" name="quota_peserta" required="required" value="<?php echo $item->quota_peserta?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_kegiatan">Tanggal Kegiatan <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="last-name" name="tgl_kegiatan" required="required" class="datepicker form-control col-md-7 col-xs-12" value="<?php echo date('d-m-Y',strtotime($item->tanggal));?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_skp" class="control-label col-md-3 col-sm-3 col-xs-12">NO SKP PPNI<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="no_skp" class="form-control col-md-7 col-xs-12" type="text" name="no_skp" required="required" value="<?php echo $item->no_skp?>">
                  </div>
                </div>                
                <div class="form-group">
                  <label for="tempat_keg" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Kegiatan<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="tempat_keg" name="tempat_keg" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->tempat?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="ketua_keg" class="control-label col-md-3 col-sm-3 col-xs-12">Ketua Panitia<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="ketua_keg" name="ketua_keg" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->ketua?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nira_ketua_keg" class="control-label col-md-3 col-sm-3 col-xs-12">NIRA Ketua<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="nira_ketua_keg" name="nira_ketua_keg" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->nira_ketua?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama_legist" class="control-label col-md-3 col-sm-3 col-xs-12">Pejabat Legislasi<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="nama_legist" name="nama_legist" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->legist_nama?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="legist_jabatan" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan Legislasi<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="legist_jabatan" name="legist_jabatan" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->legist_jabatan?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="legist_daerah" class="control-label col-md-3 col-sm-3 col-xs-12">DPW<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="legist_daerah" name="legist_daerah" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->legist_daerah?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="legist_nira" class="control-label col-md-3 col-sm-3 col-xs-12">NIRA<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="legist_nira" name="legist_nira" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $item->legist_nira?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="status" class="form-control" id="status" disabled>                            
                      <option value="<?php echo $item->status?>"><?php echo $item->status?></option>
                      <option value="Aktif">Aktif</option>
                      <option value="Non Aktif">Non Aktif</option>                                                   
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="reg_online" class="control-label col-md-3 col-sm-3 col-xs-12">Registrasi Online<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="reg_online" class="form-control" id="reg_online">                            
                      <option value="<?php echo $item->reg_online?>"><?php echo $item->reg_online?></option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>                                                   
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="keterangan" class="form-control col-md-7 col-xs-12" rows="3" name="keterangan" ><?php echo $item->keterangan?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="info">info</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <p>Jika Fitur registrasi online di aktifkan, silahkan isikan keterangan contact person, transfer biaya no rekening di Field Keterangan
                    <br>Field Bertanda * wajib di isi
                    </p>
                  </div>
                </div>
                <div>
                  <input type="hidden" name="id_jenis_kegiatan" id="id_jenis_kegiatan" value="<?php echo $item->id_jenis_kegiatan?>"/>
                  <input type="hidden" name="id_instansi" id="id_instansi" value="<?php echo $this->session->userdata('id_instansi');?>"/>
                  <input type="hidden" name="input_by" id="input_by" value="<?php echo $this->session->userdata('id_user');?>"/>
                  <input type="hidden" name="input_date" id="input_date"  value="<?php echo date("Y-m-d H:i:s");?>"/>
                </div>
                <?php }?>


                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn btn-primary" type="button">Batal</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
                </div>
              <?php  echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- /page content -->

