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
        .MsoNormal{
             border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
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
                    <hr>
                </div>
                <?php
                    echo $cetaksurat['isi_surat'];
                ?>
            </div>
        </div>

    </div>

</body>

</html>