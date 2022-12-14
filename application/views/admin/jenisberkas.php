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
                <a href="<?php echo base_url();?>jenisberkas/tambahjenisberkas" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Jenis Berkas</a>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Jenis Berkas</th>
                        <th>Bidang</th>
                        <th>Masa Berlaku</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($jenisberkas as $j) :
                              $bidang = explode(",", $j['bidang']);
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $j['jenis_berkas']; ?></td>
                        <td>
                           <ul>
                          <?php
                            $hitung=count($bidang);
                            foreach ($bidang as $bx) :
                              $bidangxx=$this->db2->get_where('bidang', ['nama' =>  $bx])->row_array();
                            if ($hitung > 1) {
                              echo "<li>".$bidangxx['nama']."<br></li>";
                            }else{
                              echo "<li>".$bidangxx['nama']."</li>";
                            }                           
                          endforeach;
                          
                         ?>
                         </ul>
                        </td>
                         <td><?php echo $j['masa_berlaku']; ?></td>
                        <td>
                          <a href="<?php echo base_url();?>jenisberkas/ubahjenisberkas/<?php echo $j['id_jenis_berkas']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>jenisberkas/hapusjenisberkas/<?php echo $j['id_jenis_berkas']?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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