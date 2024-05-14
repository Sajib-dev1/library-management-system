@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Student profile update</h4>
        
                <form role="form" action="{{ route('student.profile.update') }}" id="myform" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">About Information</label>
                                <textarea name="about_info" class="form-control" id="" cols="30" rows="5" placeholder="Enter your about information">{{ Auth::user()->about_info }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputname">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputname" placeholder="Enter your name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputemail">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" selected disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputpro">Profetion</label>
                                <input type="text" name="profetion" class="form-control" id="exampleInputpro" placeholder="Enter your profetion" value="{{ Auth::user()->profetion }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="exampleInputphone">Phone</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputphone" placeholder="Enter your Phone number" value="{{ Auth::user()->phone }}">
                            @error('photo')
                                <strong class="btn btn-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="webInputphone">webside link</label>
                            <input type="url" name="webside_link" class="form-control" id="webInputphone" placeholder="Enter your webside url" value="{{ Auth::user()->webside_link }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <select name="country" class="form-control contry"  id="Country">
                                <option value="">Select Country</option>
                                @foreach ( $countries as $country )
                                <option value="{{ $country->id }}" {{ Auth::user()->country == $country->id ?'selected':'' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <select name="city" class="form-control city"  id="City">
                                <option value="">Select City</option>
                                @foreach ( $cities as $city )
                                <option value="{{ $city->id }}" {{ Auth::user()->city == $city->id ?'selected':'' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <label for="exampleInputaddress">Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputaddress" placeholder="Enter your phone address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="exampleInputlanguage">Language</label>
                            <input type="text" name="language" class="form-control" id="exampleInputlanguage" placeholder="Enter your language" value="{{ Auth::user()->address }}">
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
        $('.contry').change(function(){
            var country_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/getusercity',
                    data: { 'country_id':country_id },
                    success: function( data ) {
                        $('.city').html(data)
                }
            });
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
    <script>
            $( "#myform" ).validate({
        rules: {
            about_info: {
                required: true
            },
            name: {
                required: true
            },
            profetion: {
                required: true
            },
            phone: {
                required: true
            },
            webside_link: {
                required: true
            },
            country: {
                required: true
            },
            city: {
                required: true
            },
            address: {
                required: true
            },
            language: {
                required: true
            },
        }
    });
    </script>
@endsection