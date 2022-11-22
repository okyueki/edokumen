<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eSertifikat</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>ubahberkaspegawai">Ubah Berkas Pegawai</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open_multipart('sertifikat/ubahsertifikat/'.$sertifikat['id_sertifikat'].'/'.$sertifikat['nik_pegawai']); ?>
				  <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nomor Sertifikat</label>
						<input type="text" class="form-control" name="nomor_sertifikat" id="exampleInputUsername1" autocomplete="off" value="<?php echo $sertifikat['nomor_sertifikat'];?>" placeholder="Nomor Sertifikat">
                         <small class="form-text text-danger"><?php echo form_error('nomor_sertifikat');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nama Sertifikat</label>
						<input type="text" class="form-control" name="nama_sertifikat" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Sertifikat" value="<?php echo $sertifikat['nama_sertifikat'];?>">
                         <small class="form-text text-danger"><?php echo form_error('nama_sertifikat');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal Pelaksanaan</label>
						<div class="input-group date datepicker"id="datePickerExample">
										<input type="text" class="form-control" name="tanggal_pelaksanaan" autocomplete="off" value="<?php echo $sertifikat['tanggal_pelaksanaan'];?>"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                         <small class="form-text text-danger"><?php echo form_error('tanggal_pelaksanaan');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tempat Pelaksanaan</label>
						<input type="text" class="form-control" name="tempat_pelaksanaan" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Sertifikat" value="<?php echo $sertifikat['tempat_pelaksanaan'];?>">
                         <small class="form-text text-danger"><?php echo form_error('tempat_pelaksanaan');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">File</label>
						<input type="file" id="myDropify" name="file" data-default-file="<?php echo base_url().'uploads/sertifikat/'.$sertifikat['file']; ?>"/>
                        <input type="hidden" value="<?php echo $sertifikat['file']?>" name="oldfile"/>
						<small class="form-text text-danger"><?php echo form_error('file');?></small>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>