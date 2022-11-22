 <div class="page-content">
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>suratkeluar">Surat Keluar</a></li>
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
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#surat" role="tab" aria-controls="profile" aria-selected="false">Surat</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#disposisi" role="tab" aria-controls="profile" aria-selected="false">Disposisi</a>
                                </li>
                                </ul>
                                <div class="tab-content border border-top-0 p-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nomor Surat</div>
                                                <?php echo $suratkeluar['nomor_surat'];?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Judul Surat</div>
                                            <?php echo $suratkeluar['judul_surat'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Pengirim</div>
                                                 <?php 
                                                    $pegawaixx=$this->db2->get_where('pegawai', ['nik' =>  $suratkeluar['nik_pengirim']])->row_array();

                                                    echo $pegawaixx['nama'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Penerima</div>
                                              <table class="table table-bordered">
                                                <?php
                              $verifikasi=$this->db->get_where('verifikasi_surat', ['kode_surat' =>  $suratkeluar['kode_surat']])->result_array();
                              foreach ($verifikasi as $v) :
                                $penerima=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $v['nik_penerima']])->row_array();
                               ?>
                              
                                    <tr>
                                        <td><?php echo $penerima['nama'];?></td>
                                        <td><?php echo $v['status_verifikasi'];?></td>
                                        
                                        <td> Catatan : <?php echo $v['catatan'];?></td>
                                       
                                     
                                    </tr>
                               
                            <?php
                              endforeach;
                          
                         ?>
                          </table>
                                            </div>
                                            
                                        </li>
                                         <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Tanggal</div>
                                            <?php echo $suratkeluar['tanggal'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Status</div>
                                            <span class='badge border border-primary text-primary'><?php echo $suratkeluar['status'];?></span>
                                            </div>
                                           
                                        </li>
                                        </ol>
                                </div>
                                <div class="tab-pane fade" id="surat" role="tabpanel" aria-labelledby="profile-tab">
                                    <iframe src="<?php echo base_url();?>suratkeluar/cetaksurat/<?php echo $suratkeluar['kode_surat']?>" title="" width="100%" height="400px"></iframe>
                                    <a target="_blank" class="btn btn-primary me-2" href="<?php echo base_url();?>suratkeluar/cetaksurat/<?php echo $suratkeluar['kode_surat']?>"><i class="link-icon" data-feather="printer"></i></a>
                                </div>
                                <div class="tab-pane fade" id="disposisi" role="tabpanel" aria-labelledby="profile-tab">
                                    <iframe src="<?php echo base_url();?>suratmasuk/cetakdisposisi/<?php echo $suratkeluar['kode_surat']?>" title="" width="100%" height="400px"></iframe>
                                    <a target="_blank" class="btn btn-primary me-2" href="<?php echo base_url();?>suratkeluar/cetakdisposisi/<?php echo $suratkeluar['kode_surat']?>"><i class="link-icon" data-feather="printer"></i></a>
                                </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
