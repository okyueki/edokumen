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
                  <?php } ?>
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Judul Surat</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($suratmasuk as $sm) :
                                $pengirim=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $sm['nik_pengirim']])->row_array();
                                $disposisi_surat=$this->db->get_where('disposisi', ['kode_surat' =>  $sm['kode_surat'], 'nik_disposisi_ke'=> $this->session->userdata('nik')])->row_array();
                                $verifikasi_surat=$this->db->get_where('verifikasi_surat', ['kode_surat' =>  $sm['kode_surat'], 'nik_penerima'=> $this->session->userdata('nik')])->row_array();
                                //print_r($disposisi_surat);
                                //print_r($verifikasi_surat);
                                if(!empty($disposisi_surat)){
                                  echo "1";
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sm['nomor_surat']; ?></td>
                        <td><?php echo $sm['judul_surat']; ?></td>
                        <td><?php echo $pengirim['nama']; ?></td>
                        <td> <ul>
                          <?php
                              $verifikasi=$this->db->get_where('verifikasi_surat', ['kode_surat' =>  $sm['kode_surat']])->result_array();
                              foreach ($verifikasi as $v) :
                                $penerima=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $v['nik_penerima']])->row_array();
                               echo "<li>".$penerima['nama']."  <span class='badge border border-success text-success'>".$v['status_verifikasi']."</span></li>";
                              endforeach;
                          
                         ?>
                         </ul> </td>
                         <td><span class="badge border border-success text-success"> <?php echo $sm['status'];?></span></td>
                        <td><?php echo $sm['tanggal_surat']; ?></td>
                        <td>
                          <?php
                            if($sm['status']=="Disposisi" && $disposisi_surat['status_disposisi']=="Sudah"){
                              //echo "1";
                          ?>
                           <a href="<?php echo base_url();?>suratmasuk/detailsuratmasuk/<?php echo $sm['kode_surat'];?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="more-horizontal"></i></a>
                          <?php
                            }else{
                               //echo "2";
                          ?>
                            <a href="<?php echo base_url();?>suratmasuk/disposisisurat/<?php echo $sm['kode_surat'];?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                      <?php
                      }elseif(!empty($verifikasi_surat)){
                       echo "2";
                        ?>
                         <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sm['nomor_surat']; ?></td>
                        <td><?php echo $sm['judul_surat']; ?></td>
                        <td><?php echo $pengirim['nama']; ?></td>
                        <td> <ul>
                          <?php
                              $verifikasi=$this->db->get_where('verifikasi_surat', ['kode_surat' =>  $sm['kode_surat']])->result_array();
                              foreach ($verifikasi as $v) :
                                $penerima=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $v['nik_penerima']])->row_array();
                               echo "<li>".$penerima['nama']."  <span class='badge border border-success text-success'>".$v['status_verifikasi']."</span></li>";
                              endforeach;
                          
                         ?>
                         </ul> </td>
                         <td><span class="badge border border-success text-success"> <?php echo $sm['status'];?></span></td>
                        <td><?php echo $sm['tanggal_surat']; ?></td>
                        <td>
                          <?php
                          if ($verifikasi_surat['status_verifikasi']=="Disetujui"){
                            //echo "Verifikasi 1";
                            
                          ?>
                          <a href="<?php echo base_url();?>suratmasuk/detailsuratmasuk/<?php echo $sm['kode_surat'];?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="more-horizontal"></i></a>
                          <?php
                            }else{
                              // echo "Verifikasi 2";
                          ?>
                          <a href="<?php echo base_url();?>suratmasuk/verifikasisurat/<?php echo $sm['kode_surat']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
                            <?php
                            }
                            
                            ?>
                        </td>
                      </tr>
                      <?php
                      }
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