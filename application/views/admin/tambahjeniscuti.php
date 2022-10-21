<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
            			<li class="breadcrumb-item"><a href="<?php echo base_url();?>jeniscuti">Jenis Cuti</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open('jeniscuti/tambahjeniscuti'); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jenis Cuti</label>
						<input type="text" class="form-control" name="jenis_cuti" id="exampleInputUsername1" autocomplete="off" placeholder="Jenis Cuti">
                         <small class="form-text text-danger"><?php echo form_error('jenis_cuti') ?></small>

                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
                
              </div>
            </div>
					</div>
				</div>

			</div>