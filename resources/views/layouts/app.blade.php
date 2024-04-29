<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light" data-menu-styles="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}">
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <!-- //////////////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////////////// -->
    <!-- flatpickr js -->
    <script src="assets/js/core_js/flatpickr.min.js?{{ rand() }}"></script>
    <script src="assets/js/core_js/es.js"></script>
    <link href="assets/js/core_js/flatpickr.css" rel="stylesheet" type="text/css" />
    <!-- Noty -->
    <script src="assets/js/core_js/noty.min.js"></script>
    <link rel="stylesheet" href="//cdn.rawgit.com/needim/noty/77268c46/lib/noty.css">
    <!-- Datatables -->
    <link href="assets/js/core_js/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     
    <link href="assets/js/core_js/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/select.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/select.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive Table css -->
    <link href="assets/js/core_js/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/datatable-fixed.css" rel="stylesheet" type="text/css" />
    <!-- Validate js -->
    <script src="assets/js/core_js/jquery.validate.js?{{ rand() }}"></script>
    <script src="assets/js/core_js/bootstrap-notify.min.js"></script>
    <!-- Cargando en formularios-->
    <script src="assets/js/core_js/waitMe.js"></script>
    <link href="assets/js/core_js/waitMe.css?{{ rand() }}" rel="stylesheet" type="text/css" />
    <link href="assets/js/core_js/core.css?{{ rand() }}" rel="stylesheet" type="text/css" />

</head>
<body class="font-sans antialiased">
    <!-- Header del template -->
    @include('layouts.header')
    <!-- Start::content  -->
    <div class="content">
        <div class="main-content">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3 class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 
                                dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        {{ basename(request()->url()) }}
                    </h3>
                </div>
                <ol class="flex items-center whitespace-nowrap min-w-0">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                      <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate" href="javascript:void(0);">
                        Tables
                        <i class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                      </a>
                    </li>
                    <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 " aria-current="page">
                       DataTable
                    </li>
                </ol>
            </div>
            <!-- Page Header Close -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    <!-- End::content  -->
    {{-- Footer se agregan las librerias necesarias para los casos mas comunes que se requeire en toda la pagina --}}
    @include('layouts.footer')
</body>
</html>
