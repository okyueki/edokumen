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
        .table th, .datepicker table th, .table td, .datepicker table td {
                white-space: normal !important;
                border: 1px solid black !important;
            }
        .table > :not(caption) > * > *, .datepicker table > :not(caption) > * > * {
    padding: 0.45rem 0.85rem !important;

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
                    <h4 style="text-align:center;text-decoration:underline;">Lembar Disposisi</h4>
                </div>
                <br>
                <br>
                <div class="col-12">
                    <table class="table table-bordered no-padding">
                        <tr>
                            <td colspan="4">
                                <ul class="d-flex flex-wrap bd-highlight">
                                    <?php 
                                         foreach ($sifat as $s) :
                                    ?>
                                    <li 
                                    <?php if($s['id_sifat'] == $cetakdisposisi['id_sifat']){?>
                                    style="background-size: 16px;list-style-image: url('<?php echo base_url()?>assets/images/centang.png');" 
                                    <?php
                                    }
                                    ?>
                                    class="flex-fill"><?php echo $s['nama_sifat']?></li>
                                    <?php
                    
                                        endforeach;
                                    ?>
                                </ul>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>No. Surat</td>
                            <td style="width: 15px;">:</td>
                            <td><?php echo $cetakdisposisi['nomor_surat'];?></td>
                            <td>Tanggal Penyelesaian</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo $cetakdisposisi['tanggal_surat'];?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td colspan="2"><?php echo $cetakdisposisi['judul_surat'];?></td>
                        </tr>
                        <tr>
                            <td>Pengirim</td>
                            <td>:</td>
                            <td  colspan="2">
                                <?php
                                     $penerima=$this->db2->get_where('pegawai', ['nik' =>  $cetakdisposisi['nik_pengirim']])->row_array();
                                     echo $penerima['nama'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Diteruskan Kepada</td>
                            <td style="text-align: center;" colspan="2">Isi Disposisi</td>
                            <td style="text-align: center;">Tanggal</td>
                        </tr>
                   
                        
                            <?php
                            $penerima=$this->db->select('disposisi.*')
                                    ->join('disposisi', 'surat.kode_surat=disposisi.kode_surat')
                                    ->get_where('surat', ['surat.kode_surat' =>  $cetakdisposisi['kode_surat']])->result_array();
                            foreach ($penerima as $p) :
                            $penerimax=$this->db2->get_where('pegawai', ['nik' =>  $p['nik_disposisi_ke']])->row_array();
                            ?><tr>
                            <td><?php echo $penerimax['nama']?></td>
                            <td style="text-align: center;"colspan="2"><?php echo $p['catatan_disposisi']?></td>
                            <td style="text-align: center;"><?php echo $p['tanggal_disposisi']?></td>
                            </tr>
                            <?php
                        endforeach;
                    ?>    
                        
                   
                    </table>                   
                </div>
            </div>
            <div class="row">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2 bd-highlight">
                        <img style="width:128px; height:auto; border-radius:0;" src="<?php echo base_url();?>assets/qrcode/<?php echo $cetakdisposisi['qrcode_disposisi'];?>" alt="">
                    </div>
                
                </div>
            </div>
        </div>

    </div>

</body>

</html>