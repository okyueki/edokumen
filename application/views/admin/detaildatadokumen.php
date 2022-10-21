 <div class="page-content">
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>datadokumen">Data Dokumen</a></li>
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
                                            <div class="fw-bold">Nomor Dokumen</div>
                                                <?php echo $dokumen['nomor_dokumen'];?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nama Dokumen</div>
                                            <?php echo $dokumen['nama_dokumen'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Masa Berlaku</div>
                                                <?php echo $dokumen['tanggal_mulai'];?> - <?php echo $dokumen['tanggal_berakhir'];?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Pegawai</div>
                                                 <?php 
                                                    $pegawaix=$this->db2->get_where('pegawai', ['nik' =>  $dokumen['nik']])->row_array();

                                                    echo $pegawaix['nama'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Jenis Dokumen</div>
                                                 <?php 
                                                    $jenisdokumenx=$this->db->get_where('jenis_dokumen', ['id_jenis_dokumen' =>  $dokumen['id_jenis_dokumen']])->row_array();

                                                    echo $jenisdokumenx['jenis_dokumen'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Penyimpanan</div>
                                                 <?php 
                                                    $lemarix=$this->db->get_where('lemari', ['id_lemari' =>  $dokumen['id_lemari']])->row_array();
                                                    $rakx=$this->db->get_where('rak', ['id_rak' =>  $dokumen['id_rak']])->row_array();

                                                    echo $lemarix['nama_lemari'].' / '.$rakx['nama_rak'];
                                                 
                                                 ?>
                                            </div>
                                            
                                        </li>

                                        <a class="btn btn-success" target="_blank" href="https://wa.me/?text=<?php echo base_url()."uploads/dokumen/".$dokumen['file']?>">Share Via Whatsapp</a>

                                        </ol>
                                    
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <embed type="application/pdf" src="<?php echo base_url();?>uploads/dokumen/<?php echo $dokumen['file'];?>" width="100%" height="400"></embed>

                                </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
