<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
            			<li class="breadcrumb-item"><a href="<?php echo base_url();?>hakakses">Hak Akses</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open('hakakses/tambahhakakses'); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">NIK</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="nik">
							<?php
								foreach ($pegawai as $p) :
							?>
                            <option value="<?php echo $p['nik']?>"><?php echo $p['nik']?> / <?php echo $p['nama']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('nik') ?></small>
                    </div>
                     <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Password</label>
						<input type="text" class="form-control" name="password" id="exampleInputUsername1" autocomplete="off" placeholder="Password">
                         <small class="form-text text-danger"><?php echo form_error('password');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Unit</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="unit">
							<?php
								foreach ($unit as $u) :
							?>
                            <option value="<?php echo $u['id_unit']?>"><?php echo $u['nama_unit']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                         <small class="form-text text-danger"><?php echo form_error('unit');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Hak Akses</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="hak_akses">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                         <small class="form-text text-danger"><?php echo form_error('hak_akses');?></small>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>