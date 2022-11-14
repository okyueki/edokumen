<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                  <?php if($this->session->flashdata('sukses')){ ?>
                    <div class="alert alert-success"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('sukses'); ?></div>
                  <?php } ?>
                <!-- <a href="<?php //echo base_url();?>berkaspegawai/tambahberkaspegawai" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Jenis Berkas</a> -->
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Bidang</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($pegawai as $p) :
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $p['nik']; ?></td>
                        <td><?php echo $p['nama']; ?></td>
                        <td><?php echo $p['jbtn']; ?></td>
                        <td><?php echo $p['bidang']; ?></td>
                        <td>
                          <a href="<?php echo base_url();?>berkaspegawai/ubahberkaspegawai/<?php echo $p['nik']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                        </td>
                      </tr>
                      <?php
                        $i++;
                        endforeach;
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>