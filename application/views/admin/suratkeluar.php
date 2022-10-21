      <div class="page-content">
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">eDokumen</a></li>
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
                  <?php }elseif($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('error'); ?></div>
                  <?php }?>
                <a href="<?php echo base_url();?>suratkeluar/tambahsuratkeluar" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Surat</a>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Judul Surat</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($surat as $s) :
                                $pengirim=$this->db2->get_where('pegawai', ['nik' =>  $s['nik_pengirim']])->row_array();
                                $penerima=$this->db2->get_where('pegawai', ['nik' =>  $s['nik_penerima']])->row_array();
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $s['nomor_surat']; ?></td>
                        <td><?php echo $s['judul_surat']; ?></td>
                        <td><?php echo $pengirim['nama']; ?></td>
                        <td><?php echo $penerima['nama']; ?></td>
                        <td><?php echo $s['tanggal']; ?></td>
                        <td><?php echo $s['status']; ?></td>
                        <td>
                          <?php
                            if($s['file']!=""){    
                          ?>
                            <a target="_blank" href="<?php echo base_url();?>uploads/surat/<?php echo $s['file'];?>"><i class="link-icon" data-feather="paperclip"></i></a>
                          <?php
                            }
                          ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url();?>suratkeluar/ubahsuratkeluar/<?php echo $s['id_surat'];?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>suratkeluar/hapussuratkeluar/<?php echo $s['id_surat'];?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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