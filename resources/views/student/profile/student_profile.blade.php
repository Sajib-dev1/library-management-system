@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- meta -->
        <div class="profile-user-box card-box bg-custom">
            <div class="row">
                <div class="col-sm-6">
                    <span class="pull-left mr-3">
                        @if (Auth::user()->photo == null)
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" class="thumb-lg rounded-circle"/>
                        @else
                        <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" alt="" class="thumb-lg rounded-circle">
                            
                        @endif
                    </span>
                    <div class="media-body text-white">
                        <h4 class="mt-1 mb-1 font-18">{{ Auth::user()->name }}</h4>
                        <p class="font-13 text-light"> {{ Auth::user()->profetion }}</p>
                        <p class="text-light mb-0">
                            @if (Auth::user()->country != '')
                            {{ Auth::user()->rel_to_country->name }}
                            @endif
                            ,
                            @if (Auth::user()->city != '')
                            {{ Auth::user()->rel_to_city->name }}
                            @endif 
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-right">
                        <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#photoModal">
                            <i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-4">
        <!-- Personal-Information -->
        <div class="card-box">
            <h4 class="header-title mt-0 m-b-20">Personal Information</h4>
            <div class="panel-body">
                <p class="text-muted font-13">
                    {{ Auth::user()->about_info }}
                </p>

                <hr/>

                <div class="text-left">
                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ Auth::user()->name }}</span></p>

                    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ Auth::user()->phone }}</span></p>

                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ Auth::user()->email }}</span></p>

                    <p class="text-muted font-13"><strong>Languages :</strong>
                        <span class="m-l-5">
                            <span class="flag-icon flag-icon-us m-r-5 m-t-0" title="us"></span>
                            <span>English</span>
                        </span>
                        <span class="m-l-5">
                            <span class="flag-icon flag-icon-de m-r-5" title="de"></span>
                            <span>German</span>
                        </span>
                        <span class="m-l-5">
                            <span class="flag-icon flag-icon-es m-r-5" title="es"></span>
                            <span>Spanish</span>
                        </span>
                        <span class="m-l-5">
                            <span class="flag-icon flag-icon-fr m-r-5" title="fr"></span>
                            <span>French</span>
                        </span>
                    </p>

                </div>

                <ul class="social-links list-inline m-t-20 m-b-0">
                    @foreach ( $sociles->take(5) as $socile )
                        <li class="list-inline-item">
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ $socile->socile_link }}" target="_blank" data-original-title="Facebook"><i class="fa {{ $socile->socile_icon }}"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Personal-Information -->

        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-primary">Messages</div>
            <div class="clearfix"></div>
            <div class="inbox-widget">
                @foreach ( $student_messages as $message )
                    <div class="inbox-item">
                        <div class="inbox-item-img">
                            @if ($message->rel_to_student->photo == null)
                            <img src="{{ Avatar::create($message->rel_to_student->name)->toBase64() }}" class="rounded-circle"/>
                            @else
                            <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" class="rounded-circle" alt="">
                            @endif
                        </div>
                        <p class="inbox-item-author">{{ $message->rel_to_student->name }}</p>
                        <p class="inbox-item-text">{{ $message->message }}</p>
                        <p class="inbox-item-date m-t-10">
                            <button type="button" class="btn btn-icon btn-sm waves-effect waves-light btn-success" data-bs-toggle="modal" data-bs-target="#replayModal{{ $message->rel_to_student->id }}"> Reply </button>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>


    <div class="col-md-8">

        <div class="row">

            <div class="col-sm-4">
                <div class="card-box tilebox-one">
                    <i class="icon-layers float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1,587</h2>
                    <span class="badge badge-custom"> +11% </span> <span class="text-muted">From previous period</span>
                </div>
            </div><!-- end col -->

            <div class="col-sm-4">
                <div class="card-box tilebox-one">
                    <i class="icon-paypal float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                    <h2 class="m-b-20">$<span data-plugin="counterup">46,782</span></h2>
                    <span class="badge badge-danger"> -29% </span> <span class="text-muted">From previous period</span>
                </div>
            </div><!-- end col -->

            <div class="col-sm-4">
                <div class="card-box tilebox-one">
                    <i class="icon-rocket float-right text-muted"></i>
                    <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                    <h2 class="m-b-20" data-plugin="counterup">1,890</h2>
                    <span class="badge badge-custom"> +89% </span> <span class="text-muted">Last year</span>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->


        <div class="card-box">
            <h4 class="header-title mt-0 mb-3">Experience</h4>
            <div class="">
                @foreach ( $student_education->take(2) as $education )
                <div class="">
                    <h5 class="text-custom m-b-5">{{ $education->education }}</h5>
                    <p class="m-b-0">{{ $education->webside_url }}</p>
                    <p><b>{{ $education->course_start }}-{{ $education->course_end }}</b></p>

                    <p class="text-muted font-13 m-b-0">
                        {{ $education->short_desp }}
                    </p>
                </div>
                <hr>
                @endforeach
                

            </div>
        </div>

        <div class="card-box">
            <h4 class="header-title mb-3">My Projects</h4>

            <div class="table-responsive">
                <table class="table m-b-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Stucent Email</th>
                        <th>Start Date</th>
                        <th>Profetion</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ( $students as $sl=>$student ) 
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->created_at->format('d/ m/ Y') }}</td>
                                <td>
                                    @if ($student->profetion == '')
                                        <p style="color: #d2d0d0"><i>Null</i></p>
                                    @else
                                    {{ $student->profetion }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#messageModal{{ $student->id }}">Message</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $students->links('layouts.paginate') }}
                </div>
            </div>
        </div>

    </div>
    <!-- end col -->

</div>
<!-- end row -->

<!-- Button trigger modal -->
  
@foreach ( $student_messages as $sl=>$message )
<style>
    .success-btn{
        width: 150px;
        border-radius: 20px;
    }
</style>
  <!-- Modal -->
  <div class="modal fade" id="replayModal{{ $message->rel_to_student->id }}" tabindex="-1" aria-labelledby="replayModalLabel{{ $message->rel_to_student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="replayModalLabel{{ $message->rel_to_student->id }}">Replay Message</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('student.message.replay',$message->id) }}" method="post" id="myreplay">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="auth_id" value="{{ $message->rel_to_student->id }}">
                    <label for="" class="form-label">Message</label>
                    <textarea name="message" class="form-control" id="" cols="30" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success success-btn">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
  
@foreach ( $students as $sl=>$student )
<style>
    .success-btn{
        width: 150px;
        border-radius: 20px;
    }
</style>
  <!-- Modal -->
  <div class="modal fade" id="messageModal{{ $student->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="messageModalLabel{{ $student->id }}">Send Message</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('student.message') }}" method="post" id="mymessage">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <label for="" class="form-label">Message</label>
                    <textarea name="message" class="form-control" id="" cols="30" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success success-btn">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endforeach

  <!-- Modal -->
  <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="photoModalLabel">Profile photo upload</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('student.photo.update') }}" method="post" enctype="multipart/form-data" id="myphoto">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="" class="form-label">Message</label>
                    <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="mb-3">
                    <img src="" alt="" id="blah" width="150">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success success-btn">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('footer_script')
<script>
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
    $( "#myphoto" ).validate({
        rules: {
            photo: {
                required: true
            },
        }
    });

    $( "#mymessage" ).validate({
        rules: {
            message: {
                required: true
            },
        }
    });

    $( "#myreplay" ).validate({
        rules: {
            message: {
                required: true
            },
        }
    });
</script>
@endsection