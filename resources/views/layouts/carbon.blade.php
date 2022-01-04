<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Carbon') }}</title>
    <meta name="author" content="Behzad Dadashpour">
    <meta name="description" content="Carbon">
    <meta name="keyword" content="Carbon">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.all.min.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css">--}}
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris-0.4.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.Bootstrap-PersianDateTimePicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
    <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body class="fixed-left">
<div id="wrapper">
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')
    <div class="content-page  equal-height">
        <div class="content">
            <div class="container">
                @yield('content')
            </div><!--content-->
        </div><!--content page-->
    </div><!--end wrapper-->
</div>
@include('layouts.partials.footer')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/metisMenu.js') }}"></script>
<script src="{{ asset('js/core.js') }}"></script>
<script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/mediaquery.js') }}"></script>
<script src="{{ asset('js/equalize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('js/demo-datatable.js') }}"></script>
<script src="{{ asset('js/parsley/parsley.js') }}"></script>
<script src="{{ asset('js/parsley/i18n/fa.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/run_prettify.js') }}"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ mix('js/carbon.js') }}" defer></script>
<script src="{{ asset('js/jalaali.js') }}" defer></script>
<script src="{{ asset('js/jquery.Bootstrap-PersianDateTimePicker.js') }}" defer></script>
<script src="{{ asset('js/main.js') }}"></script>


<script>
    let dataTableOptions = {
        'pageLength': 100,
        @if(app()->getLocale() == "fa")
        "language": {
            'url': "/js/datatables/languages/Persian.json"
        },
        @endif
        "columnDefs": [
            {
                "targets": "no-sort",
                "orderable": false
            }
        ]
    };
    $(function(){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(session()->has('success'))
            toastr["success"]("{{ session()->get('success') }}");
        @endif
            @if(session()->has('warning'))
            toastr["warning"]("{{ session()->get('warning') }}");
        @endif
            @if(session()->has('info'))
            toastr["info"]("{{ session()->get('info') }}");
        @endif
            @if(session()->has('error'))
            toastr["error"]("{{ session()->get('error') }}");
        @endif
        $(".table-change-activation").on("click", function(e){
            e.preventDefault();
            let $this = $(this);
        });
    });

</script>


@stack('libraries')
@stack('scripts')

{{--<script>
    $('.data-table').DataTable(dataTableOptions);
</script>--}}
</body>
</html>
