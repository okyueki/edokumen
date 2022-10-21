<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>eDokumen || RS. Aisyiyah Siti Fatimah Tulangan</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo1/style.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon.ico" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body{
            background: #e3e3e3;
        }
        .a4 {
            background: #FFFFFF;
            margin: 0 auto;
            width: 210mm;
            height: 297mm;
            padding: 0 1.5cm;        
        }
        .no-padding > tbody > tr > td{
            font-size: 14px;
            padding-top:5px !important; 
            padding-bottom:2px !important;
            padding-left:0px !important;
        }
        @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .a4 {
            margin: 0 1.5cm;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    </style>
</head>
<body>
    <div class="a4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <img width="280" src="<?php echo base_url(); ?>assets/images/logosifat.png" alt="Siti Fatimah Logo">
                    <hr>
                    <h4 style="text-align:center;text-decoration:underline;">PERMOHONAN CUTI / AMBIL LIBUR</h4>
                </div>
                <div class="col-12">
                    <br>
                    <p>Kepada Yth.: Direktur </p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Di Rumah Sakit ‘Aisyiyah Siti Fatimah Tulangan</p>
                </div>
                <div class="col-12">
                    <p>Assalamu ‘alaikum Warahmatullahi Wabarakaatuh</p>
                </div>
                <div class="col-12">
                    <p>Yang bertanda tangan dibawah ini, saya :</p>
                </div>
                <div class="col-12">
                    <table class="table table-borderless no-padding">
                        <tbody>
                            <?php
                             $pegawaix=$this->db2->select('nik,nama,departemen,jbtn')->get_where('pegawai', ['nik' =>  $cuti['nik']])->row_array();
                            ?>
                            <tr>
                                <td style="width:200px;">Nama Lengkap</td>
                                <td style="width:30px;">:</td>
                                <td>
                                    <?php echo $pegawaix['nama']?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:200px;">NIK</td>
                                <td style="width:30px;">:</td>
                                <td>
                                    <?php echo $pegawaix['nik']?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Unit Kerja</td>
                                <td style="width:30px;">:</td>
                                <td><?php echo $pegawaix['departemen']?></td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Jabatan</td>
                                <td style="width:30px;">:</td>
                                <td><?php echo $pegawaix['jbtn']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <p>Dengan ini mengajukan permohonan :</p>
                </div>
                <div class="col-12">
                    <h5 style="text-align:center;text-decoration:underline;">Cuti <?php echo $cuti['jenis_cuti']?></h5>
                </div>
                <div class="col-12">
                    <p>Selama <b> <?php echo $cuti['jumlah']?> Hari </b> <u>Pada Hari <?php echo longdate_indo($cuti['tanggal_awal']);?> </u> dan bekerja kembali pada Hari <u> <?php echo longdate_indo($cuti['tanggal_akhir'])?> </u> Selama izin saya dapat dihubungi di : </p>
                </div>
                <div class="col-12">
                    <table class="table table-borderless no-padding">
                        <tbody>
                            <tr>
                                <td style="width:200px;">Alamat</td>
                                <td style="width:30px;">:</td>
                                <td><?php echo $cuti['alamat']?></td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Kepentingan</td>
                                <td style="width:30px;">:</td>
                                <td><?php echo $cuti['kepentingan']?></td>
                            </tr>
                            <tr>
                                <td style="width:200px;">No. Hp</td>
                                <td style="width:30px;">:</td>
                                <td><?php
                                      $petugas=$this->db2->select('no_telp')->get_where('petugas', ['nip' =>  $cuti['nik']])->row_array();
                                      echo $petugas['no_telp'];
                                ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <p>Demikian permohonan ini, atas perhatiannya disampaikan terima kasih.</p>
                    <p>Wassalamu ‘alaikum Warahmatullahi Wabarakaatuh</p>
                </div>

                <div class="col-12">
                    <table class="table table-borderless no-padding">
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;">Sidoarjo, <?php echo date_indo($cuti['tanggal']);?></td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">Menyetujui Atasan Tidak <br> Langsung
                                </td>
                                <td style="text-align:center;">Menyetujui Atasan <br>Langsung
                                </td>
                                <td style="text-align:center;">Pemohon</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="center"><img style="width:128px; height:auto; border-radius:0;" src="<?php echo base_url();?>assets/qrcode/<?php echo $cuti['qrcode'];?>" alt=""></td>
                                 <td align="center"><img style="width:128px; height:auto; border-radius:0;" src="<?php echo base_url();?>assets/qrcode/<?php echo $cuti['qrcode'];?>" alt=""></td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">(...................................)</td>
                                <td style="text-align:center;">
                                    <?php
                                        $pegawaixy=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $cuti['nik_pj']])->row_array();
                                        echo $pegawaixy['nama'];
                                    ?>
                                </td>
                                <td style="text-align:center;"><?php
                                        $pegawaixyz=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $cuti['nik']])->row_array();
                                        echo $pegawaixyz['nama'];
                                    ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <table class="table table-bordered sisacuti">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Cuti</th>
                                <th>Jumlah Cuti</th>
                                <th>Diambil</th>
                                <th>Sisa Cuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tahunan</td>
                                <td>12</td>
                                <td><?php
                                    foreach ($totalcutix as $t) :
                                        if ($t['jenis_cutix']=="Tahunan") {
                                            echo $t['totalsemuacuti'];
                                        }
                                    endforeach;
                                    ?>
                            </td>
                                <td>
                                    <?php
                                    foreach ($totalcutix as $t) :
                                        if ($t['jenis_cutix']=="Tahunan") {
                                            echo 12 - $t['totalsemuacuti'];
                                        }
                                    endforeach;
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>