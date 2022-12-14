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
                 <?php echo form_open('hakakses/ubahhakakses/'.$hakakses['id_hak_akses']); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">NIK</label>
                        <select class="js-example-basic-single form-select" data-width="100%" name="nik">
                            <?php
                                $pegawaix=$this->db2->select('nik,nama')->get_where('pegawai', ['nik' =>  $hakakses['nik']])->row_array();
                            ?>
                             <option value="<?php echo $pegawaix['nik']?>"><?php echo $pegawaix['nik']?> / <?php echo $pegawaix['nama']?></option>
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
						<input type="text" class="form-control" name="password" id="exampleInputUsername1" autocomplete="off" placeholder="Password" value="<?php echo $hakakses['password']?>">
                         <small class="form-text text-danger"><?php echo form_error('password');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Unit</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="unit">
                            <?php
                                $unitx=$this->db->get_where('unit', ['id_unit' => $hakakses['id_unit']])->row_array();
                            ?>
                             <option value="<?php echo $unitx['id_unit']?>"><?php echo $unitx['nama_unit']; ?></option>
							
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
						<label for="exampleInputUsername1" class="form-label">Jabatan</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="jabatan">
                            <?php
                                $jabatanx=$this->db->get_where('jabatan', ['id_jabatan' => $hakakses['id_jabatan']])->row_array();
                            ?>
                             <option value="<?php echo $jabatanx['id_jabatan']?>"><?php echo $jabatanx['nama_jabatan']; ?></option>
							
                            <?php
								foreach ($jabatan as $jb) :
							?>
                            <option value="<?php echo $jb['id_jabatan']?>"><?php echo $jb['nama_jabatan']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                         <small class="form-text text-danger"><?php echo form_error('unit');?></small>
                    </div>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Hak Akses</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="hak_akses">
                            <option value="<?php echo $hakakses['hak_akses']?>"><?php echo $hakakses['hak_akses']?></option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                        </select>
                         <small class="form-text text-danger"><?php echo form_error('password');?></small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>