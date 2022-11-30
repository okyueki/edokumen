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
                
                <div class="table-responsive mt-3">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Jenis Cuti</th>
                        <th>Total Cuti</th>
                        <th>Sisa Cuti</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            //print_r($cuti);
                            foreach ($cuti as $c) :
                              $pegawai=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $c['nik']])->row_array();
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pegawai['nama']; ?></td>
                        <td><?php echo $c['jenis_cuti']; ?></td>
                        <td><?php echo $c['total']; ?></td>
                        <td><?php echo 12-$c['total']; ?></td>
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