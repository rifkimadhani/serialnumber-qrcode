<?//= ini_set('max_execution_time', 120); ?>
@extends('layouts.template')

@section('title', 'ME | Data Client')

@section('content')
<div style="margin: 5vh 5vw">
    <div>
        @if(session('error'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.toast({
                html: "{{ session('error') }}",
                classes: 'toast-e z-depth-5'
            });
        });
        </script>
        @endif
        @if(session('success'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.toast({
                html: "{{ session('success') }}",
                classes: 'toast-s z-depth-5'
            });
        });
        </script>
        @endif
    </div>

    <span id="percentageNum"></span>
    <div class="progress" style="display: none;">
        <div class="determinate" style="width: 0%;"></div>
    </div>


    <div class="row">
        <div class="col s4" style="padding-left: 0">
            {{-- GENERATOR --}}
            <div class="card z-depth-2" style="border-radius: 7px;">
                <div class="card-content">
                    <span class="card-title"
                        style="font-size: 18px; margin-left: .5em; margin-bottom: 1.2em;"><strong>QR CODE
                            GENERATOR</strong></span>
                    <div class="divider"></div>
                    <br>
                    {{-- FORM --}}
                    <form id="uploadForm" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data"
                        style="text-align: right">
                        @csrf
                        <div class="file-field input-field">
                            <div class="btn hoverable" style="background-color: #0C3E7A">
                                <span><i class="material-icons">cloud_upload</i></span>
                                <input type="file" name="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate truncate" type="text"
                                    placeholder="Upload Serial Number Data [.xlsx]">
                            </div>
                        </div>
                        <div style="margin-bottom: 1em"></div>

                        <button class="btn waves-effect waves-light hoverable"
                            style="margin-right: .5em; background-color: #0C3E7A" type="submit" name="action">Generate
                            {{-- <i class="material-icons right">wallpaper</i> --}}
                        </button>
                    </form>
                </div>
            </div>

            {{-- DOWNLOAD RANGE --}}
            <div class="card z-depth-2" style="border-radius: 7px;">
                <div class="card-content">
                    <span class="card-title"
                        style="font-size: 18px; margin-left: .5em; margin-bottom: 0 !important"><strong>DOWNLOAD BY
                            RANGE</strong></span>
                    <span style="color: #24A69A; font-size: 12px; margin-left: .7em; margin-bottom: 1em;">
                        Maksimum 500 data.
                    </span>

                    <div class="divider"></div>

                    <form action="{{ route('download-pdf-range') }}" method="POST" style="text-align: right">
                        @csrf
                        <div class="row" style="display:flex; align-items: center; margin-top: 1em;">
                            <div class="input-field col s5">
                                <input class="truncate" id="start_serial" name="start_serial" type="text"
                                    placeholder="Start Serial Number" required>
                            </div>
                            <div class="col s2 center">
                                <span>To</span>
                            </div>
                            <div class="input-field col s5">
                                <input class="truncate" id="end_serial" name="end_serial" type="text"
                                    placeholder="End Serial Number" required>
                            </div>
                        </div>
                        <div style="margin-bottom: 1em"></div>

                        <button type="submit" class="btn waves-effect waves-light hoverable center"
                            style="background-color: #0C3E7A; font-size: 11px; margin-right: .5em;">Download
                            <i class="material-icons right">cloud_download</i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- DOWNLOAD & DELETE SELECTED --}}
        <div class="col s8" style="padding-right: 0">
            <div class="card z-depth-1" style="border-radius: 7px;">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row" style="display: flex; justify-content: space-between; margin-right: .3em">
                            <div class="col s6" style="display: flex; justify-content: flex-start;">
                                <button id="selectAllRows" class="btn-small waves-effect waves-light hoverable"
                                    style="background-color: #0C3E7A; font-size: 11px;">Select All
                                    <i class="material-icons right">select_all</i>
                                </button>
                            </div>

                            <div class="col s6" style="display: flex; justify-content: flex-end; gap: .2em;">
                                <button id="downloadSelected"
                                    class="btn-small waves-effect waves-light hoverable disabled"
                                    style="background-color: #0C3E7A; font-size: 11px;">
                                    <i class="material-icons ">cloud_download</i>
                                </button>

                                <button id="deleteSelected"
                                    class="btn-small waves-effect waves-light hoverable disabled"
                                    style="background-color: #FF595E; font-size: 11px;">
                                    <i class="material-icons ">delete</i>
                                </button>
                            </div>

                            {{-- <a href="{{ route('download-pdf') }}" class="waves-effect waves-light btn-small
                            hoverable" style="background-color: #0C3E7A;font-size: 11px;">Download All
                            <i class="material-icons right">cloud_download</i>
                            </a> --}}
                        </div>
                    </div>

                    <div class="divider"></div>

                    <section class="section" style="padding-bottom: 1px">
                        <!-- {{-- TABLE --}} -->
                        <div class="row">
                            <div class="col s12 l12">
                                <table id="qrCodesTable" class="display striped responsive-table nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Serial Number</th>
                                            <th>Model Number</th>
                                            <th>QR Code</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- js materializecss -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<!-- jquery with datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('upload') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.progress').show();
                var interval = setInterval(function() {
                    $.getJSON("{{ route('progress') }}", function(data) {
                        var progress = data.progress;
                        $('.determinate').css('width', progress + '%');

                        var decimals = progress.toFixed(2);

                        $('#percentageNum').text(decimals + '%');

                        if (progress >= 100) {
                            clearInterval(interval);
                            alert('QR Code generation completed!');
                            window.location.reload();
                        }
                    });
                }, 500);
            },
            error: function(response) {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
</script>

<script>
// DISABLE/ENABLE BUTTON DOWNLOAD/SELECT
function updateButtonState() {
    var selectedQRCodes = $('input[name="selectedQRCodes[]"]:checked').length;
    if (selectedQRCodes === 0) {
        $('#downloadSelected').addClass('disabled');
        $('#deleteSelected').addClass('disabled');
    } else {
        $('#downloadSelected').removeClass('disabled');
        $('#deleteSelected').removeClass('disabled');
    }
}

// DATATABLE
$(document).ready(function() {
    var table = $('#qrCodesTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 500,
        order: [
            [1, 'asc']
        ],
        ajax: '{{ route("qr-codes.data") }}',
        columns: [{
                data: 'select',
                name: 'select',
                orderable: false,
                searchable: false,
                className: 'center',
            },
            {
                data: 'serial_number',
                name: 'serial_number'
            },
            {
                data: 'model_number',
                name: 'model_number'
            },
            {
                data: 'qr_code',
                name: 'qr_code',
                orderable: false,
                searchable: false,
                className: 'center',
                width: '15%'
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        return date.toLocaleDateString('en-GB') + ' ' + date
                            .toLocaleTimeString('en-GB');
                    }
                    return data;
                },
                className: 'center'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'center',
            }
        ],
        layout: {
            topStart: {
                buttons: ['selectAll', 'selectNone']
            }
        },
        language: {
            buttons: {
                selectAll: 'Select all items',
                selectNone: 'Select none'
            }
        },
        drawCallback: function() {
            // Reinitialize materialboxed after the DataTable redraws
            $('.materialboxed').materialbox();
            document.querySelectorAll('.material-placeholder').forEach(function(element) {
                element.style.cssText =
                    "display: grid; place-items: center; width:fit-content;";
            });
        }

    });

    $('#qrCodesTable').on('change', 'input[name="selectedQRCodes[]"]', function() {
        updateButtonState();
    });

    $('#selectAllRows').click(function() {
        var rows = table.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', true);
        updateButtonState();
    });

    $('#deleteSelected').click(function() {
        var selectedQRCodes = $('input[name="selectedQRCodes[]"]:checked').map(function() {
            return this.value;
        }).get();

        if (selectedQRCodes.length === 0) {
            alert('Please select QR codes to delete.');
            return false;
        }

        $.ajax({
            url: '{{ route("delete-selected") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                selectedQRCodes: selectedQRCodes
            },
            success: function(response) {
                if (response.success) {
                    M.toast({
                        html: response.message,
                        classes: 'toast-s z-depth-5'
                    });
                    window.location.reload();
                } else {
                    M.toast({
                        html: response.message,
                        classes: 'toast-e z-depth-5'
                    });
                }
            },
            error: function(response) {
                M.toast({
                    html: 'An error occurred. Please try again.',
                    classes: 'toast-e z-depth-5'
                });
            }
        });
    });

    // download selcted data
    updateButtonState();

    $('#downloadSelected').click(function() {
        var selectedQRCodes = $('input[name="selectedQRCodes[]"]:checked').map(function() {
            return this.value;
        }).get();

        if (selectedQRCodes.length === 0) {
            alert('Please select QR codes to download.');
            return false;
        }

        window.location.href = '{{ route("download-selected-pdf") }}?ids=' + selectedQRCodes.join(
            ',');
    });

    $('select').formSelect();
});
</script>

@endsection