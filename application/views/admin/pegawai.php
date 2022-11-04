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
                <h6 class="card-title">Data Pegawai</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($pegawai as $p) :
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $p['nik']; ?></td>
                        <td><?php echo $p['nama']; ?></td>
                        <td><?php echo $p['jbtn']; ?></td>
                        <td><?php echo $p['tmp_lahir']; ?></td>
                        <td><?php echo $p['tgl_lahir']; ?></td>
                        <td><?php echo $p['alamat']; ?></td>
                        <td><?php echo $p['stts_aktif']; ?></td>
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