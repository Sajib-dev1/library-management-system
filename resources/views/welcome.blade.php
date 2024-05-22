<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #banner{
            height: 100vh;
        }
        .login-form{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-btn .log-btn{
            text-decoration: none;
            background: transparent;
            padding: 10px 30px;
            border-radius: 20px; 
            margin-right: 10px;
            border: 1px solid #fff;
            color: #fff;
        }
        .login-btn .log-btn:last-child{
            margin-right: 0;
        }
        .login-btn .log-btn:hover{
            color: rgba(4, 192, 255, 0.84);
            border: 1px solid rgba(4, 192, 255, 0.84);
        }
        .login-btn .log-btn:hover:active{
            color: #b009f3;
            border: 1px solid #b009f3;
        }
        .login-form p{
            font-size: 18px;
            font-weight: 500;
            font-style: italic;
        }
    </style>
  </head>
  <body>
    <section id="banner" style="background: linear-gradient(rgba(17, 17, 17, 0.7),rgba(17, 17, 17, 0.7)), url({{ asset('uploads/font/library.jpg') }}) no-repeat fixed center/cover;">
        <div class="container">
            <div class="login-form">
                <div class="div">
                  <div class="login-btn">
                    <a href="{{ route('student.login') }}" class="log-btn">Student Login</a>
                    <a href="{{ route('admin.login') }}" class="log-btn">Admin Login</a>
                  </div>
    
                    <p class="text-light mt-4">Don't have an account? <a href="{{ route('student.register') }}">Sign Up</a></p>
                </div>
            </div>
        </div>
    </section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>