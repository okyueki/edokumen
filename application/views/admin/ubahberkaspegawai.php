<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
            			<li class="breadcrumb-item"><a href="<?php echo base_url();?>berkaspegawai">Berkas Pegawai</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Berkas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sertifikat Pelatihan</a>
  </li>
  
</ul>
<div class="tab-content border border-top-0 p-3" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                 <?php echo form_open_multipart('berkaspegawai/ubahberkaspegawai/'.$pegawai['nik']); ?>
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Nama Pegawai</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="nik">
							<option value="<?php echo $pegawai['nik'];?>"><?php echo $pegawai['nama'];?></option>
						</select>
						
                         <small class="form-text text-danger"><?php echo form_error('nik') ?></small>
                    </div>
                     <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jabatan</label>
						<input type="text" class="form-control" value="<?php echo $pegawai['jbtn'];?>" readonly>
                    </div>
                     <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Bidang</label>
						<input type="text" class="form-control" name="bidang" value="<?php echo $pegawai['bidang'];?>" readonly>
                    </div>
                   <div class="mb-3"> 
                    <label for="exampleInputUsername1" class="form-label">Berkas Pegawai</label>
                   <div class="accordion" id="accordionExample">
                     <?php
                             $jenisberkas=$this->db->like('bidang', $pegawai['bidang'])->get('jenis_berkas')->result_array();
								foreach ($jenisberkas as $jb) :
                                    
                                     $berkas=$this->db->get_where('berkas_pegawai',['nik_pegawai' => $pegawai['nik'], 'id_jenis_berkas' => $jb['id_jenis_berkas']])->row_array();
							?>
                    <div class="accordion-item">
                       
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $jb['id_jenis_berkas'];?>" aria-expanded="true" aria-controls="collapseOne">
                           #<?php echo $jb['jenis_berkas'];?>
                        </button>
                        </h2>
                        <div id="collapse_<?php echo $jb['id_jenis_berkas'];?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Nomor Berkas</label>
						    <input type="text" class="form-control" name="nomor_berkas<?php echo $jb['id_jenis_berkas'];?>" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Berkas" value="<?php echo $berkas['nomor_berkas'];?>">
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas'.$jb['id_jenis_berkas'].'') ?></small>

                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <label for="exampleInputUsername1" class="form-label">File</label>
                                <div class="col-6">
                                    
                                    <input class="form-control" type="file" name="file<?php echo $jb['id_jenis_berkas'];?>">
                                    <small class="form-text text-danger"><?php echo form_error('file'.$jb['id_jenis_berkas'].'') ?></small>
                                </div>
                                <div class="col-6">
                                     <?php
                                        if($berkas['file']!=""){    
                                    ?>
                                        <a target="_blank" href="<?php echo base_url();?>uploads/berkas/<?php echo $berkas['file'];?>"><i class="link-icon" data-feather="paperclip"></i></a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
						    
                        </div>
                        <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Status Berkas</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="status_berkas<?php echo $jb['id_jenis_berkas'];?>">
							<?php
                                if(!empty($berkas)){
                            ?>
                            <option value="<?php echo $berkas['status_berkas'];?>"><?php echo $berkas['status_berkas'];?></option>
                            <?php
                                }
                                ?>
                            <option value="Masih Berlaku">Masih Berlaku</option>
                            <option value="Tidak Berlaku">Tidak Berlaku</option>
                            <option value="Proses Pengajuan">Proses Pengajuan</option>

						</select>
                        <small class="form-text text-danger"><?php echo form_error('status_berkas'.$jb['id_jenis_berkas'].'') ?></small>

                    </div>
                    <?php
                        if($jb['masa_berlaku']=="Iya"){
                    ?>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Awal</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control" name="tanggal_awal<?php echo $jb['id_jenis_berkas'];?>" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas') ?></small>

                        </div>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Akhir</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control" name="tanggal_akhir<?php echo $jb['id_jenis_berkas'];?>" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas') ?></small>

                        </div>
                    <?php
                        }
                    ?>
                        </div>
                        </div>
                       
                    </div>
                     <?php
                       
                        		endforeach;
                     		 ?>
                   </div>
                   </div>
                     
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <?php echo form_close(); ?>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  <?php if($this->session->flashdata('sukses')){ ?>
                    <div class="alert alert-success"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('sukses'); ?></div>
                  <?php } ?>
                <a href="<?php echo base_url();?>sertifikat/tambahsertifikat/<?php echo $pegawai['nik']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="plus-square"></i> Tambah Sertifikat</a>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Sertifikat</th>
                        <th>Nama Sertifikat</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Tempat Pelaksanaan</th>
                        <th>File</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($sertifikat as $s) :
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $s['nomor_sertifikat']; ?></td>
                        <td><?php echo $s['nama_sertifikat']; ?></td>
                        <td><?php echo $s['tanggal_pelaksanaan']; ?></td>
                        <td><?php echo $s['tempat_pelaksanaan']; ?></td>
                        <td>
                            <?php
                            if($s['file']!=""){    
                          ?>
                            <a target="_blank" href="<?php echo base_url();?>uploads/sertifikat/<?php echo $s['file'];?>"><i class="link-icon" data-feather="paperclip"></i></a>
                          <?php
                            }
                          ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url();?>sertifikat/ubahsertifikat/<?php echo $s['id_sertifikat']?>/<?php echo $s['nik_pegawai']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <a href="<?php echo base_url();?>sertifikat/hapussertifikat/<?php echo $s['id_sertifikat']?>/<?php echo $s['nik_pegawai']?>"  onclick="return confirm('Apa anda yakin ingin menghapus data ini?')"class="btn btn-danger me-2"><i class="link-icon" data-feather="trash-2"></i></a>
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

			</div>