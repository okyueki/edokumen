 <div class="page-content">
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>suratmasuk">Surat Masuk</a></li>
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
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail Data Dokumen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">File</a>
                                </li>
                                </ul>
                                <div class="tab-content border border-top-0 p-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <ul class="list-group list-group-flush">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nomor Surat</div>
                                                <?php echo $suratmasuk['nomor_surat'];?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Judul Surat</div>
                                            <?php echo $suratmasuk['judul_surat'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Pengirim</div>
                                                 <?php 
                                                    $pegawaixx=$this->db2->get_where('pegawai', ['nik' =>  $suratmasuk['nik_pengirim']])->row_array();

                                                    echo $pegawaixx['nama'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Penerima</div>
                                                 <?php 
                                                    $pegawaix=$this->db2->get_where('pegawai', ['nik' =>  $suratmasuk['nik_penerima']])->row_array();

                                                    echo $pegawaix['nama'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>
                                         <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Tanggal</div>
                                            <?php echo $suratmasuk['tanggal'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Status</div>
                                            <?php 
                                                $cuti=$this->db->get_where('cuti', ['nomor_surat' =>  $suratmasuk['nomor_surat']])->row_array();
                                                echo "<span class='badge bg-primary'>".$cuti['status']."</span>";
                                            ?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <?php echo form_open_multipart('suratmasuk/verifikasisurat/'.$suratmasuk['nomor_surat']); ?>
                                                <div class="mb-3">
                                                        <label for="exampleInputUsername1" class="form-label">Verifikasi Surat</label>
                                                        <select class="js-example-basic-single form-select" data-width="100%" style="width:100%;" name="verifikasi_surat">
                                                           <option value="Disetujui">Disetujui</option>
                                                           <option value="Ditolak">Ditolak</option>
                                                        </select>
                                                        <small class="form-text text-danger"><?php echo form_error('verifikasi_surat');?></small>
                                                        
                                                    </div>
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                            <?php echo form_close(); ?>
                                            </div>
                                           
                                        </li>
                                    </ol>
                                    
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <iframe src="<?php echo base_url();?>ecuti/cetakcuti/<?php echo $suratmasuk['nomor_surat']?>" title="" width="100%" height="400px"></iframe>
                                    <a target="_blank" class="btn btn-primary me-2" href="<?php echo base_url();?>ecuti/cetakcuti/<?php echo $suratmasuk['nomor_surat']?>"><i class="link-icon" data-feather="printer"></i></a>
                                </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
