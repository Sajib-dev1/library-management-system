@extends('admin.master')
@section('content')
    <div class="row">
        <style>
            .student_image{
                width: 50px;
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
            }
        </style>
        <div class="col-lg-12">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="m-t-0 header-title">Writter List Table</h4>
                    <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="makeway" data-plugin="custommodal"
                    data-overlaySpeed="100" data-overlayColor="#36404a"> <i class="fa fa-user" aria-hidden="true"></i> Add Writter</a>
                </div>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Profetion</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{-- {{ $users->links('admin.layouts.pagination') }} --}}
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">Modal title</h4>
        <div class="custom-modal-text">
            <form class="form-horizontal" action="{{ route('writter.store') }}" method="POST">
                @csrf

                <div class="form-group m-b-25">
                    <div class="col-12">
                        <label for="emailaddress3">Name</label>
                        <input class="form-control" type="text" name="name" id="nameaddress3" required="" placeholder="enter name">
                    </div>
                </div>

                <div class="form-group m-b-25">
                    <div class="col-12">
                        <label for="emailaddress3">Email address</label>
                        <input class="form-control" type="email" name="email" id="emailaddress3" required="" placeholder="john@deo.com">
                    </div>
                </div>

                <div class="form-group m-b-25">
                    <div class="col-12">
                        <label for="password3">Password</label>
                        <input class="form-control" type="password" name="password" required="" id="password3" placeholder="Enter your password">
                    </div>
                </div>

                <div class="form-group account-btn text-center m-t-10">
                    <div class="col-12">
                        <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Sign In</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('footer_script')
    <script>
        @if(Session::has('delete'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                toastr.error("{{ session('delete') }}");
        @endif
        @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                toastr.success("{{ session('success') }}");
        @endif
    </script>
@endsection