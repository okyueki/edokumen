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
                <h6 class="card-title mb-3"><?php echo $judul;?>
                <?php
               foreach ($totalcutix as $t) :
              ?>
                <span class="badge bg-primary float-end" style="font-size: 1.2em;margin-left:5px;"> <?php echo $t['jenis_cutix']; ?> : <?php echo $t['totalsemuacuti']; ?></span>
              <?php
               endforeach;
              ?>
                </h6>
                
                  <?php if($this->session->flashdata('sukses')){ ?>
                    <div class="alert alert-success"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('sukses'); ?></div>
                  <?php } ?>
                <a href="<?php echo base_url();?>ecuti/tambahcuti" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Cuti</a>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal</th>
                        <th>Jumlah Cuti</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            //print_r($cuti);
                            foreach ($cuti as $c) :
                              $pegawai=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $c['nik']])->row_array();
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pegawai['nama']; ?></td>
                        <td><?php echo $c['jenis_cuti']; ?></td>
                        <td><?php echo $c['tanggal_awal']; ?> - <?php echo $c['tanggal_akhir']; ?></td>
                        <td><?php echo $c['jumlah']; ?></td>
                        <td><span class="badge bg-primary"><?php echo $c['status']; ?></span></td>
                        <td>
                          <a target="_blank" href="<?php echo base_url();?>ecuti/cetakcuti/<?php echo $c['nomor_surat']?>" class="btn btn-success me-2"><i class="link-icon" data-feather="printer"></i></a>
                          <a href="<?php echo base_url();?>ecuti/ubahcuti/<?php echo $c['nomor_surat']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>ecuti/hapuscuti/<?php echo $c['nomor_surat']?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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