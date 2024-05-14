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
                <h4 class="m-t-0 header-title">Student List Table</h4>
                <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="door" data-plugin="custommodal"
                data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-user" aria-hidden="true"></i> Add new Student</a>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $serial = ($users->currentPage() - 1) * $users->perPage() + 1;
                    @endphp
                    @foreach ( $users as $user )
                        <tr>
                            <th scope="row">{{ $serial++}}</th>
                            <td>
                                @if ($user->photo == null)
                                <img src="{{ Avatar::create($user->name)->toBase64() }}" width="50"/>
                                @else
                                    <img src="{{ asset('uploads/user') }}/{{ $user->photo }}" class="student_image" alt="">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->profetion == null)
                                    <p style="color: #d0d0d0"><i>Null</i></p>
                                @else
                                {{ $user->profetion }}
                                @endif
                            </td>
                            <td>
                                @if ($user->phone == null)
                                    <p style="color: #d0d0d0"><i>Null</i></p>
                                @else
                                {{ $user->phone }}
                                @endif
                            </td>
                            <td>
                                @if ($user->country == null)
                                    <p style="color: #d0d0d0"><i>Null</i></p>
                                @else
                                {{ $user->rel_to_country->name }}
                                @endif
                            </td>
                            <td>
                                @if ($user->city == null)
                                    <p style="color: #d0d0d0"><i>Null</i></p>
                                @else
                                {{ $user->rel_to_city->name }}
                                @endif
                            </td>
                            <td class="toogle_btn text-center">
                                <button class="btn btn-{{ $user->status == 1?'success':'danger' }} status" value="{{ $user->status }}" data-id="{{ $user->id }}">{{ $user->status == 1?'ON':'OFF' }}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentModal{{ $user->id }}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#studenteditModal{{ $user->id }}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('admin.student.delete',$user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->links('admin.layouts.pagination') }}
            </div>
        </div>
    </div>

</div>

   <!--Add new student  Modal -->
 <div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new student</h4>
    <div class="custom-modal-text">
        <form class="form-horizontal" action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data" id="myform">
            @csrf
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="phone">Phone</label>
                    <input class="form-control" type="cel" name="phone" id="phone" placeholder="Enter your phone">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="phone">Whats App Number</label>
                    <input class="form-control" type="cel" name="whatsapp" id="phone" placeholder="Enter your whats app phone">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="text" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Enter your address">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="" class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="" class="form-label">Active Status</label>
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="activeRadio" value="1" name="status">
                            <label class="form-check-label" for="activeRadio">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="deactiveRadio" value="0" name="status">
                            <label class="form-check-label" for="deactiveRadio">Deactive</label>
                        </div>
                    </div>
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
  <!-- Edit Student Modal -->
  @foreach ( $users as $sl=>$user )
    <div class="modal fade" id="studenteditModal{{ $user->id }}" tabindex="-1" aria-labelledby="studenteditModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="studenteditModalLabel{{ $user->id }}"><i class="fa fa-user" aria-hidden="true"></i> Add New Student</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.student.update',$user->id) }}" method="post" enctype="multipart/form-data" id="myeditform">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="cel" name="phone" class="form-control" id="phone" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">WhatsApp Number</label>
                                <input type="tel" name="whatsapp" class="form-control" value="{{ $user->whatsapp }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="" class="form-label">Active Status</label>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{ $user->status == 1?'checked':'' }} type="radio" id="activeRadio" value="1" name="status">
                                    <label class="form-check-label" for="activeRadio">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" {{ $user->status == 0?'checked':'' }} id="deactiveRadio" value="0" name="status">
                                    <label class="form-check-label" for="deactiveRadio">Deactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success rounded-4">Add Student</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  @endforeach

<!-- Modal -->
@foreach ( $users as $user )
<div class="modal fade" id="studentModal{{ $user->id }}" tabindex="-1" aria-labelledby="studentModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="studentModalLabel{{ $user->id }}">Student Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-borderd">
            <tr>
                <th>Join Date</th>
                <td>{{ $user->created_at->format('d-M-Y') }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    @if ($user->photo == null)
                    <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                    @else
                        <img src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="" width="150">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>About Information</th>
                <td>
                    @if ($user->about_info == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->about_info }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Profetion</th>
                <td>
                    @if ($user->profetion == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->profetion }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>
                    @if ($user->phone == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->phone }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Country</th>
                <td>
                    @if ($user->country == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->rel_to_country->country }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>City</th>
                <td>
                    @if ($user->city == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->rel_to_city->city }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Address</th>
                <td>
                    @if ($user->address == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->address }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Language</th>
                <td>
                    @if ($user->language == null)
                        <p style="color: #cccaca"><i>Null</i></p>
                    @else
                    {{ $user->language }}
                    @endif
                </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" style="width: 120px; border-radius: 20px;">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
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
        $('.contry').change(function(){
            var country_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/getstudentcity',
                    data: { 'country_id':country_id },
                    success: function( data ) {
                        $('.city').html(data)
                        // alert($data);
                }
            });
        })
    </script>
    <script>
        $('.status').click(function(){
            if($(this).val() != 1){
            $(this).attr('value',1);
        }
        else{
            $(this).attr('value',0);
        }
        var stu_id = $(this).attr('data-id');
        var status = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "POST",
            url: '/getstudentstatus',
            data: { 'id':stu_id,'status':status },
            success: function( data ) {
            }
        });
        })
    </script>
    <script>
        $( "#myform" ).validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true
                },
                phone: {
                    required: true
                },
                whatsapp: {
                    required: true
                },
                address: {
                    required: true
                },
                password: {
                    required: true
                },
                photo: {
                    required: true
                },
                status: {
                    required: true
                },
            }
        });
    </script>
@endsection