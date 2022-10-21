<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
            			<li class="breadcrumb-item"><a href="<?php echo base_url();?>jenisdokumen">Jenis Dokumen</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open('jenisdokumen/ubahjenisdokumen/'.$jenisdokumen['id_jenis_dokumen']); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jenis Dokumen</label>
						<input type="text" class="form-control" name="jenis_dokumen" id="exampleInputUsername1" autocomplete="off" placeholder="Jenis Dokumen" value="<?php echo $jenisdokumen['jenis_dokumen']; ?>">
                         <small class="form-text text-danger"><?php echo form_error('jenis_dokumen') ?></small>

                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Hak Akses</label>
						 <select class="js-example-basic-single form-select" data-width="100%" name="hak_akses">
							<option value="<?php echo $hakakses['hak_akses']?>"><?php echo $hakakses['hak_akses']?></option>
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                            <option value="All">All</option>
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