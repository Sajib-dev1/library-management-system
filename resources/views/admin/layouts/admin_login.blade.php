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
                <h2 class="text-uppercase text-center pb-4">
                    <a href="index.html" class="text-success">
                        <span><img src="assets/images/logo.png" alt="" height="26"></span>
                    </a>
                </h2>

                <form class="" action="{{ route('admin.logged') }}" method="POST">
                    @csrf
                    <div class="form-group m-b-20 row">
                        <div class="col-12">
                            <label for="">Email address</label>
                            <input class="form-control" name="email" type="email" id="admin-email" required="" placeholder="Enter your email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            @if (session('wrong'))
                                <strong class="text-danger">{{ session('wrong') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label for="data-pass">Password</label>
                            <input class="form-control" type="password" name="password" required="" id="admin_passeord_sin" placeholder="Enter your password">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            @if (session('pass_wrong'))
                                <strong class="text-danger">{{ session('pass_wrong') }}</strong>
                            @endif
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
                       <button type="button" data-email="admin@gmail.com" data-pass="Pa$$w0rd!" class="btn btn-success admin_pass">Addmin Password</button>
                    </div>
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
            $('.admin_pass').click(function(){
                let admin_email = $(this).attr('data-email');
                $('#admin-email').attr('value',admin_email);
            });

            $('.admin_pass').click(function(){
                let admin_password = $(this).attr('data-pass');
                $('#admin_passeord_sin').attr('value',admin_password);
            })
        </script>
    </body>
</html>