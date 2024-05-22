
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Highdmin - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('backend') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/css/style.css" rel="stylesheet" type="text/css" />

        <script src="{{ asset('backend') }}/js/modernizr.min.js"></script>

    </head>


    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('{{ asset('backen') }}/images/bg-1.jpg');background-size: cover;"></div>
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-6 offset-3">
                        <div class="text-center mt-5">
                            <h1 class="text-error">404</h1>
                            <h4 class="text-uppercase text-danger mt-3">Page Not Found</h4>
                            <p class="text-muted mt-3">It's looking like you may have taken a wrong turn. Don't worry... it
                                happens to the best of us. Here's a
                                little tip that might help you get back on track.</p>

                            <a class="btn btn-md btn-custom waves-effect waves-light mt-3" href="{{ route('index') }}"> Return Home</a>
                        </div>

                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->



        <!-- jQuery  -->
        <script src="{{ asset('backend') }}/js/jquery.min.js"></script>
        <script src="{{ asset('backend') }}/js/popper.min.js"></script>
        <script src="{{ asset('backend') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('backend') }}/js/metisMenu.min.js"></script>
        <script src="{{ asset('backend') }}/js/waves.js"></script>
        <script src="{{ asset('backend') }}/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="{{ asset('backend') }}/js/jquery.core.js"></script>
        <script src="{{ asset('backend') }}/js/jquery.app.js"></script>

    </body>
</html>