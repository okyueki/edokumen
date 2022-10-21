<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">eDokumen</a></li>
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
						<label for="exampleInputUsername1" class="form-label">Pengirim</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="pengirim">
                            <option value="<?php echo $this->session->userdata('nik');?>"><?php echo $this->session->userdata('nama');?></option>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('pegawai');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Penerima</label>
						<select class="js-example-basic-multiple form-select" data-width="100%" name="penerima[]" multiple="multiple">
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
						<label for="exampleInputUsername1" class="form-label">File</label>
						<input type="file" id="myDropify" name="file"/>
                        <small class="form-text text-danger"><?php echo form_error('file');?></small>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>