<!DOCTYPE html>
<html>

<head>
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
        <table style="width: 100%;">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://daengweb.id/front/dw-theme/images/logo-head.png" width="150px">
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
                                <strong>Periode Waktu</strong><br>
                                {{ date('d F Y', strtotime($start)) }} s/d {{ date('d F Y', strtotime($end)) }} <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Order Date</td>
                <td>Payment Method</td>
                <td>Total</td>
                <td>Total Payment</td>
                <td>Saldo</td>
            </tr>
            @foreach ($invoices as $row)
                <tr class="item">
                    <td>
                        <strong>{{ $row->order_date }}</strong>
                    </td>
                    <td>{{ strtoupper($row->payMethod) }}</td>
                    <td>Rp. {{ number_format($row->total) }}</td>
                    <td>Rp. {{ $row->payTotal == 0 ? '0.00' : number_format($row->payTotal) }}</td>
                    <td>Rp. {{ $row->PayBack == 0 ? '0.00' : number_format($row->PayBack) }}</td>
                </tr>
            @endforeach

            <tr class="heading">
                <td></td>
                <td></td>
                <td>Rp. {{ number_format($total) }}</td>
                <td>Rp. {{ $payTotal == 0 ? '0.00' : number_format($payTotal) }}</td>
                <td>Rp. {{ $payBack == 0 ? '0.00' : number_format($payBack) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
