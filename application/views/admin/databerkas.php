<div class="page-content">

	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="position-relative">
					<figure class="overflow-hidden mb-0 d-flex justify-content-center">
						<img src="<?php echo base_url(); ?>assets/images/bgprofil.jpg" class="rounded-top" alt="profile cover">
					</figure>
					<div
						class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
						<div>
							<img class="wd-70 rounded-circle"
								src="<?php echo 'http://192.168.10.200/webapps2/penggajian/'.$pegawai['photo'];?>" alt="profile">
							<span class="h4 ms-3 text-dark"><?php echo $pegawai['nama']; ?></span>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center p-3 rounded-bottom">
					<ul class="d-flex align-items-center m-0 p-0">
						<li class="d-flex align-items-center">
							<i class="me-1 icon-md " data-feather="columns"></i>
							<a class="pt-1px d-none d-md-block text-body" href="<?php echo base_url()?>profil">My Information</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center active">
							<i class="me-1 icon-md text-primary" data-feather="user"></i>
							<a class="pt-1px d-none d-md-block  text-primary" href="<?php echo base_url()?>profil/databerkas">Data Berkas</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="users"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Friends <span
									class="text-muted tx-12">3,765</span></a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="image"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Photos</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="video"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Videos</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row profile-body">

		<!-- middle wrapper start -->
		<div class="row">
			<div class="position-relative">
				<div class="card rounded">
					<div class="card-header">
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

						    <input type="text" class="form-control" name="nomor_berkas<?php echo $jb['id_jenis_berkas'];?>" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Berkas" value="<?php echo $berkas['nomor_berkas'];?>" readonly>
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas'.$jb['id_jenis_berkas'].'') ?></small>

                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <label for="exampleInputUsername1" class="form-label">File</label>
                              
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

						</select>
                        <small class="form-text text-danger"><?php echo form_error('status_berkas'.$jb['id_jenis_berkas'].'') ?></small>

                    </div>
                    <?php
                        if($jb['masa_berlaku']=="Iya"){
                    ?>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Awal</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control" name="tanggal_awal<?php echo $jb['id_jenis_berkas'];?>" autocomplete="off" readonly/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas') ?></small>

                        </div>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Akhir</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control" name="tanggal_akhir<?php echo $jb['id_jenis_berkas'];?>" autocomplete="off" readonly/>
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
  
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  <?php if($this->session->flashdata('sukses')){ ?>
                    <div class="alert alert-success"><i data-feather="alert-circle"></i> <?php echo $this->session->flashdata('sukses'); ?></div>
                  <?php } ?>
                
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
				<!-- middle wrapper end -->
			</div>
