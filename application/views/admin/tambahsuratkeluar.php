<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>suratkeluar">Surat Keluar</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open_multipart('suratkeluar/tambahsuratkeluar'); ?>
				 <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nomor Surat</label>
						<input type="text" class="form-control" name="nomor_surat" id="exampleInputUsername1" autocomplete="off" placeholder="Nomor Surat">
                         <small class="form-text text-danger"><?php echo form_error('nomor_surat');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Judul Surat</label>
						<input type="text" class="form-control" name="judul_surat" id="exampleInputUsername1" autocomplete="off" placeholder="Judul Surat">
                         <small class="form-text text-danger"><?php echo form_error('judul_surat');?></small>
					</div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal Surat</label>
						<div class="input-group date datepicker" id="datePickerExample">
									<input type="text" class="form-control" name="tanggal_surat">
                  					<span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
								</div>
                         <small class="form-text text-danger"><?php echo form_error('tanggal_surat');?></small>
					</div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Sifat</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="sifat">
							<?php
								foreach ($sifat as $st) :
							?>
                            <option value="<?php echo $st['id_sifat']?>"><?php echo $st['nama_sifat']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('sifat');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Dikirim Ke</label>
						<select class="js-example-basic-multiple form-select" data-width="100%" name="nik_pj[]" multiple="multiple">
							<?php
								foreach ($pegawai as $p) :
							?>
                            <option value="<?php echo $p['nik']?>"><?php echo $p['nama']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('pegawai');?></small>
                    </div>
					
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Isi Surat</label>
						<textarea class="form-control" name="isi_surat" id="tinymceExample" rows="10"></textarea>			
                        <small class="form-text text-danger"><?php echo form_error('isi_surat');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Lampiran</label>
						<input type="text" class="form-control" name="lampiran" id="exampleInputUsername1" autocomplete="off" placeholder="Lampiran">
                         <small class="form-text text-danger"><?php echo form_error('lampiran');?></small>
					</div>
				
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>