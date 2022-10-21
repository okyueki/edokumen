<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>datadokumen">Data Dokumen</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open_multipart('datadokumen/tambahdatadokumen'); ?>
				  <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nomor Dokumen</label>
						<input type="text" class="form-control" name="nomor_dokumen" id="exampleInputUsername1" autocomplete="off" placeholder="Nomor Dokumen">
                         <small class="form-text text-danger"><?php echo form_error('nomor_dokumen');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nama Dokumen</label>
						<input type="text" class="form-control" name="nama_dokumen" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Dokumen">
                         <small class="form-text text-danger"><?php echo form_error('nama_dokumen');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal Mulai</label>
						<div class="input-group date datepicker"id="datePickerExample">
										<input type="text" class="form-control" name="tanggal_mulai" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                         <small class="form-text text-danger"><?php echo form_error('tanggal_mulai');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal Berakhir</label>
						<div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control" name="tanggal_berakhir" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                         <small class="form-text text-danger"><?php echo form_error('tanggal_berakhir');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jenis Dokumen</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="jenis_dokumen">
							<?php
								foreach ($jenisdokumen as $j) :
							?>
                            <option value="<?php echo $j['id_jenis_dokumen']?>"><?php echo $j['jenis_dokumen']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('lemari');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Lemari</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="lemari">
							<?php
								foreach ($lemari as $l) :
							?>
                            <option value="<?php echo $l['id_lemari']?>"><?php echo $l['nama_lemari']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('lemari');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Rak</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="rak">
							<?php
								foreach ($rak as $r) :
							?>
                            <option value="<?php echo $r['id_rak']?>"><?php echo $r['nama_rak']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('rak');?></small>
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