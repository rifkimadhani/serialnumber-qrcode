<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"> --}}
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        .navbar-fixed .nav-wrapper .brand-logo img {
            height: 6vh;
        }
        .display img {
            width: 30%;
        }
        nav .brand-logo img {
            /* margin-left: 2vw;
            margin-right: 2vw; */
            padding-bottom: 1vh;
            vertical-align: middle;
        }
        /* 24A69A */
        .dataTables_length label {
            color: #24A69A;
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
        <section>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </section>

        <div class="row">
            <div class="col s4" style="padding-left: 0">

                {{-- <div style="margin-bottom: -5px !important"> --}}
                    {{-- <div class="col s12"> --}}
                        <div class="card z-depth-2" style="border-radius: 7px;">
                            <div class="card-content">
                                <span class="card-title" style="font-size: 18px; margin-left: .5em; margin-bottom: 1.2em;"><strong>QR CODE GENERATOR</strong></span>
                                <div class="divider"></div>
                                <br>
                                {{-- form --}}
                                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" style="text-align: right">
                                    @csrf
                                    <div class="file-field input-field">
                                        <div class="btn hoverable" style="background-color: #0C3E7A">
                                            <span><i class="material-icons">cloud_upload</i></span>
                                            <input type="file" name="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="Upload Serial Number Data [.xlsx]">
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 1em"></div>
                                    {{-- <div class="row" style="padding: 0 12px 0 12px"> --}}

                                        <button class="btn waves-effect waves-light hoverable" style="margin-right: .5em; background-color: #0C3E7A" type="submit" name="action">Generate
                                            {{-- <i class="material-icons right">wallpaper</i> --}}
                                        </button>

                                    {{-- </div> --}}
                                </form>
                            </div>
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}

            </div>

            <div class="col s8" style="padding-right: 0">
                <div class="card z-depth-1" style="border-radius: 7px;">
                    <div class="card-content">
                        <div class="card-title">
                            {{-- <div class="col s8 offset-s4" style="padding-right: .7em"> --}}
                                <div class="row" style="display:flex; justify-content: flex-end; gap: .2em; margin-right: .3em">
                                    <button id="downloadSelected" class="btn-small waves-effect waves-light hoverable disabled" style="background-color: #0C3E7A; font-size: 11px;">Download Selected
                                        <i class="material-icons right">select_all</i>
                                    </button>
                                    <a href="{{ route('download-pdf') }}" class="waves-effect waves-light btn-small hoverable" style="background-color: #0C3E7A;font-size: 11px;">Download All
                                        <i class="material-icons right">cloud_download</i>
                                    </a>
                                </div>
                            {{-- </div> --}}
                        </div>
                        <div class="divider"></div>
                        <section class="section" style="padding-bottom: 1px">
                            {{-- Table --}}
                            <div class="row">
                                <div class="col s12 l12">
                                    <table id="qrCodesTable" class="display highlight responsive-table nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Serial Number</th>
                                                <th>Model Number</th>
                                                <th class="center">QR Code</th>
                                                <th class="center">Date</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($qrCodes as $qrCode)
                                                <tr>
                                                    <td>
                                                        <form action="">
                                                            <label>
                                                                <input type="checkbox" name="selectedQRCodes[]" value="{{ $qrCode->id }}" />
                                                                <span></span>
                                                            </label>
                                                        </form>
                                                    </td>
                                                    <td>{{ $qrCode->serial_number }}</td>
                                                    <td>{{ $qrCode->model_number }}</td>
                                                    <td class="center">
                                                        <img class="materialboxed" src="{{ asset($qrCode->qr_code) }}">
                                                    </td>
                                                    <td class="center">{{ $qrCode->updated_at }}</td>
                                                    <td class="center">
                                                        <form action="{{ route('delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="selectedQRCodes[]" value="{{ $qrCode->id }}">
                                                            <button type="submit" class="waves-effect waves-teal btn-flat" style="color: #FF595E;">
                                                                <i class="material-icons" style="font-size: 20px">delete</i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
    {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script> --}}


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
    </script> --}}

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
        function updateButtonState() {
            var selectedQRCodes = $('input[name="selectedQRCodes[]"]:checked').length;
            if (selectedQRCodes === 0) {
                $('#downloadSelected').addClass('disabled');
            } else {
                $('#downloadSelected').removeClass('disabled');
            }
        }

        $(document).ready(function() {
            $('.materialboxed').materialbox();
            document.querySelectorAll('.material-placeholder').forEach(function(element) {
               element.style.cssText = "display: grid; place-items: center; width:fit-content;";
            });

            // $('#qrCodesTable').DataTable();

            $('#qrCodesTable').DataTable({
                columnDefs: [
                    {width: '15%', targets: 3},
                ],
                dom: "<'row grey lighten-4'<'col s2'l><'col s10'f>><'row'<'col s12'tr>><'row'<'col s12 m12'i><'col s12 m12 center'p>>",
                renderer: "materializecss",
                order: [[2, 'asc']],
                // scrollCollapse: true,
                // scrollY: '40vh',
            });

            // download selcted data
            updateButtonState();

            $('input[name="selectedQRCodes[]"]').change(function() {
                updateButtonState();
            });

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
