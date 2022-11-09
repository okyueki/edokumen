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
                        <th>Judul Surat</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Disposisi</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($suratmasuk as $sm) :
                                $pengirim=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $sm['nik_pengirim']])->row_array();
                                $penerima = explode(",", $sm['nik_penerima']);
                                $nik_disposisi = explode(",", $sm['nik_disposisi']);
                              
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sm['judul_surat']; ?></td>
                        <td><?php echo $pengirim['nama']; ?></td>
                        <td><ul>
                          <?php
                            $hitung=count($penerima);
                            foreach ($penerima as $p) :
                              $penerima=$this->db2->get_where('pegawai', ['nik' =>  $p])->row_array();
                            if ($hitung > 1) {
                              echo "<li>".$penerima['nama']."<br></li>";
                            }else{
                              echo "<li>".$penerima['nama']."</li>";
                            }                           
                          endforeach;
                          
                         ?>
                         </ul></td>
                         <td><ul>
                          <?php
                            $hitungx=count($nik_disposisi);
                            foreach ($nik_disposisi as $ndx) :
                              $penerimax=$this->db2->get_where('pegawai', ['nik' =>  $ndx])->row_array();
                            if ($hitungx > 1) {
                              echo "<li>".$penerimax['nama']."<br></li>";
                            }else{
                              echo "<li>".$penerimax['nama']."</li>";
                            }                           
                          endforeach;
                          
                         ?>
                         </ul></td>
                        <td><?php echo $sm['tanggal']; ?></td>
                        <td>
                          <?php
                            if($sm['status'] == "Disposisi"){
                          ?>
                        
                            <a href="<?php echo base_url();?>suratmasuk/detailsurat/<?php echo $sm['kode_surat']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="more-horizontal"></i></a>
                            
                          <?php
                         
                          }else{
                          ?>
                          <a href="<?php echo base_url();?>suratmasuk/verifikasisurat/<?php echo $sm['kode_surat']?>" class="btn btn-primary me-2"><i class="link-icon" data-feather="edit"></i></a>
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