<?//= ini_set('max_execution_time', 120); ?>
<!DOCTYPE html>
<html>
<head>
    <title>ME | QR Code Generator</title>

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href=" {{asset('favicons/apple-touch-icon.png')}} ">
    <link rel="icon" type="image/png" sizes="32x32" href=" {{asset('favicons/favicon-32x32.png')}} ">
    <link rel="icon" type="image/png" sizes="16x16" href=" {{asset('favicons/favicon-16x16.png')}} ">
    <link rel="manifest" href=" {{asset('favicons/site.webmanifest')}} ">
    <!-- END Icons -->

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import DataTables CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        /* navbar */
        .navbar-fixed .nav-wrapper .brand-logo img {
            height: 6vh;
        }
        .display img {
            width: 45%;
        }
        nav .brand-logo img {
            padding-bottom: 1vh;
            vertical-align: middle;
        }

        /* datatable */
        .dataTables_length label {
            color: #24A69A;
        }

        .dataTables_processing {
            color: #24A69A;
            font-size: 12px;
        }

        .dataTables_info {
            color: #24A69A;
            font-size: 12px;
        }

        .dataTables_empty {
            color: #999;
        }

        /* .dataTables_length .select-dropdown {
            color: #24A69A;
        } */
        .dataTables_filter label {
            color: #24A69A;
        }

        .dataTables_paginate .pagination .active a{
            background-color: #24A69A;
        }

        li .next > a{
            color: #24A69A;
        }

        td, th {
            padding: 5px 5px !important;
        }

        /* notification's toast */
        .toast-s {
            background: rgba(36, 166, 154, .8);
            font-size: 14px;
            /* margin-right: 33vw ; */
        }
        .toast-e {
            background: rgba(255, 89, 94, .8);
            font-size: 14px;
            font-size: 2vw;
        }

        /* progress bar */
        .progress {
            background-color: rgba(36, 166, 154, .6)
        }
        .determinate {
            background-color: #24A69A
        }

        input,
        input::placeholder {
            font-size: 13px;
        }

        /* Custom styles for mobile view */
        @media (max-width: 600px) {
            .col.s4,
            .col.s8 {
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            .card {
                margin-bottom: 20px !important;
            }

            input,
            input::placeholder {
                font-size: 11px;
            }

        }

    </style>
</head>
{{-- <body class="grey lighten-5"> --}}
<body style="background-color: #F5F3F5">
    <div class="navbar-fixed">
        <nav class="white">
            <div class="nav-wrapper">
                <div style="margin: 0 5vw 0 5vw">
                    <a href="#!" class="brand-logo">
                        <img src="{{asset('image/logo.png')}}" alt="">
                    </a>
                    <ul class="right hide-on-med-and-down">
                        {{-- <li>
                            <a href="{{route('profile.edit')}}" style="color: black;">Profile</a>
                        </li> --}}
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit" class="btn-small waves-effect waves-light hoverable" style="background-color: #0C3E7A; font-size: 11px;" name="action">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <div style="margin: 5vh 5vw">
        <div>
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        M.toast({html: '{{ session('error') }}', classes: 'toast-e z-depth-5'});
                    });
                </script>
            @endif
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        M.toast({html: '{{ session('success') }}', classes: 'toast-s z-depth-5'});
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
                        <span class="card-title" style="font-size: 18px; margin-left: .5em; margin-bottom: 1.2em;"><strong>QR CODE GENERATOR</strong></span>
                        <div class="divider"></div>
                        <br>
                        {{-- FORM --}}
                        <form id="uploadForm" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" style="text-align: right">
                            @csrf
                            <div class="file-field input-field">
                                <div class="btn hoverable" style="background-color: #0C3E7A">
                                    <span><i class="material-icons">cloud_upload</i></span>
                                    <input type="file" name="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate truncate" type="text" placeholder="Upload Serial Number Data [.xlsx]">
                                </div>
                            </div>
                            <div style="margin-bottom: 1em"></div>

                            <button class="btn waves-effect waves-light hoverable" style="margin-right: .5em; background-color: #0C3E7A" type="submit" name="action">Generate
                                {{-- <i class="material-icons right">wallpaper</i> --}}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- DOWNLOAD RANGE --}}
                <div class="card z-depth-2" style="border-radius: 7px;">
                    <div class="card-content">
                        <span class="card-title" style="font-size: 18px; margin-left: .5em; margin-bottom: 0 !important"><strong>DOWNLOAD BY RANGE</strong></span>
                        <span style="color: #24A69A; font-size: 12px; margin-left: .7em; margin-bottom: 1em;">
                            Maksimum 500 data.
                        </span>

                        <div class="divider"></div>

                        <form action="{{ route('download-pdf-range') }}" method="POST" style="text-align: right">
                            @csrf
                            <div class="row" style="display:flex; align-items: center; margin-top: 1em;">
                                <div class="input-field col s5">
                                    <input class="truncate" id="start_serial" name="start_serial" type="text" placeholder="Start Serial Number" required>
                                </div>
                                <div class="col s2 center">
                                    <span>To</span>
                                </div>
                                <div class="input-field col s5">
                                    <input class="truncate" id="end_serial" name="end_serial" type="text" placeholder="End Serial Number" required>
                                </div>
                            </div>
                            <div style="margin-bottom: 1em"></div>

                            <button type="submit" class="btn waves-effect waves-light hoverable center" style="background-color: #0C3E7A; font-size: 11px; margin-right: .5em;">Download
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
                                        <button id="selectAllRows" class="btn-small waves-effect waves-light hoverable" style="background-color: #0C3E7A; font-size: 11px;">Select All
                                            <i class="material-icons right">select_all</i>
                                        </button>
                                    </div>

                                    <div class="col s6" style="display: flex; justify-content: flex-end; gap: .2em;">
                                        <button id="downloadSelected" class="btn-small waves-effect waves-light hoverable disabled" style="background-color: #0C3E7A; font-size: 11px;">
                                            <i class="material-icons ">cloud_download</i>
                                        </button>

                                        <button id="deleteSelected" class="btn-small waves-effect waves-light hoverable disabled" style="background-color: #FF595E; font-size: 11px;">
                                            <i class="material-icons ">delete</i>
                                        </button>
                                    </div>

                                    {{-- <a href="{{ route('download-pdf') }}" class="waves-effect waves-light btn-small hoverable" style="background-color: #0C3E7A;font-size: 11px;">Download All
                                        <i class="material-icons right">cloud_download</i>
                                    </a> --}}
                                </div>
                        </div>

                        <div class="divider"></div>

                        <section class="section" style="padding-bottom: 1px">
                            {{-- TABLE --}}
                            <div class="row">
                                <div class="col s12 l12">
                                    <table id="qrCodesTable" class="display striped responsive-table nowrap" style="width:100%">
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
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('upload') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('.progress').show();
                        var interval = setInterval(function () {
                            $.getJSON("{{ route('progress') }}", function (data) {
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
                    error: function (response) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    {{-- MATERIALIZE DATATABLE --}}
    <script>
        var $jscomp = $jscomp || {};
        $jscomp.scope = {};
        $jscomp.findInternal = function (a, b, c) {
            a instanceof String && (a = String(a));
            for (var e = a.length, d = 0; d < e; d++) {
                var f = a[d];
                if (b.call(c, f, d, a)) return { i: d, v: f };
            }
            return { i: -1, v: void 0 };
        };
        $jscomp.ASSUME_ES5 = !1;
        $jscomp.ASSUME_NO_NATIVE_MAP = !1;
        $jscomp.ASSUME_NO_NATIVE_SET = !1;
        $jscomp.SIMPLE_FROUND_POLYFILL = !1;
        $jscomp.ISOLATE_POLYFILLS = !1;
        $jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function (a, b, c) {
            if (a == Array.prototype || a == Object.prototype) return a;
            a[b] = c.value;
            return a;
        };
        $jscomp.getGlobal = function (a) {
            a = ["object" == typeof globalThis && globalThis, a, "object" == typeof window && window, "object" == typeof self && self, "object" == typeof global && global];
            for (var b = 0; b < a.length; ++b) {
                var c = a[b];
                if (c && c.Math == Math) return c;
            }
            throw Error("Cannot find global object");
        };
        $jscomp.global = $jscomp.getGlobal(this);
        $jscomp.IS_SYMBOL_NATIVE = "function" === typeof Symbol && "symbol" === typeof Symbol("x");
        $jscomp.TRUST_ES6_POLYFILLS = !$jscomp.ISOLATE_POLYFILLS || $jscomp.IS_SYMBOL_NATIVE;
        $jscomp.polyfills = {};
        $jscomp.propertyToPolyfillSymbol = {};
        $jscomp.POLYFILL_PREFIX = "$jscp$";
        var $jscomp$lookupPolyfilledValue = function (a, b) {
            var c = $jscomp.propertyToPolyfillSymbol[b];
            if (null == c) return a[b];
            c = a[c];
            return void 0 !== c ? c : a[b];
        };
        $jscomp.polyfill = function (a, b, c, e) {
            b && ($jscomp.ISOLATE_POLYFILLS ? $jscomp.polyfillIsolated(a, b, c, e) : $jscomp.polyfillUnisolated(a, b, c, e));
        };
        $jscomp.polyfillUnisolated = function (a, b, c, e) {
            c = $jscomp.global;
            a = a.split(".");
            for (e = 0; e < a.length - 1; e++) {
                var d = a[e];
                if (!(d in c)) return;
                c = c[d];
            }
            a = a[a.length - 1];
            e = c[a];
            b = b(e);
            b != e && null != b && $jscomp.defineProperty(c, a, { configurable: !0, writable: !0, value: b });
        };
        $jscomp.polyfillIsolated = function (a, b, c, e) {
            var d = a.split(".");
            a = 1 === d.length;
            e = d[0];
            e = !a && e in $jscomp.polyfills ? $jscomp.polyfills : $jscomp.global;
            for (var f = 0; f < d.length - 1; f++) {
                var l = d[f];
                if (!(l in e)) return;
                e = e[l];
            }
            d = d[d.length - 1];
            c = $jscomp.IS_SYMBOL_NATIVE && "es6" === c ? e[d] : null;
            b = b(c);
            null != b && (a ? $jscomp.defineProperty($jscomp.polyfills, d, { configurable: !0, writable: !0, value: b }) : b !== c && ($jscomp.propertyToPolyfillSymbol[d] = $jscomp.IS_SYMBOL_NATIVE ? $jscomp.global.Symbol(d) : $jscomp.POLYFILL_PREFIX + d, d = $jscomp.propertyToPolyfillSymbol[d], $jscomp.defineProperty(e, d, { configurable: !0, writable: !0, value: b })));
        };
        $jscomp.polyfill("Array.prototype.find", function (a) {
            return a ? a : function (b, c) {
                return $jscomp.findInternal(this, b, c).v;
            };
        }, "es6", "es3");
        (function (a) {
            "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (b) {
                return a(b, window, document);
            }) : "object" === typeof exports ? module.exports = function (b, c) {
                b || (b = window);
                c && c.fn.dataTable || (c = require("datatables.net")(b, c).$);
                return a(c, b, b.document);
            } : a(jQuery, window, document);
        })(function (a, b, c, e) {
            var d = a.fn.dataTable;
            a.extend(!0, d.defaults, {
                dom: "<'row'<'col s12 m6'l><'col s12 m6'f>><'row'<'col s12'tr>><'row'<'col s12 m12'i><'col s12 m12 center'p>>",
                renderer: "materializecss",
                order: [[1, 'desc']],
                // paging: false,
                // scrollCollapse: true,
                // scrollY: '60vh'
            });
            a.extend(d.ext.classes, {
                sWrapper: "dataTables_wrapper",
                sFilterInput: "",
                sLengthSelect: "",
                sProcessing: "dataTables_processing",
                sPageButton: ""
            });
            d.ext.renderer.pageButton.materializecss = function (f, l, A, B, m, t) {
                var u = new d.Api(f), C = f.oClasses, n = f.oLanguage.oPaginate, D = f.oLanguage.oAria.paginate || {}, h, k, v = 0, y = function (q, w) {
                    var x, E = function (p) {
                        p.preventDefault();
                        a(p.currentTarget).hasClass("disabled") || u.page() == p.data.action || u.page(p.data.action).draw("page");
                    };
                    var r = 0;
                    for (x = w.length; r < x; r++) {
                        var g = w[r];
                        if (Array.isArray(g)) y(q, g); else {
                            k = h = "";
                            switch (g) {
                                case "ellipsis":
                                    h = "&#x2026;";
                                    k = "disabled";
                                    break;
                                case "first":
                                    h = n.sFirst;
                                    k = g + (0 < m ? "" : " disabled");
                                    break;
                                case "previous":
                                    h = n.sPrevious;
                                    k = g + (0 < m ? "" : " disabled");
                                    break;
                                case "next":
                                    h = n.sNext;
                                    k = g + (m < t - 1 ? "" : " disabled");
                                    break;
                                case "last":
                                    h = n.sLast;
                                    k = g + (m < t - 1 ? "" : " disabled");
                                    break;
                                default:
                                    h = g + 1;
                                    k = m === g ? "active" : "";
                            }
                            if (h) {
                                var F = a("<li>", { "class": C.sPageButton + " " + k, id: 0 === A && "string" === typeof g ? f.sTableId + "_" + g : null }).append(a("<a>", { href: "#", "aria-controls": f.sTableId, "aria-label": D[g], "data-dt-idx": v, tabindex: f.iTabIndex, "class": "" }).html(h)).appendTo(q);
                                f.oApi._fnBindAction(F, { action: g }, E);
                                v++;
                            }
                        }
                    }
                };
                try {
                    var z = a(l).find(c.activeElement).data("dt-idx");
                } catch (q) { }
                y(a(l).empty().html('<ul class="pagination"/>').children("ul"), B);
                z !== e && a(l).find("[data-dt-idx=" + z + "]").trigger("focus");
            };
            return d;
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
                order: [[1, 'asc']],
                ajax: '{{ route('qr-codes.data') }}',
                columns: [
                    { data: 'select', name: 'select', orderable: false, searchable: false, className: 'center', },
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'model_number', name: 'model_number' },
                    { data: 'qr_code', name: 'qr_code', orderable: false, searchable: false, className: 'center', width: '15%' },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                var date = new Date(data);
                                return date.toLocaleDateString('en-GB') + ' ' + date.toLocaleTimeString('en-GB');
                            }
                            return data;
                        },
                        className: 'center'
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'center', }
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
                       element.style.cssText = "display: grid; place-items: center; width:fit-content;";
                    });
                }

            });

            $('#qrCodesTable').on('change', 'input[name="selectedQRCodes[]"]', function() {
                updateButtonState();
            });

            $('#selectAllRows').click(function() {
                var rows = table.rows({ 'search': 'applied' }).nodes();
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
                    url: '{{ route('delete-selected') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedQRCodes: selectedQRCodes
                    },
                    success: function(response) {
                        if (response.success) {
                            M.toast({html: response.message, classes: 'toast-s z-depth-5'});
                            window.location.reload();
                        } else {
                            M.toast({html: response.message, classes: 'toast-e z-depth-5'});
                        }
                    },
                    error: function(response) {
                        M.toast({html: 'An error occurred. Please try again.', classes: 'toast-e z-depth-5'});
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

                window.location.href = '{{ route('download-selected-pdf') }}?ids=' + selectedQRCodes.join(',');
            });

            $('select').formSelect();
        });
    </script>
</body>
</html>
