<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.3.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Trang Biểu đồ</title>
    {{-- <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="./dist/libs/jsvectormap/dist/jsvectormap.css?1750026893" rel="stylesheet" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES --> --}}
    <link href="{{ asset('assets/admin/dist/css/tabler.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/global/upload-preview/upload-preview.css') }}">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PLUGINS STYLES -->
    @stack('styles')

    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('assets/admin/dist/js/tabler-theme.min.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->
    <div class="page">
        <!--  BEGIN SIDEBAR  -->
        @include('admin.layouts.sidebar')
        <!--  END SIDEBAR  -->
        <div class="page-wrapper">
            <!-- BEGIN PAGE HEADER -->

            <!-- END PAGE HEADER -->
            <!-- BEGIN PAGE BODY -->
            @yield('contents')
            <!-- END PAGE BODY -->
            <!--  BEGIN FOOTER  -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">

                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; {{ date('Y') }}
                                    <a href="#" class="link-secondary">Hoàng</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-secondary">v1.0.0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!--  END FOOTER  -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/global/upload-preview/upload-preview.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('assets/admin/dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/tinymce/tinymce.min.js') }}"></script>
    @include('admin.layouts.scripts')

</body>

</html>
