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
                <h6 class="card-title">Ebook</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Ebook</th>
                        <th>Judul Ebook</th>
                        <th>Jumlah Halaman</th>
                        <th>Berkas</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                            $i = 1;
                            foreach ($perpustakaan_ebook as $p) :
                         ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $p['kode_ebook']; ?></td>
                        <td><?php echo $p['judul_ebook']; ?></td>
                        <td><?php echo $p['jml_halaman']; ?></td>
                        <td>
                            <?php
                            if($p['berkas']!=""){    
                          ?>
                            <a target="_blank" href="http://192.168.10.200/webapps2/ebook/<?php echo $p['berkas']; ?>"><i class="link-icon" data-feather="paperclip"></i></a>
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