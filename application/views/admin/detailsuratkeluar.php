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
                                                <?php
                                                $i=1;
                                                foreach ($verifikasisurat as $vs) :
                                                    $pegawaix=$this->db2->get_where('pegawai', ['nik' =>  $vs['nik']])->row_array();
                                                     if($vs['status_verifikasi']=="Proses Verifikasi"){
                                                        echo $pegawaix['nama']." : ". "<span class='badge border border-primary text-primary'>".$vs['status_verifikasi']."</span> ";
                                                     }elseif($vs['status_verifikasi']=="Disetujui"){
                                                        echo $pegawaix['nama']." : ". "<span style='cursor:pointer' data-bs-toggle='modal' data-bs-target='#exampleModal".$i."' class='badge border border-success text-success'>".$vs['status_verifikasi']."</span> ";
                                                     }else{
                                                        echo $pegawaix['nama']." : ". "<span style='cursor:pointer' data-bs-toggle='modal' data-bs-target='#exampleModal".$i."' class='badge border border-danger text-danger'>".$vs['status_verifikasi']."</span> ";
                                                     }
                                                     
                                            ?>
                                            <div class="modal fade" id="exampleModal<?php echo $i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $vs['catatan'];?>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                            <?php
                                                    $i++;
                                                    endforeach;
                                            ?>
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
