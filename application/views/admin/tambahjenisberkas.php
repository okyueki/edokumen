<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
            			<li class="breadcrumb-item"><a href="<?php echo base_url();?>jenisberkas">Jenis Berkas</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open('jenisberkas/tambahjenisberkas'); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jenis Berkas</label>
						<input type="text" class="form-control" name="jenis_berkas" id="exampleInputUsername1" autocomplete="off" placeholder="Jenis Berkas">
                         <small class="form-text text-danger"><?php echo form_error('jenis_berkas') ?></small>

                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Bidang</label>
						
							<select class="js-example-basic-multiple form-select" data-width="100%" name="bidang[]" multiple="multiple">
							<?php
								foreach ($bidang as $b) :
							?>
                            <option value="<?php echo $b['nama']?>"><?php echo $b['nama']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
						
                        <small class="form-text text-danger"><?php echo form_error('bidang') ?></small>

                    </div>

					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Masa Berlaku</label>
							<select class="js-example-basic-single form-select" data-width="100%" name="masa_berlaku">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
						</select>
						<small class="form-text text-danger"><?php echo form_error('masa_belaku') ?></small>
					</div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>