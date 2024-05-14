@extends('layouts.admin')
@section('content')
<style>
    .image-flex{
        position: relative;
    }
    .image-css{
        position: absolute;
        top: 50%;
        right: 25px;
        width: 25px;
        height: 20px;
        transform: translateY(-50%);
    }
</style>
<style>
    .input_submit{
        pointer-events: none;
    }
    .input_submit.active{
        pointer-events: auto;
    }
    .passwird_required{
        display: none;
    }
    .passwird_required ul{
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .passwird_required ul li{
        margin-bottom: 8px;
        color: red;
        font-weight: 700;
    }
    .passwird_required ul li span{
        margin-right: 10px;
    }
    .passwird_required ul li span::before{
        content: '❌';
    }
    .passwird_required ul li.active{
        color: green;
    }
    .passwird_required ul li.active span::before{
        content: '✅';
    }
</style>
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">{{ __('Profile password Update') }}</h4>
                <form action="{{ route('student.password.update') }}" method="POST" id="mypass">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="passwordold">{{ __('old Password') }}</label>
                                <input type="password" class="form-control" name="old_password" id="passwordold" aria-describedby="passwordHelp" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="password_new">{{ __('New password') }}</label>
                            <div class="form-group image-flex">
                                <input type="password" class="form-control" name="password" id="password_new" aria-describedby="passwordHelp" placeholder="Enter new password">
                                <img src="{{ asset('backend/images/eye-slesh.png') }}" onclick="pass()" class="image-css" id="pass-icon" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="passwordcon">{{ __('Confirm password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation" id="passwordcon" aria-describedby="passwordHelp" placeholder="Enter Confirm password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="passwird_required">
                                <ul>
                                    <li class="lowarcase"><span></span>One Lowercase letter</li>
                                    <li class="capital"><span></span>One uppercase letter</li>
                                    <li class="number"><span></span>One number</li>
                                    <li class="special"><span></span>One special character</li>
                                    <li class="eight_charecters"><span></span>At last 8 character</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary active">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
<script>
    @if(Session::has('wrong'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.error("{{ session('wrong') }}");
    @endif

    @if(Session::has('update'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
            toastr.success("{{ session('update') }}");
    @endif
</script>
<script>
    let a ;
    function pass(){
        if(a == 1){
            document.getElementById("password_new").type="password";
            document.getElementById("pass-icon").src="{{ asset('backend/images/eye-slesh.png') }}";
            a=0;
        }
        else{
            document.getElementById("password_new").type="text";
            document.getElementById("pass-icon").src="{{ asset('backend/images/show.png') }}";
            a=1;
        }
    }
</script>
<script>
    $( "#mypass" ).validate({
        rules: {
            old_password: 'required',
            password: 'required',
            password_confirmation: {
                required: true,
                equalTo : "#password_new",
            }
        }
    })
</script>
<script>
    $('#password_new').on('focus',function(){
        $('.passwird_required').slideDown();
    })
    $('#password_new').on('blur',function(){
        $('.passwird_required').slideUp();
    })

    $('#password_new').on('keyup',function(){
        passValue = $(this).val();

        if(passValue.match(/[a-z]/g)){
            $('.lowarcase').addClass('active');
        }
        else{
            $('.lowarcase').removeClass('active');
        }

        if(passValue.match(/[A-Z]/g)){
            $('.capital').addClass('active');
        }
        else{
            $('.capital').removeClass('active');
        }

        if(passValue.match(/[0-9]/g)){
            $('.number').addClass('active');
        }
        else{
            $('.number').removeClass('active');
        }

        if(passValue.match(/[!@#$%^&*]/g)){
            $('.special').addClass('active');
        }
        else{
            $('.special').removeClass('active');
        }

        if(passValue.length == 8 || passValue.length >8){
            $('.eight_charecters').addClass('active');
        }
        else{
            $('.eight_charecters').removeClass('active');
        }

        $('.passwird_required ul li').each(function(index,el){
            if(!$(this).hasClass('active')){
                $('.input_submit').removeClass('active');
            }
            else{
                $('.input_submit').addClass('active');
            }
        })
    })
</script> 
@endsection