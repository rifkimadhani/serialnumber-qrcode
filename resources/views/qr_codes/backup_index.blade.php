<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
    {{-- <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    {{-- @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    {{-- <h1>QR Codes</h1>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
    <br> --}}

    {{-- <table id="qrCodesTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Select</th>
                <th>Serial Number</th>
                <th>Model Number</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qrCodes as $qrCode)
                <tr>
                    <td><input type="checkbox" name="selectedQRCodes[]" value="{{ $qrCode->id }}"></td>
                    <td>{{ $qrCode->serial_number }}</td>
                    <td>{{ $qrCode->model_number }}</td>
                    <td><img src="{{ asset($qrCode->qr_code) }}" width="100"></td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <div class="container">
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
        <section>
            <h1 style="text-align: center">Serial Number QR Codes Generator</h1>
            {{-- <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" style="text-align: center">
                @csrf
                <input type="file" name="file">
                <button type="submit">Upload</button>
            </form> --}}

            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" style="text-align: center">
                @csrf
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload .xlsx file">
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Generate
                    <i class="material-icons right">cloud_upload</i>
                </button>
            </form>
            <br>
        </section>

        <section class="section">
            <div class="row">
                <div class="col s12 l12">
                    <table id="qrCodesTable" class="highlight responsive-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Serial Number</th>
                                <th>Model Number</th>
                                <th>QR Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($qrCodes as $qrCode)
                                <tr>
                                    <td><input type="checkbox" name="selectedQRCodes[]" value="{{ $qrCode->id }}"></td>
                                    <td>{{ $qrCode->serial_number }}</td>
                                    <td>{{ $qrCode->model_number }}</td>
                                    <td><img src="{{ asset($qrCode->qr_code) }}" width="100"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section center">
            {{-- <button id="downloadSelected" class="btn waves-effect waves-light">Download Selected QR Codes as PDF</button> --}}
            <a href="{{ route('download-pdf') }}" class="waves-effect waves-light btn">Download All QR Codes as PDF
                <i class="material-icons right">cloud_download</i>
            </a>
        </section>
    </div>




    <!-- Include jQuery and DataTables scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script> --}}

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- jquery with datatable -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- Initialize DataTables -->
    <script>
        var $jscomp = $jscomp || {}; $jscomp.scope = {}; $jscomp.findInternal = function (a, b, c) { a instanceof String && (a = String(a)); for (var e = a.length, d = 0; d < e; d++) { var f = a[d]; if (b.call(c, f, d, a)) return { i: d, v: f } } return { i: -1, v: void 0 } }; $jscomp.ASSUME_ES5 = !1; $jscomp.ASSUME_NO_NATIVE_MAP = !1; $jscomp.ASSUME_NO_NATIVE_SET = !1; $jscomp.SIMPLE_FROUND_POLYFILL = !1; $jscomp.ISOLATE_POLYFILLS = !1;
        $jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function (a, b, c) { if (a == Array.prototype || a == Object.prototype) return a; a[b] = c.value; return a }; $jscomp.getGlobal = function (a) { a = ["object" == typeof globalThis && globalThis, a, "object" == typeof window && window, "object" == typeof self && self, "object" == typeof global && global]; for (var b = 0; b < a.length; ++b) { var c = a[b]; if (c && c.Math == Math) return c } throw Error("Cannot find global object"); }; $jscomp.global = $jscomp.getGlobal(this);
        $jscomp.IS_SYMBOL_NATIVE = "function" === typeof Symbol && "symbol" === typeof Symbol("x"); $jscomp.TRUST_ES6_POLYFILLS = !$jscomp.ISOLATE_POLYFILLS || $jscomp.IS_SYMBOL_NATIVE; $jscomp.polyfills = {}; $jscomp.propertyToPolyfillSymbol = {}; $jscomp.POLYFILL_PREFIX = "$jscp$"; var $jscomp$lookupPolyfilledValue = function (a, b) { var c = $jscomp.propertyToPolyfillSymbol[b]; if (null == c) return a[b]; c = a[c]; return void 0 !== c ? c : a[b] };
        $jscomp.polyfill = function (a, b, c, e) { b && ($jscomp.ISOLATE_POLYFILLS ? $jscomp.polyfillIsolated(a, b, c, e) : $jscomp.polyfillUnisolated(a, b, c, e)) }; $jscomp.polyfillUnisolated = function (a, b, c, e) { c = $jscomp.global; a = a.split("."); for (e = 0; e < a.length - 1; e++) { var d = a[e]; if (!(d in c)) return; c = c[d] } a = a[a.length - 1]; e = c[a]; b = b(e); b != e && null != b && $jscomp.defineProperty(c, a, { configurable: !0, writable: !0, value: b }) };
        $jscomp.polyfillIsolated = function (a, b, c, e) {
        var d = a.split("."); a = 1 === d.length; e = d[0]; e = !a && e in $jscomp.polyfills ? $jscomp.polyfills : $jscomp.global; for (var f = 0; f < d.length - 1; f++) { var l = d[f]; if (!(l in e)) return; e = e[l] } d = d[d.length - 1]; c = $jscomp.IS_SYMBOL_NATIVE && "es6" === c ? e[d] : null; b = b(c); null != b && (a ? $jscomp.defineProperty($jscomp.polyfills, d, { configurable: !0, writable: !0, value: b }) : b !== c && ($jscomp.propertyToPolyfillSymbol[d] = $jscomp.IS_SYMBOL_NATIVE ? $jscomp.global.Symbol(d) : $jscomp.POLYFILL_PREFIX + d, d =
                        $jscomp.propertyToPolyfillSymbol[d], $jscomp.defineProperty(e, d, { configurable: !0, writable: !0, value: b })))
        }; $jscomp.polyfill("Array.prototype.find", function (a) { return a ? a : function (b, c) { return $jscomp.findInternal(this, b, c).v } }, "es6", "es3");
        (function (a) { "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (b) { return a(b, window, document) }) : "object" === typeof exports ? module.exports = function (b, c) { b || (b = window); c && c.fn.dataTable || (c = require("datatables.net")(b, c).$); return a(c, b, b.document) } : a(jQuery, window, document) })(function (a, b, c, e) {
        var d = a.fn.dataTable; a.extend(!0, d.defaults, {
            dom: "<'row'<'col s12 m6'l><'col s12 m6'f>><'row'<'col s12'tr>><'row'<'col s12 m12'i><'col s12 m12 center'p>>",
            renderer: "materializecss"
        }); a.extend(d.ext.classes, { sWrapper: "dataTables_wrapper", sFilterInput: "", sLengthSelect: "", sProcessing: "dataTables_processing", sPageButton: "" }); d.ext.renderer.pageButton.materializecss = function (f, l, A, B, m, t) {
            var u = new d.Api(f), C = f.oClasses, n = f.oLanguage.oPaginate, D = f.oLanguage.oAria.paginate || {}, h, k, v = 0, y = function (q, w) {
            var x, E = function (p) {
                p.preventDefault();
                a(p.currentTarget).hasClass("disabled") || u.page() == p.data.action || u.page(p.data.action).draw("page")
            }; var r = 0; for (x = w.length; r < x; r++) {
                var g = w[r]; if (Array.isArray(g)) y(q, g); else {
                k = h = ""; switch (g) { case "ellipsis": h = "&#x2026;"; k = "disabled"; break; case "first": h = n.sFirst; k = g + (0 < m ? "" : " disabled"); break; case "previous": h = n.sPrevious; k = g + (0 < m ? "" : " disabled"); break; case "next": h = n.sNext; k = g + (m < t - 1 ? "" : " disabled"); break; case "last": h = n.sLast; k = g + (m < t - 1 ? "" : " disabled"); break; default: h = g + 1, k = m === g ? "active" : "" }if (h) {
                    var F =
                        a("<li>", { "class": C.sPageButton + " " + k, id: 0 === A && "string" === typeof g ? f.sTableId + "_" + g : null }).append(a("<a>", { href: "#", "aria-controls": f.sTableId, "aria-label": D[g], "data-dt-idx": v, tabindex: f.iTabIndex, "class": "" }).html(h)).appendTo(q); f.oApi._fnBindAction(F, { action: g }, E); v++
                }
                }
            }
            }; try { var z = a(l).find(c.activeElement).data("dt-idx") } catch (q) { } y(a(l).empty().html('<ul class="pagination"/>').children("ul"), B); z !== e && a(l).find("[data-dt-idx=" + z + "]").trigger("focus")
        }; return d
        });


        $(document).ready(function() {
            $('#qrCodesTable').DataTable();

            // Handle download selected QR Codes
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
