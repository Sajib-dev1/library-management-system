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
        

        <style>
            .account-box{
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;

            }
            .card-box{
                width: 600px;
            }
        </style>
    </head>


    <body class="account-pages">

        <div class="account-box">
        
            <div class="card-box p-5">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h2 class="text-uppercase text-center pb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="{{ asset('backend') }}/images/logo.png" alt="" height="26"></span>
                    </a>
                </h2>

                <form action="{{ route('student.store.libery') }}" method="POST">
                    @csrf
                    <div class="form-group m-b-20 row">
                        <div class="col-12">
                            <label for="seckret_key">Seckret Kye</label>
                            <input class="form-control" type="text" name="seckret_key" id="seckret_key" placeholder="Enter your key">
                        </div>
                    </div>

                    <div class="form-group m-b-20 row">
                        <div class="col-12">
                            <label for="student_email">Email address</label>
                            <input class="form-control" type="email" name="email" id="student_email" placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <a href="page-recoverpw.html" class="text-muted pull-right"><small>Forgot your password?</small></a>
                            <label for="student_pass">Password</label>
                            <input class="form-control" type="password" name="password" id="student_pass" placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">

                            <div class="checkbox checkbox-custom">
                                <input id="remember" type="checkbox" checked="">
                                <label for="remember">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row text-center m-t-10">
                        <div class="col-12">
                            <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
                        </div>
                    </div>

                </form>

                <div class="row m-t-50">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted">Already have an account?  <a href="{{ route('student.register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                    </div>
                </div>

                <div class="row m-t-50">
                    <button type="button" data-seckret="999551214" data-email="wacaxaduga@mailinator.com" data-pass="Pa$$w0rd!" class="btn btn-success student-pass">Student Password</button>
                </div>

            </div>
        </div>




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

        <script>
            $('.student-pass').click(function(){
                let seckret_key = $(this).attr('data-seckret');
                $('#seckret_key').attr('value',seckret_key);
            })

            $('.student-pass').click(function(){
                let student_email = $(this).attr('data-email');
                $('#student_email').attr('value',student_email);
            })
            $('.student-pass').click(function(){
                let student_pass = $(this).attr('data-pass');
                $('#student_pass').attr('value',student_pass);
            })
        </script>

    </body>
</html>