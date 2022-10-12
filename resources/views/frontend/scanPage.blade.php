<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .drop-area {
            /* Center the content */
            align-items: center;
            display: flex;
            justify-content: center;

            /* Border */
            border: 0.25rem dashed #d1d5db;
            border-radius: 0.25rem;
        }
    </style>
    @laravelPWA
</head>
<body>
    <div class="container mt-5">
        <div class="drop-area">
            {{-- <div id="qr-reader" style="width:500px"></div> --}}
            <div id="qr-reader-results"></div>
            <div class="card">
                <div class="card-header">
                    Scan Here
                </div>
                <div class="card-body">
                    <h5 class="card-title">Scanner QR Code</h5>
                    <p class="card-text">Complete these step to order foods.</p>
                    <div id="qr-reader"></div>

                </div>
                <div class="card-footer text-muted">
                    place it according to the qr code in the middle of the scanner
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" ||
            document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function() {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                document.location = decodedText;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>

</html>
