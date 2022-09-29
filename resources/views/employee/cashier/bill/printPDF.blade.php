<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ strtoupper($orders->orderCode) }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: normal;
            /* inherit */
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 25px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box table tr.totals td:nth-child(2) {
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://daengweb.id/front/dw-theme/images/logo-head.png" width="150px">
                            </td>

                            <td>
                                Invoice : <strong>#{{ strtoupper($orders->orderCode) }}</strong><br>
                                {{ $orders->invoice->order_date }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>PENERIMA</strong><br>
                                Table - {{ $orders->table_id }}<br>
                            </td>

                            <td>
                                <strong>PENGIRIM</strong><br>
                                Ogani Shop<br>
                                085343966997<br>
                                Jl Sultan Hasanuddin<br>
                                Andounohu, Kendari<br>
                                Sulawesi Tenggara
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Product</td>
                <td>Harga</td>
            </tr>

            @foreach ($orders->orderProduct as $row)
                <tr class="item">
                    <td>
                        {{ $row->product->name_product }} <strong>(x {{ $row->quantity }})</strong>
                    </td>
                    <td>Rp. {{ number_format($row->total_price) }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td></td>
            </tr>
            <tr class="total">
                <td></td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Pajak (11%)
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total Harga: Rp. {{ number_format($orders->total) }}
                </td>
            </tr>
            @if ($orders->invoice->payMethod === 'cashless')
            @else
                <tr class="total">
                    <td></td>
                    <td>
                        Total Pembayaran: Rp. {{ number_format($orders->invoice->payTotal) }}
                    </td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>
                        Total Kembali: Rp. {{ number_format($orders->invoice->PayBack) }}
                    </td>
                </tr>
            @endif
            <tr>
                <td><strong>Detail Pembayaran</strong></td>
                <td></td>
            </tr>
            <tr>
                <td>Metode Pembayaran : {{ strtoupper($orders->invoice->payMethod) }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Tanggal: {{ $orders->invoice->order_date }}</td>
                <td></td>
            </tr>
        </table>

    </div>
</body>

</html>
