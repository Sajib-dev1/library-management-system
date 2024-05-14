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
                    <h4 class="m-t-0 header-title">Student Dactive List Table</h4>
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
                                <th scope="row">{{ $serial++ }}</th>
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
<!--Add Student -->  

<!-- Modal view -->
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
@endsection