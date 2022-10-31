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
                  <?php }elseif($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('error'); ?></div>
                  <?php }?>
                <a href="<?php echo base_url();?>datadokumen/tambahdatadokumen" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Dokumen</a>
                <div class="table-responsive mt-3">  
                  <table id="dataTableExample" class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th style="width:100%">Nama Dokumen</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Pegawai</th>
                        <th>Jenis Dokumen</th>
                        <th>Unit Terkait</th>
                        <th>Penyimpanan</th>
                        <th>File</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($dokumen as $d) :
                                $pegawai=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $d['nik']])->row_array();
                                 $unit = explode(",", $d['id_unit']);
                        ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $d['nomor_dokumen']; ?></td>
                        <td><?php echo $d['nama_dokumen']; ?></td>
                        <td><?php echo $d['tanggal_mulai']; ?></td>
                        <td><?php echo $d['tanggal_berakhir']; ?></td>
                        <td><?php echo $pegawai['nama']; ?></td>
                        <td>
                          <?php 
                            if($d['sifat_dokumen']=="Rahasia"){
                          ?>
                          <span class="badge bg-primary"><?php echo $d['jenis_dokumen']; ?></span>

                          <?php
                            }else{
                          ?>
                            <span class="badge bg-success"><?php echo $d['jenis_dokumen']; ?></span>
                          <?php
                            }
                          ?>
                        </td>
                        <td>
                          <ul>
                          <?php
                            $hitung=count($unit);
                            foreach ($unit as $u) :
                              $unitxxx=$this->db->get_where('unit', ['id_unit' =>  $u])->row_array();
                            if ($hitung > 1) {
                              echo "<li>".$unitxxx['nama_unit']."<br></li>";
                            }else{
                              echo "<li>".$unitxxx['nama_unit']."</li>";
                            }                           
                          endforeach;
                          
                         ?>
                         </ul>
                        </td>
                        
                        <td><?php echo $d['nama_lemari']; ?> / <?php echo $d['nama_rak']; ?></td>
                        <td>
                          <?php
                            if($d['file']!=""){    
                          ?>
                            <a target="_blank" href="<?php echo base_url();?>uploads/dokumen/<?php echo $d['file'];?>"><i class="link-icon" data-feather="paperclip"></i></a>
                          <?php
                            }
                          ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url();?>datadokumen/detaildatadokumen/<?php echo $d['id_dokumen'];?>" class="btn btn-success me-2"><i class="link-icon" data-feather="more-horizontal"></i></a>
                          <a href="<?php echo base_url();?>datadokumen/ubahdatadokumen/<?php echo $d['id_dokumen'];?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>datadokumen/hapusdatadokumen/<?php echo $d['id_dokumen'];?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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