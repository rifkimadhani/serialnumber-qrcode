<!DOCTYPE html>
<html>
<head>
    <title>QR Codes PDF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .page-break {
            page-break-after: always;
        }
        .qr-code {
            display: inline-block;
            width: 19%;
            text-align: center;
        }
        .qrcode-container {
            display: inline-block;
            padding: 5px;
            border: 2px solid black;
            border-radius: 5px;
        }
        img {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    @foreach($qrCodes->chunk(25) as $chunk)
        @foreach($chunk->chunk(5) as $row)
            <div class="row center">
                @foreach($row as $qrCode)
                    <div class="qr-code">
                        <div class="qrcode-container">
                            <img src="{{ public_path($qrCode->qr_code) }}" width="100%">
                        </div>
                        <p style="font-size: 11px; margin-top:5px">{{ $qrCode->serial_number }}</p>
                        {{-- <p>{{ $qrCode->model_number }}</p> --}}
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="page-break"></div>
    @endforeach
</body>
</html>
