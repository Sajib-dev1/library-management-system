@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Manage Seats</h4>
                <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="makeway" data-plugin="custommodal"
                data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new Seat</a>
            </div>

            <div class="row">
                @foreach ( $shifts as $shift )
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderd">
                                    <tr>
                                        <th>SL</th>
                                        <th>Seat No</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach (App\Models\Seat::where('shift_id',$shift->id)->get() as $sl=>$seat )
                                    <tr>   
                                        <td>{{ $sl+1 }}</td>
                                        <td>{{ $seat->seat_no }}</td>
                                        <td>
                                            <a href="{{ route('seat.delete',$seat->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

 <!--Add new shift  Modal -->
 <div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new seat</h4>
    <div class="custom-modal-text">
        <form class="form-horizontal" action="{{ route('seat.store') }}" method="POST" id="myshiftform">
            @csrf

            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">Shift</label>
                    <select name="shift_id" class="form-control" id="">
                        <option value=""> Select Shift</option>
                        @foreach ( $shifts as $shift )
                            <option value="{{ $shift->id }}">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="shift">Seat No</label>
                    <input class="form-control" type="text" name="seat_no" class="" id="shift" placeholder="seat No">
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
        @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                toastr.success("{{ session('success') }}");
        @endif
        @if(Session::has('delete'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                toastr.error("{{ session('delete') }}");
        @endif
    </script>
    <script>
        $( "#myshiftform" ).validate({
            rules: {
                seat_no: {
                    required: true
                },
                shift_id: {
                    required: true
                },
            }
        });
    </script>
@endsection