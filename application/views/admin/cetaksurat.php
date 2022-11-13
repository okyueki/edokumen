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
            height: auto;
            padding: 0 1.5cm;        
        }
        .no-padding > tbody > tr > td{
            font-size: 14px;
            padding-top:5px !important; 
            padding-bottom:2px !important;
            padding-left:0px !important;
        }
        .MsoTableGrid{
            width: 100% !important;
            height: 0px !important;
            border-spacing: 0 !important;
        }
        .MsoTableGrid > tbody > tr,
        .MsoTableGrid > tbody > tr td{
            border-spacing: 0 !important; 
            border-collapse: collapse !important;
            height: 10px !important;
        }
        .table{
            margin-top: 10px !important;
        }
        .table > tbody > tr > td{
            border: 0 !important;
            padding: 0 !important;
        }
        hr{
            border: 1px solid black;
            opacity: 1;
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
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
         .MsoTableGrid{
            width: 100% !important;
            height: 0 !important;
        }
    }
    </style>
</head>
<body>
    <div class="a4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <br>
                    <br>
                    <img width="280" src="<?php echo base_url(); ?>assets/images/logosifat.png" alt="Siti Fatimah Logo">
                   
                </div>
                 <div class="col-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td> <?php
                                    echo $cetaksurat['nomor_surat'];
                                ?></td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>:</td>
                                <td><?php
                                    echo $cetaksurat['lampiran'];
                                ?></td>
                            </tr>
                        </tbody>
                    </table>
                <hr>
                <?php
                    echo $cetaksurat['isi_surat'];
                ?>
                 </div>
                 <div class="col-12">
                    <p style="font-size: 12.0pt;"><strong>
                    <?php
                        $unit = $this->db->select('hak_akses.*, unit.nama_unit')->join('unit', 'unit.id_unit=hak_akses.id_unit')
                        ->get_where('hak_akses', ['nik' =>  $cetaksurat['nik_pengirim']])->row_array();

                        echo $unit['nama_unit']." ";
                    ?>    
                    RS ’Aisyiyah Siti Fatimah</strong></p>
                    <img style="width:128px; height:auto; border-radius:0;" src="<?php echo base_url();?>assets/qrcode/<?php echo $cetaksurat['qrcode'];?>" alt="">
                    <p style="font-size: 12.0pt;"><u><strong><?php
                        $pegawaixy=$this->db2->select('nama')->get_where('pegawai', ['nik' =>  $cetaksurat['nik_pengirim']])->row_array();
                         echo $pegawaixy['nama'];
                    ?></strong></u></p>
                 </div>
            </div>
        </div>

    </div>

</body>

</html>