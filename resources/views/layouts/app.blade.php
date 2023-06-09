<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">
    <title>Kashyappathak Dashboard</title>


    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/x-icon" href="/admin_assets/img/images.png">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">




    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->

    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-toggle@3.6.1/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css"
        integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <!-- Main Content -->
            <div id="content">


                <!-- Topbar -->
                @include('layouts.navbar')

                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    </div>



                    <!-- Include DataTables JS -->
                    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                    <!-- Contents section -->
                    @yield('contents')

                    <!-- Additional scripts specific to DataTables -->
                    @stack('scripts')



                    <!-- Content Row -->



                </div>

                <!-- /.container-fluid -->


            </div>

            <!-- End of Main Content -->


            <!-- Footer -->
            @include('layouts.footer')

            <!-- End of Footer -->


        </div>

        <!-- End of Content Wrapper -->


    </div>

    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->

    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->

    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->

    <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-toggle@3.6.1/js/bootstrap-toggle.min.js"></script>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
        integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
