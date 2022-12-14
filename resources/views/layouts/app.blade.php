<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Favicon -->
     <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}"/>

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link
       href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
       rel="stylesheet"
     />
 
     <!-- Icons. Uncomment required icon fonts -->
     <script src="{{ asset('js/jquery-3.4.1.js')}}"></script>
     <script src="{{ asset('js/overtime.js')}}"></script>
     <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
 
     <!-- Core CSS -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
     <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
     <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
 
     <!-- Vendors CSS -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
 
     <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
 
     <!-- Page CSS -->
 
     <!-- Helpers -->
     <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>

     <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
     <script src="{{ asset('assets/js/config.js')}}"></script>
   </head>
 

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
        @include('layouts.sidebar-compact')

        <!-- Page Content -->
            <div class="layout-page">
                @include('layouts.header-menu')
                @yield('main-content')
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js')}}"></script>

</html>
