<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
          <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

        <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js') }}" defer></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}" defer></script>
    <script src="{{asset('plugins/jszip/jszip.min.js') }}" defer></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js') }}" defer></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js') }}" defer></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}" defer></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js') }}" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js') }}" defer></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    </head>
    <body class="font-sans antialiased font-semibold">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
