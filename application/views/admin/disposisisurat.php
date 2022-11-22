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
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Surat</a>
                                </li>
                                </ul>
                                <div class="tab-content border border-top-0 p-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
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
                                                
                                            <table class="table table-bordered">
                                                <?php
                                                $verifikasi=$this->db->get_where('verifikasi_surat', ['kode_surat' =>  $suratmasuk['kode_surat']])->result_array();
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
                                            <?php echo $suratmasuk['tanggal_surat'];?>
                                            </div>
                                           
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Status</div>
                                                <?php echo $suratmasuk['status'];?> 
                                            </div>
                                           
                                        </li>
                                        </ol>
                                        <?php
                                                            if($this->session->userdata('nama_jabatan')=="Kabag"){
                                                         ?>
                                        <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="ms-2 me-auto">
                                            <?php echo form_open_multipart('suratmasuk/disposisisurat/'.$suratmasuk['kode_surat']); ?>
                                                
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                                                       <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan" rows="5"></textarea>
                                                        <small class="form-text text-danger"><?php echo form_error('catatan');?></small>
                                                        
                                                    </div>
                                                     <div class="mb-3">
                                                        
						<label for="exampleInputUsername1" class="form-label">Dikirim Ke</label>
						<select class="js-example-basic-multiple form-select" data-width="100%" name="nik_pj[]" multiple="multiple">
							<?php
								foreach ($pegawai as $p) :
							?>
                            <option value="<?php echo $p['nik']?>"><?php echo $p['nama']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('nik_pj');?></small>
                    </div>
                    
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                            <?php echo form_close(); ?>
                                            </div>
                                           
                                        </li>
                                    </ul>
                                    <?php
                                                            }
                    ?>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <?php
                                        $kode_surat=substr($suratmasuk['kode_surat'],0,2);
                                        if($kode_surat=="SK"){
                                    ?>
                                    <iframe src="<?php echo base_url();?>suratkeluar/cetaksurat/<?php echo $suratmasuk['kode_surat']?>" title="" width="100%" height="400px"></iframe>
                                    <a target="_blank" class="btn btn-primary me-2" href="<?php echo base_url();?>suratkeluar/cetaksurat/<?php echo $suratmasuk['kode_surat']?>"><i class="link-icon" data-feather="printer"></i></a>
                                   <?php
                                        }else{
                                    ?>
                                    <iframe src="<?php echo base_url();?>ecuti/cetakcuti/<?php echo $suratmasuk['kode_surat']?>" title="" width="100%" height="400px"></iframe>
                                    <a target="_blank" class="btn btn-primary me-2" href="<?php echo base_url();?>ecuti/cetakcuti/<?php echo $suratmasuk['kode_surat']?>"><i class="link-icon" data-feather="printer"></i></a>

                                    <?php
                                        }
                                    ?>
                                </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
