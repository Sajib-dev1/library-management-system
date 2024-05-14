@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Admin profile update</h4>
                
                <form role="form" action="{{ route('admin.profile.update') }}" id="myform" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">About Information</label>
                                <textarea name="about_info" class="form-control" id="" cols="30" rows="5" placeholder="Enter your about information">{{ Auth::guard('admin')->user()->about_info }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputname">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputname" placeholder="Enter your name" value="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputemail">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputemail">photo</label>
                                <input type="file" class="form-control" name="photo"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('uploads/admin') }}/{{ Auth::guard('admin')->user()->photo }}" id="blah" width="150" alt="">
                            </div>
                        </div> 
                    </div>
        
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
            $( "#myform" ).validate({
        rules: {
            about_info: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true
            }
        }
    })
    </script>
    <script>
        @if(Session::has('update'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                toastr.success("{{ session('update') }}");
        @endif
    </script>
@endsection