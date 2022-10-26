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
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul Surat</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($suratmasuk as $sm) :
                                $pengirim=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $sm['nik_pengirim']])->row_array();
                                $penerima=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $sm['nik_penerima']])->row_array();
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sm['judul_surat']; ?></td>
                        <td><?php echo $pengirim['nama']; ?></td>
                        <td><?php echo $penerima['nama']; ?></td>
                        <td><?php echo $sm['tanggal']; ?></td>
                        <td>
                          <a href="<?php echo base_url();?>suratmasuk/verifikasisurat/<?php echo $sm['nomor_surat']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
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