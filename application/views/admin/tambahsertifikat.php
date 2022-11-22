<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>berkaspegawai">Berkas Pegawai</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>ubahberkaspegawai">Ubah Berkas Pegawai</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open_multipart('sertifikat/tambahsertifikat/'.$pegawai['nik'].''); ?>
				  <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nomor Sertifikat</label>
						<input type="text" class="form-control" name="nomor_sertifikat" id="exampleInputUsername1" autocomplete="off" placeholder="Nomor Sertifikat">
                         <small class="form-text text-danger"><?php echo form_error('nomor_sertifikat');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nama Sertifikat</label>
						<input type="text" class="form-control" name="nama_sertifikat" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Sertifikat">
                         <small class="form-text text-danger"><?php echo form_error('nama_sertifikat');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal Pelaksanaan</label>
						<div class="input-group date datepicker"id="datePickerExample">
										<input type="text" class="form-control" name="tanggal_pelaksanaan" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                         <small class="form-text text-danger"><?php echo form_error('tanggal_pelaksanaan');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tempat Pelaksanaan</label>
						<input type="text" class="form-control" name="tempat_pelaksanaan" id="exampleInputUsername1" autocomplete="off" placeholder="Tempat Pelaksanaan">
                         <small class="form-text text-danger"><?php echo form_error('tempat_pelaksanaan');?></small>
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