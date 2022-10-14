<html>

<head>


    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 125mm;
            min-height: 176mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px black solid;
            height: 215mm;
            outline: 2cm #FFEAEA solid;
        }
        .subpage2 {
            padding: 1cm;
            border: 5px black solid;
            height: 176mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 125mm;
                height: 176mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        th {
            border: 1px solid black;
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage2">
                <div style="text-align: center;">
                    <img src="https://ik.imagekit.io/dxofqajmq/Tugas_Akhir/logo_SZubKxvSW.png?ik-sdk-version=javascript-1.4.3&updatedAt=1665337714536"
                        width="150px">
                    <h2>TABLE - {{ $table->no_table }}</h3>
                        <h6>ACCEPTED HERE</h6>
                </div>
                <div style="text-center">
                    <table class="table-bordered" style="margin:auto; text-align:center;">
                        <tr>
                            <th border:1px>
                                <div class="visible-print text-center">
                                    <img width="250px" src="data:image/png;base64, {!! $qrcode !!}">
                                </div>
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <td>- please scan here -</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div style="text-align: center;">
                    <img src="https://ik.imagekit.io/dxofqajmq/Tugas_Akhir/logo_SZubKxvSW.png?ik-sdk-version=javascript-1.4.3&updatedAt=1665337714536"
                        width="150px">
                    <h2>Cara Pemesanan Melalui Aplikasi</h3>
                        <h6>Ikuti Panduan Berikut ini</h6>
                </div>
                <div style="text-center">
                    <table class="table-bordered" style="margin:auto; text-align:center;">
                        <tr>
                            <th border:1px>
                               1. Log In Melalui QR Code yang Sudah di Sediakan Oleh Restoran.
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <th border:1px>
                               2. Lakukan Pemindaian pada QR Code yang Terdapat Pada Meja Tempat Anda Duduk.
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <th border:1px>
                               3. Pilih Kategori dan Menu Makanan Sesuai dengan Keinginan Anda
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <th border:1px>
                               4. Lakukan Checkout, lalu Periksa Pesanan Anda Agar Tidak Terjadi Kesalahan
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <th border:1px>
                               5. Lakukan Pemesanan dan Menunggu Hingga Pelayan Mengantarkan Pesanan Anda
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <th border:1px>
                               6. Nikmati Hidangan Anda, Selamat Menikmati :)!
                            </th>
                        </tr>
                        <br>
                        <tr>
                            <td>- enjoy your foods -</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
