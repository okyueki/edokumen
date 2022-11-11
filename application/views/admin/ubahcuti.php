<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>ecuti">eCuti</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-3"><?php echo $judul;?></h6>
                 <?php echo form_open_multipart('ecuti/ubahcuti/'.$cuti['kode_surat']); ?>
				  <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Jenis Cuti</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="jenis_cuti">
							 <?php
                                $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $cuti['id_jenis_cuti']])->row_array();
                            ?>
                             <option value="<?php echo $jeniscutix['id_jenis_cuti']?>"><?php echo $jeniscutix['jenis_cuti']?></option>
							<?php
								foreach ($jeniscuti as $j) :
							?>
                            <option value="<?php echo $j['id_jenis_cuti']?>"><?php echo $j['jenis_cuti']?></option>
							 <?php
                       
                        		endforeach;
                     		 ?>
						</select>
                        <small class="form-text text-danger"><?php echo form_error('jenis_cuti');?></small>
                    </div>
					<div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Tanggal</label>
						<div class="row">
						<div class="col-5">
							<div class="row">
						<div class="input-group date datepicker"id="datePickerExample">
										<input type="text" class="form-control hitungtanggal" name="cuti_mulai" autocomplete="off" value="<?php echo $cuti['tanggal_awal']?>"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>

                         <small class="form-text text-danger"><?php echo form_error('cuti_mulai');?></small>
							</div>
						 </div>
						 <div class="col-5">
							<div class="row">
							<div class="input-group date datepicker"id="datePickerExample1">
										<input type="text" class="form-control hitungtanggal" name="cuti_berakhir" autocomplete="off" value="<?php echo $cuti['tanggal_akhir']?>"/>
										<span class="input-group-text input-group-addon"
											><i data-feather="calendar"></i
										></span>
									</div>
                         <small class="form-text text-danger"><?php echo form_error('cuti_berakhir');?></small>
							</div>
						</div>
						 <div class="col-1">
							<div class="row">
								<h2><span class="badge bg-primary jumlah_hari"><?php echo $cuti['jumlah']." Hari"?></span></h2>
							</div>
						 </div>
						 <input type="hidden" name="jumlah_hari" class="form-control-plaintext" id="staticEmail" value="<?php echo $cuti['jumlah']?>">
						</div>
                    </div>
            	    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Kepentingan</label>
						<input type="text" class="form-control" name="kepentingan" id="exampleInputUsername1" autocomplete="off" placeholder="Kepentingan" value="<?php echo $cuti['kepentingan']?>">
                         <small class="form-text text-danger"><?php echo form_error('kepentingan');?></small>
                    </div>

					 <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Alamat</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="alamat"><?php echo $cuti['alamat']?></textarea>
                         <small class="form-text text-danger"><?php echo form_error('alamat');?></small>
                    </div>
                    
                    <div class="mb-3">
						<label for="exampleInputUsername1" class="form-label">Koordinator</label>
						<select class="js-example-basic-single form-select" data-width="100%" name="nik_pj">
							<?php
                                $pegawaix=$this->db2->select('nik,nama')->get_where('pegawai', ['nik' =>  $cuti['nik_pj']])->row_array();
                            ?>
                             <option value="<?php echo $pegawaix['nik']?>"><?php echo $pegawaix['nama']?></option>
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
            </div>
					</div>
				</div>

			</div>