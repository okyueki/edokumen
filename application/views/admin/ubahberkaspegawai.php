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
                                    $nama_berkas=strtolower($jb['jenis_berkas']);
                                     $berkas=$this->db->get_where('berkas_pegawai',['nik_pegawai' => $pegawai['nik'], 'id_jenis_berkas' => $jb['id_jenis_berkas']])->row_array();
							?>
                    <div class="accordion-item">
                       
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $jb['jenis_berkas'];?>" aria-expanded="true" aria-controls="collapseOne">
                           #<?php echo $jb['jenis_berkas'];?>
                        </button>
                        </h2>
                        <div id="<?php echo $jb['jenis_berkas'];?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Nomor Berkas</label>
						    <input type="text" class="form-control" name="nomor_berkas_<?php echo $nama_berkas;?>" id="exampleInputUsername1" autocomplete="off" placeholder="Nama Berkas" value="<?php echo $berkas['nomor_berkas'];?>">
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas_'.$nama_berkas.'') ?></small>

                        </div>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">File</label>
                            <input class="form-control" type="file" name="file_<?php echo $nama_berkas;?>" value="<?php echo base_url().'uploads/berkas/'.$berkas['file']; ?>">
                            <small class="form-text text-danger"><?php echo form_error('file_'.$nama_berkas.'') ?></small>
                            
                        </div>
                        <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Status Berkas</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="status_berkas_<?php echo $nama_berkas;?>">
							<option value="<?php echo $berkas['status_berkas'];?>"><?php echo $berkas['status_berkas'];?></option>
                            <option value="Masih Berlaku">Masih Berlaku</option>
                            <option value="Tidak Berlaku">Tidak Berlaku</option>
                            <option value="Proses Pengajuan">Proses Pengajuan</option>

						</select>
                        <small class="form-text text-danger"><?php echo form_error('status_berkas_'.$nama_berkas.'') ?></small>

                    </div>
                    <?php
                        if($jb['masa_berlaku']=="Iya"){
                    ?>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Awal</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control hitungtanggal" name="tanggal_awal_<?php echo $nama_berkas;?>" autocomplete="off"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                            <small class="form-text text-danger"><?php echo form_error('nomor_berkas') ?></small>

                        </div>
                        <div class="mb-3">
						    <label for="exampleInputUsername1" class="form-label">Tanggal Akhir</label>
                            <div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control hitungtanggal" name="tanggal_akhir_<?php echo $nama_berkas;?>" autocomplete="off"/>
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
            </div>
					</div>
				</div>

			</div>