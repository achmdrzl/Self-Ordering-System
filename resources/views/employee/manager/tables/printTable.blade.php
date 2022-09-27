<html>

<head>
</head>

<body>
    <div style="text-align: center;">
        <h3>TABLE - {{ $table->no_table }}</h3>
    </div>
    <div style="text-center">
        <table class="table-bordered" style="margin:auto; text-align:center;">
            <tr>
                <th>
                    <div class="visible-print text-center">
                        <img src="data:image/png;base64, {!! $qrcode !!}">
                    </div>
                </th>
            </tr>
            <br>
            <tr>
                <td>- please scan here -</td>
            </tr>
        </table>
    </div>
</body>

</html>
