@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-box" style="background: none;">
            <h4 class="header-title m-t-0 m-b-30">Tabs Justified</h4>
    
            <ul class="nav nav-pills navtab-bg nav-justified pull-in " style="background: #fff">
                <li class="nav-item">
                    <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="fi-monitor mr-2"></i> 08:00 am to 02:00 pm
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                        <i class="fi-head mr-2"></i>02:00 pm to 08:00 pm
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <i class="fi-mail mr-2"></i> 08:00 am to 08:00 pm
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="home1">
                    <div class="row">  
                    @foreach ($mornung_seat as $mornung )
                        @if ($mornung->seat_book == 1)
                            <div class="col-lg-3">
                                <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-danger">Seat Booking</div>
                                    <div class="d-flex justify-content-between align-items-center mt-5">
                                        <div class="img">
                                            @if ($mornung->rel_to_user->photo == null)
                                            <img src="{{ Avatar::create($mornung->rel_to_user->name)->toBase64() }}" width="80"/>
                                            @else
                                                <img src="{{ asset('uploads/user') }}/{{ $mornung->rel_to_user->photo }}" style="border-radius: 50%" width="80" height="80" alt="">
                                            @endif
                                        </div>
                                        <div class="div">
                                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> Shift: {{ $mornung->rel_to_shift->shift_start_time }} To {{ $mornung->rel_to_shift->shift_end_time }}</p>
                                            <p><i class="fa fa-user" aria-hidden="true"></i> Name : <strong>{{ $mornung->rel_to_user->name }}</strong></p>
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i> Start Date: {{ $mornung->rel_to_asign->start_date }}</p>
                                            <p><i class="fa fa-calendar" aria-hidden="true"></i> End Date: {{ $mornung->rel_to_asign->end_date }}</p>
                                            <h5><i class="fa fa-stop-circle-o" aria-hidden="true"></i> Seat No : <strong>{{ $mornung->seat_no }}</strong></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3">
                                <div class="card-box ribbon-box">
                                    <div class="ribbon ribbon-success">Book now</div>
                                    <h5 class="mt-5">Avalable for Booking</h5>
                                    <p class="m-b-0">Seat No : {{ $mornung->seat_no }}</p>
                                    <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $mornung->id }}"> <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> <span>Book now</span> </button>
                                </div>
                            </div>
                        @endif
                        
                    @endforeach

                        
                    </div>
                    <!-- end row -->
                </div>
                <div class="tab-pane show active" id="profile1">
                    <div class="row">  
                        @foreach ($after_noon_seat as $after_noon )
                            @if ($after_noon->seat_book == 1)
                                <div class="col-lg-3">
                                    <div class="card-box ribbon-box">
                                        <div class="ribbon ribbon-danger">Seat Booking</div>
                                        <div class="d-flex justify-content-between align-items-center mt-5">
                                            <div class="img">
                                                @if ($after_noon->rel_to_user->photo == null)
                                                <img src="{{ Avatar::create($after_noon->rel_to_user->name)->toBase64() }}" width="80"/>
                                                @else
                                                    <img src="{{ asset('uploads/user') }}/{{ $after_noon->rel_to_user->photo }}"  style="border-radius: 50%" width="80" height="80" alt="">
                                                @endif
                                            </div>
                                            <div class="div">
                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> Shift: {{ $after_noon->rel_to_shift->shift_start_time }} To {{ $after_noon->rel_to_shift->shift_end_time }}</p>
                                                <p><i class="fa fa-user" aria-hidden="true"></i> Name : <strong>{{ $after_noon->rel_to_user->name }}</strong></p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> Start Date: {{ $after_noon->rel_to_asign->start_date }}</p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> End Date: {{ $after_noon->rel_to_asign->end_date }}</p>
                                                <h5><i class="fa fa-stop-circle-o" aria-hidden="true"></i> Seat No : <strong>{{ $after_noon->seat_no }}</strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-3">
                                    <div class="card-box ribbon-box">
                                        <div class="ribbon ribbon-success">Book now</div>
                                        <h5 class="mt-5">Avalable for Booking</h5>
                                        <p class="m-b-0">Seat No : {{ $after_noon->seat_no }}</p>
                                        <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $after_noon->id }}"> <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> <span>Book now</span> </button>
                                    </div>
                                </div>
                            @endif
                            
                        @endforeach    
                    </div>
                </div>
                <div class="tab-pane" id="messages1">
                    <div class="row">  
                        @foreach ($full_shift_seat as $full_shift )
                            @if ($full_shift->seat_book == 1)
                                <div class="col-lg-3">
                                    <div class="card-box ribbon-box">
                                        <div class="ribbon ribbon-danger">Seat Booking</div>
                                        <div class="d-flex justify-content-between align-items-center mt-5">
                                            <div class="img">
                                                @if ($full_shift->rel_to_user->photo == null)
                                                <img src="{{ Avatar::create($full_shift->rel_to_user->name)->toBase64() }}" width="80"/>
                                                @else
                                                    <img src="{{ asset('uploads/user') }}/{{ $full_shift->rel_to_user->photo }}"  style="border-radius: 50%" width="80" height="80" alt="">
                                                @endif
                                            </div>
                                            <div class="div">
                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> Shift: {{ $full_shift->rel_to_shift->shift_start_time }} To {{ $full_shift->rel_to_shift->shift_end_time }}</p>
                                                <p><i class="fa fa-user" aria-hidden="true"></i> Name : <strong>{{ $full_shift->rel_to_user->name }}</strong></p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> Start Date: {{ $full_shift->rel_to_asign->start_date }}</p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> End Date: {{ $full_shift->rel_to_asign->end_date }}</p>
                                                <h5><i class="fa fa-stop-circle-o" aria-hidden="true"></i> Seat No : <strong>{{ $full_shift->seat_no }}</strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-3">
                                    <div class="card-box ribbon-box">
                                        <div class="ribbon ribbon-success">Book now</div>
                                        <h5 class="mt-5">Avalable for Booking</h5>
                                        <p class="m-b-0">Seat No : {{ $full_shift->seat_no }}</p>
                                        <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $full_shift->id }}"> <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> <span>Book now</span> </button>
                                    </div>
                                </div>
                            @endif
                            
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

  
  <!-- Add Book Morning now -->
  @foreach ( $mornung_seat as $mornung )
    <div class="modal fade" id="staticBackdrop{{ $mornung->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $mornung->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $mornung->id }}">Asign New Seat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('asign.seat.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Seat No.</h5>
                    <h3 class="text-center">{{ $mornung->seat_no }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Student Name</label>
                                <select name="student_id" class="form-control" id="">
                                    <option value="">Select Name</option>
                                    @foreach ( $students as $student )
                                        <option value="{{ $student->id }}">{{ $student->name }} || {{ $student->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join Start Date</label>
                                <input type="date"name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join End Date</label>
                                <input type="date"name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Active Status</label>
                            @foreach ( $shifts as $shift )
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input hello_check" type="radio" id="activeRadio" data-amount="{{ $shift->amount }}" value="{{ $shift->id }}" name="shift_id">
                                        <label class="form-check-label" for="activeRadio">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Amount : </label>
                                <span>&#2547; </span><span class="amount_sh"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Prament Status</label>
                                <select name="pament_status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="1">PAID</option>
                                    <option value="2">DUE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Payment mode</label>
                            <select name="pament_mode" class="form-control" id="">
                                <option value="">Select payment</option>
                                <option value="1">Cash</option>
                                <option value="2">Bank transfar</option>
                                <option value="3">Online banking</option>
                                <option value="4">Phone pay</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Paid amount (Tk)</label>
                                <input type="number" name="paid_amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                                <label for="" class="form-label">Discount (Tk)</label>
                                <input type="number" name="discount" class="form-control">
                                <input type="hidden" name="seat_id" value="{{ $mornung->id }}">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="width: 150px; border-radius: 20px; margin:0 auto"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> ASSINE SEAT</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  @endforeach
  
  <!-- Add Book after noon now -->
  @foreach ( $after_noon_seat as $after_noon )
    <div class="modal fade" id="staticBackdrop{{ $after_noon->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $after_noon->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $after_noon->id }}">Asign New Seat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('asign.seat.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Seat No.</h5>
                    <h3 class="text-center">{{ $after_noon->seat_no }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Student Name</label>
                                <select name="student_id" class="form-control" id="">
                                    <option value="">Select Name</option>
                                    @foreach ( $students as $student )
                                        <option value="{{ $student->id }}">{{ $student->name }} || {{ $student->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join Start Date</label>
                                <input type="date"name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join End Date</label>
                                <input type="date"name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Active Status</label>
                            @foreach ( $shifts as $shift )
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input hello_check" type="radio" id="activeRadio" data-amount="{{ $shift->amount }}" value="{{ $shift->id }}" name="shift_id">
                                        <label class="form-check-label" for="activeRadio">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Amount : </label>
                                <span>&#2547; </span><span class="amount_sh"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Prament Status</label>
                                <select name="pament_status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="1">PAID</option>
                                    <option value="2">DUE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Payment mode</label>
                            <select name="pament_mode" class="form-control" id="">
                                <option value="">Select payment</option>
                                <option value="1">Cash</option>
                                <option value="2">Bank transfar</option>
                                <option value="3">Online banking</option>
                                <option value="4">Phone pay</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Paid amount (Tk)</label>
                                <input type="number" name="paid_amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                                <label for="" class="form-label">Discount (Tk)</label>
                                <input type="number" name="discount" class="form-control">
                                <input type="hidden" name="seat_id" value="{{ $after_noon->id }}">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="width: 150px; border-radius: 20px; margin:0 auto"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> ASSINE SEAT</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  @endforeach
  
  <!-- Add Book Full shift now -->
  @foreach ( $full_shift_seat as $full_shift )
    <div class="modal fade" id="staticBackdrop{{ $full_shift->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $full_shift->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $full_shift->id }}">Asign New Seat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('asign.seat.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Seat No.</h5>
                    <h3 class="text-center">{{ $full_shift->seat_no }}</h3>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Student Name</label>
                                <select name="student_id" class="form-control" id="">
                                    <option value="">Select Name</option>
                                    @foreach ( $students as $student )
                                        <option value="{{ $student->id }}">{{ $student->name }} || {{ $student->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join Start Date</label>
                                <input type="date"name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Join End Date</label>
                                <input type="date"name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Active Status</label>
                            @foreach ( $shifts as $shift )
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input hello_check" type="radio" id="activeRadio" data-amount="{{ $shift->amount }}" value="{{ $shift->id }}" name="shift_id">
                                        <label class="form-check-label" for="activeRadio">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Amount : </label>
                                <span>&#2547; </span><span class="amount_sh"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Prament Status</label>
                                <select name="pament_status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="1">PAID</option>
                                    <option value="2">DUE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Payment mode</label>
                            <select name="pament_mode" class="form-control" id="">
                                <option value="">Select payment</option>
                                <option value="1">Cash</option>
                                <option value="2">Bank transfar</option>
                                <option value="3">Online banking</option>
                                <option value="4">Phone pay</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Paid amount (Tk)</label>
                                <input type="number" name="paid_amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="mb-3">
                                <label for="" class="form-label">Discount (Tk)</label>
                                <input type="number" name="discount" class="form-control">
                                <input type="hidden" name="seat_id" value="{{ $full_shift->id }}">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="width: 150px; border-radius: 20px; margin:0 auto"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> ASSINE SEAT</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  @endforeach







@endsection
@section('footer_script')
    <script>
        $('.hello_check').click(function(){
            let shift_amount = $(this).attr('data-amount');

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/getshiftamount',
                    data: { 'amount':shift_amount },
                    success: function( data ) {
                        $('.amount_sh').html(data)
                }
            });

            // alert(shift_amount);
        })
    </script>

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
@endsection