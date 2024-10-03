<!DOCTYPE html>
<html>

<head>
    <title>QR Codes PDF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
    /* Set the page size for A3 printing */
    @page {
        size: A3;
        margin: 1cm;
    }

    .page-break {
        page-break-after: always;
    }

    .qr-code {
        display: inline-block;
        width: 54px;
        /* width: 94.49px; */
        /* width: 113px; */
        /* around 3cm */
    }

    /* .qrcode-container {
        display: inline-block;
        padding: 5px;
        border: 2px solid black;
        border-radius: 5px;
        margin-right: 5px;
        margin-left: 5px;
    } */

    .cut-container {
        display: inline-grid;
        padding: 3px;
        border: 1px solid black;
        border-radius: 5px;
        /* margin-right: 0.3px !important;
        margin-left: 0.3px !important;
        margin-bottom: 0.3px !important; */
        /* margin: 0px !important; */
        width: fit-content;
        border-style: dashed;

    }

    .default-container {
        display: inline-block;
        padding: 3px 1px 2px 5px;
        border: 1px solid black;
        border-radius: 4px;
        /* margin-right: 2px; */
        /* margin-left: 2px; */
        /* margin-bottom: 5px; */
        margin: 0px !important;
        min-width: 155px;
        width: fit-content;
    }

    .merk {
        font-size: 9.5px;
        margin-top: 0px !important;
        margin-bottom: 3px;
        /* margin-right: 122px; */
        /* margin-left: 5px; */
        /* margin-right: 86px; */
        border-bottom: 0.5px solid black;
        font-family: "helvetica";
    }

    .details {
        font-size: 6.5px;
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        font-family: "dejavu sans mono";
        line-height: 140%;
    }

    img {
        display: block;
        width: 100%;
    }

    tr {
        border: none;
    }

    td {
        padding: 0px !important;
    }
    </style>
</head>

<body>
    @foreach($qrCodes->chunk(138) as $chunk)
    <!-- <div style="margin-top: 37.79px"></div> -->
    @foreach($chunk->chunk(6) as $row)
    <div class="row" style="padding: 0px !important; margin-bottom: 2px !important;">
        <!-- <div class="row" style="display: grid; grid-template-columns: auto auto auto auto auto auto; gap: 0px;"> -->
        @foreach($row as $qrCode)
        <div class="cut-container" style="margin: 0px;">
            <div class="default-container">
                <div class="row" style="margin-bottom: 0px !important;">
                    <div class="col s7" style="padding: 0 2px 0 0 !important;">
                        <p class="merk"><b>Quokka Box</b></p>
                        <div>
                            <table style="margin-bottom: 1px;" width="100%">
                                <tbody>
                                    <tr>
                                        <td class="details"><b>Model&nbsp;&nbsp;#</b></td>
                                        <td class="details"><b>:</b></td>
                                        <td class="details">{{ $qrCode->model_number }}</td>
                                        <!-- <td></td> -->
                                    </tr>
                                    <tr>
                                        <td class="details"><b>Serial&nbsp;#</b></td>
                                        <td class="details"><b>:</b></td>
                                        <td class="details">{{ $qrCode->serial_number }}</td>
                                        <!-- <td></td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col s5 center" style="padding: 1px 0px 0px 0px !important;">
                        <!-- <div class="qr-code" style="border-left: 1px solid black;"> -->
                        <div class="qr-code">
                            <div style="padding-left: 10px;">
                                <img src="{{ public_path($qrCode->qr_code) }}" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
    <!-- <div class="page-break"></div> -->
    @endforeach
</body>



</html>
