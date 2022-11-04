<div class="page-content">

	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url()?>dashboard">eDokumen</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul;?></li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="position-relative">
					<figure class="overflow-hidden mb-0 d-flex justify-content-center">
						<img src="<?php echo base_url(); ?>assets/images/bgprofil.jpg" class="rounded-top" alt="profile cover">
					</figure>
					<div
						class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
						<div>
							<img class="wd-70 rounded-circle"
								src="<?php echo 'http://192.168.10.200/webapps2/penggajian/'.$pegawai['photo'];?>" alt="profile">
							<span class="h4 ms-3 text-dark"><?php echo $pegawai['nama']; ?></span>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center p-3 rounded-bottom">
					<ul class="d-flex align-items-center m-0 p-0">
						<li class="d-flex align-items-center active">
							<i class="me-1 icon-md text-primary" data-feather="columns"></i>
							<a class="pt-1px d-none d-md-block text-primary" href="#">My Information</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="user"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">About</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="users"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Friends <span
									class="text-muted tx-12">3,765</span></a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="image"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Photos</a>
						</li>
						<li class="ms-3 ps-3 border-start d-flex align-items-center">
							<i class="me-1 icon-md" data-feather="video"></i>
							<a class="pt-1px d-none d-md-block text-body" href="#">Videos</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row profile-body">

		<!-- middle wrapper start -->
		<div class="row">
			<div class="position-relative">
				<div class="card rounded">
					<div class="card-header">
						<div class="d-flex align-items-center justify-content-between">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">
									<div class="ms-2">
										<p>Mike Popescu</p>
										<p class="tx-11 text-muted">1 min ago</p>
									</div>
								</div>
								<div class="dropdown">
									<a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										<i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
									</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
										<a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh"
												class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
										<a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
												data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
										<a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2"
												class="icon-sm me-2"></i> <span class="">Share</span></a>
										<a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy"
												class="icon-sm me-2"></i> <span class="">Copy link</span></a>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<p>Assalamualaikum Saya <?php echo $pegawai['nama']; ?> Pegawai RS Aisyiyah Siti Fatimah Rumah saya
								beralamat di </p>
							<img class="img-fluid" src="https://via.placeholder.com/689x430" alt="">
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Nomor Induk Kepegawaian: </label>
								<p class="text-muted"><?php echo $pegawai['nik']; ?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Jabatan:</label>
								<p class="text-muted"><?php echo $pegawai['jbtn']; ?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Unit:</label>
								<p class="text-muted"><?php echo $pegawai['nama_departemen']; ?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Alamat :</label>
								<p class="text-muted"><?php echo $pegawai['alamat']?> <?php echo $pegawai['kota']?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Tempat,Tgl Lahir :</label>
								<p class="text-muted"><?php echo $pegawai['tmp_lahir']?>,<?php echo $pegawai['tgl_lahir']?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">No KTP :</label>
								<p class="text-muted"><?php echo $pegawai['no_ktp']?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Bidang :</label>
								<p class="text-muted"><?php echo $pegawai['bidang']?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">Status :</label>
								<p class="text-muted"><?php echo $pegawai['stts_nikah']?></p>
							</div>
							<div class="mt-3">
								<label class="tx-11 fw-bolder mb-0 text-uppercase">No Telfon:</label>
								<p class="text-muted"><?php echo $pegawai['no_telp']?></p>
							</div>
						</div>
					</div>
				</div>
				<!-- middle wrapper end -->
			</div>
