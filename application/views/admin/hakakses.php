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
                <a href="<?php echo base_url();?>hakakses/tambahhakakses" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Hak Akses</a>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Password</th>
                        <th>Hak Akses</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($hakakses as $h) :
                               $pegawaix=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $h['nik']])->row_array();
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pegawaix['nama']; ?></td>
                        <td><?php echo $h['nik']; ?></td>
                         <td><?php echo $h['password']; ?></td>
                          <td><span class="badge bg-primary"><?php echo $h['hak_akses']; ?></span></td>
                        <td>
                          <a href="<?php echo base_url();?>hakakses/ubahhakakses/<?php echo $h['id_hak_akses']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>hakakses/hapushakakses/<?php echo $h['id_hak_akses']?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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