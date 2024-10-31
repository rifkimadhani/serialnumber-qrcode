<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href=" {{asset('favicons/apple-touch-icon.png')}} ">
    <link rel="icon" type="image/png" sizes="32x32" href=" {{asset('favicons/favicon-32x32.png')}} ">
    <link rel="icon" type="image/png" sizes="16x16" href=" {{asset('favicons/favicon-16x16.png')}} ">
    <link rel="manifest" href=" {{asset('favicons/site.webmanifest')}} ">
    <!-- END Icons -->

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=widgets" />
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Import DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->

    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/14.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.material.css"> -->
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

    div.sticky {
        position: sticky;
        top: 9%;
        background-color: transparent;
        z-index: 1002;
        /* padding: 50px; */
        /* font-size: 20px; */
    }

    /* ***********DATATABLE */
    .dataTables_length label {
        color: #24A69A;
    }

    .dataTables_length input[type=text] {
        height: 1.8em;
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

    .dataTables_filter label {
        color: #24A69A;
    }

    .dataTables_filter input[type=search] {
        height: 1.8em;
    }

    .dataTables_paginate .pagination .active a {
        background-color: #24A69A;
    }

    li .next>a {
        color: #24A69A;
    }

    td,
    th {
        padding: 5px 5px !important;
    }

    .data-uppercase {
        text-transform: uppercase;
    }

    /* Default sorting arrow colors (non-active columns) */
    /* table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
        content: " \25B2";
        font-size: 14px;
        margin-left: 5px;
        color: #ccc;
    } */

    /* Active sorting column - ascending */
    /* table.dataTable thead .sorting_asc:after {
        content: " \25B2";
        color: #26a69a;
    } */

    /* Active sorting column - descending */
    /* table.dataTable thead .sorting_desc:after {
        content: " \25BC";
        color: #26a69a;
    } */

    /* setup scroll table */
    table.dataTable {
        width: 100% !important;
    }

    table.dataTable thead th,
    table.dataTable tbody td {
        box-sizing: border-box;
    }

    /* .dataTables_scrollBody>table.dataTable thead .sorting:after,
    .dataTables_scrollBody>table.dataTable thead .sorting_asc:after,
    .dataTables_scrollBody>table.dataTable thead .sorting_desc:after {
        font-size: 0px;
        clear: both;
    } */

    /* table.data-sn>tbody {
        display: block;
        height: 50vh;
        overflow: auto;
    }

    table.data-sn>thead,
    table.data-sn>tbody table.data-sn>tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    table.data-sn>thead {
        width: 100%;
    }

    table.data-sn {
        width: 100%;
    } */

    /* *******END DATATABLE */

    /* **************SEARCH */
    .search {
        border: 1px solid;
        border-radius: 7px;
    }

    .search:active {
        border: 1px solid blue;
    }

    .input-field.search:focus {
        border-color: #24A69A;
        outline: none;
    }

    /* **********END SEARCH */

    .sort .select-wrapper input.select-dropdown {
        display: flex;
        align-items: center;
        height: 2.1rem;

    }

    /* NOTIFICATION'S TOAST */
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

    /* END NOTIFICATION'S TOAST */

    /* ************PROGRESS BAR */
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

    /* ***END PROGRESS BAR */

    /* *************MODALS */
    .modal {
        max-height: max-content;
        width: 35%;
        border-radius: 15px;
        padding: 0 16px 0 16px;
    }

    /* .modal.open {
        top: 5% !important;
    } */

    .modal .select-wrapper input.select-dropdown {
        padding-top: 8px !important;
    }

    .modal.data-sn .select-wrapper input.select-dropdown {
        padding-top: 0px !important;
    }


    .scroll-indicator {
        position: absolute;
        bottom: 70px;
        /* Adjust depending on modal-footer height */
        left: 50%;
        transform: translateX(-50%);
        color: #26a69a;
        font-size: 32px;
        opacity: 0.7;
        z-index: 2;
        animation: bounce 1.5s infinite;
    }

    /* Arrow down bounce animation */
    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        40% {
            transform: translateX(-50%) translateY(10px);
        }

        60% {
            transform: translateX(-50%) translateY(5px);
        }
    }

    /* ********END MODALS */

    /* ********COLLECTION */
    .collection-item {
        font-size: 10pt;
        padding: 7px 12px !important;
    }

    .collection-item>span.device {

        /* text-wrap: wrap;
        text-align: end;
        margin: 1px; */
        border-radius: 15px;
    }

    span.badge {
        font-size: 10pt;
        min-width: 0 !important;
    }

    span.badge[data-badge-caption] {
        font-size: 8pt;
        margin-left: 5px;
    }

    span.badge.category {
        text-transform: uppercase;
        font-size: 10pt;
        padding-top: .4em;
        color: #26a69a;
        border-color: #757575;
    }

    /* *******END COLLECTION */

    .btn-flat:hover {
        background-color: #eee;
    }

    a.menu-back {
        color: #0C3E7A;
    }

    a.menu-back:hover {
        background-color: none !important;
        /* color: #0C3E7A; */
        color: #24A69A;
    }

    /* MOBILE VIEW */
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

        .card-content .card-title {
            font-size: 16px;
        }

        .collection .collection-item,
        .collection-item .badge {
            font-size: 12px;
        }

        .btn-flat,
        .btn {
            font-size: 12px;
        }

        input,
        input::placeholder {
            font-size: 11px;
        }

        .title-page {
            font-size: small;
        }

    }

    /* FOOTER */
    .page-footer {
        padding-top: 0px;
        background-color: transparent;
    }

    .page-footer .footer-copyright {
        color: #0C3E7A;
        background-color: transparent;
    }

    .visitor {
        color: #0C3E7A;
    }

    .visitor:hover {
        color: #26a69a;
    }
    </style>
</head>

<body style="background-color: #F5F3F5">
    @include('layouts.navbar')

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

    @yield('content')

    <footer class="page-footer">
        <!-- <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                        content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
        <div class="footer-copyright">
            <div style="margin-left: 5vw; width: 90vw;">
                © 2024 Madeira Research
                <!-- <a class="grey-text text-lighten-4 right" href="#!">Total Site Visits: {{ $visitorCount }}</a> -->
                <a class="visitor right" href="#!">Total Site Visits: {{ $visitorCount }}</a>
            </div>
        </div>
    </footer>

    <script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
    });
    </script>
    <!-- {{-- MATERIALIZECSS DATATABLE --}} -->
    <script>
    var $jscomp = $jscomp || {};
    $jscomp.scope = {};
    $jscomp.findInternal = function(a, b, c) {
        a instanceof String && (a = String(a));
        for (var e = a.length, d = 0; d < e; d++) {
            var f = a[d];
            if (b.call(c, f, d, a)) return {
                i: d,
                v: f
            };
        }
        return {
            i: -1,
            v: void 0
        };
    };
    $jscomp.ASSUME_ES5 = !1;
    $jscomp.ASSUME_NO_NATIVE_MAP = !1;
    $jscomp.ASSUME_NO_NATIVE_SET = !1;
    $jscomp.SIMPLE_FROUND_POLYFILL = !1;
    $jscomp.ISOLATE_POLYFILLS = !1;
    $jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object
        .defineProperty : function(a, b, c) {
            if (a == Array.prototype || a == Object.prototype) return a;
            a[b] = c.value;
            return a;
        };
    $jscomp.getGlobal = function(a) {
        a = ["object" == typeof globalThis && globalThis, a, "object" == typeof window && window, "object" ==
            typeof self && self, "object" == typeof global && global
        ];
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
    var $jscomp$lookupPolyfilledValue = function(a, b) {
        var c = $jscomp.propertyToPolyfillSymbol[b];
        if (null == c) return a[b];
        c = a[c];
        return void 0 !== c ? c : a[b];
    };
    $jscomp.polyfill = function(a, b, c, e) {
        b && ($jscomp.ISOLATE_POLYFILLS ? $jscomp.polyfillIsolated(a, b, c, e) : $jscomp.polyfillUnisolated(a,
            b, c,
            e));
    };
    $jscomp.polyfillUnisolated = function(a, b, c, e) {
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
        b != e && null != b && $jscomp.defineProperty(c, a, {
            configurable: !0,
            writable: !0,
            value: b
        });
    };
    $jscomp.polyfillIsolated = function(a, b, c, e) {
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
        null != b && (a ? $jscomp.defineProperty($jscomp.polyfills, d, {
            configurable: !0,
            writable: !0,
            value: b
        }) : b !== c && ($jscomp.propertyToPolyfillSymbol[d] = $jscomp.IS_SYMBOL_NATIVE ? $jscomp.global
            .Symbol(d) : $jscomp.POLYFILL_PREFIX + d, d = $jscomp.propertyToPolyfillSymbol[d], $jscomp
            .defineProperty(e, d, {
                configurable: !0,
                writable: !0,
                value: b
            })));
    };
    $jscomp.polyfill("Array.prototype.find", function(a) {
        return a ? a : function(b, c) {
            return $jscomp.findInternal(this, b, c).v;
        };
    }, "es6", "es3");
    (function(a) {
        "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function(b) {
            return a(b, window, document);
        }) : "object" === typeof exports ? module.exports = function(b, c) {
            b || (b = window);
            c && c.fn.dataTable || (c = require("datatables.net")(b, c).$);
            return a(c, b, b.document);
        } : a(jQuery, window, document);
    })(function(a, b, c, e) {
        var d = a.fn.dataTable;
        a.extend(!0, d.defaults, {
            dom: "<'row'<'col s12 m6'l><'col s12 m6'f>><'row'<'col s12'tr>><'row'<'col s12 m12'i><'col s12 m12 center'p>>",
            renderer: "materializecss",
            order: [
                [0, 'desc']
            ],
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
        d.ext.renderer.pageButton.materializecss = function(f, l, A, B, m, t) {
            var u = new d.Api(f),
                C = f.oClasses,
                n = f.oLanguage.oPaginate,
                D = f.oLanguage.oAria.paginate || {},
                h, k, v = 0,
                y = function(q, w) {
                    var x, E = function(p) {
                        p.preventDefault();
                        a(p.currentTarget).hasClass("disabled") || u.page() == p.data.action || u.page(p
                            .data.action).draw("page");
                    };
                    var r = 0;
                    for (x = w.length; r < x; r++) {
                        var g = w[r];
                        if (Array.isArray(g)) y(q, g);
                        else {
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
                                var F = a("<li>", {
                                    "class": C.sPageButton + " " + k,
                                    id: 0 === A && "string" === typeof g ? f.sTableId + "_" + g : null
                                }).append(a("<a>", {
                                    href: "#",
                                    "aria-controls": f.sTableId,
                                    "aria-label": D[g],
                                    "data-dt-idx": v,
                                    tabindex: f.iTabIndex,
                                    "class": ""
                                }).html(h)).appendTo(q);
                                f.oApi._fnBindAction(F, {
                                    action: g
                                }, E);
                                v++;
                            }
                        }
                    }
                };
            try {
                var z = a(l).find(c.activeElement).data("dt-idx");
            } catch (q) {}
            y(a(l).empty().html('<ul class="pagination"/>').children("ul"), B);
            z !== e && a(l).find("[data-dt-idx=" + z + "]").trigger("focus");
        };
        return d;
    });
    </script>




</body>







</html>