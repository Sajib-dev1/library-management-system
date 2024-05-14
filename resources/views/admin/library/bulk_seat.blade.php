@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Manage Seats</h4>
                <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="makeway" data-plugin="custommodal"
                data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new Seat</a>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Shift</th>
                    <th>Seat Letter</th>
                    <th>Form</th>
                    <th>To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $serial = ($bulk_seats->currentPage() - 1) * $bulk_seats->perPage() + 1;
                    @endphp
                    @foreach ( $bulk_seats as $bulk_seat )
                        <tr>
                            <th scope="row">{{ $serial++ }}</th>
                            <td><span class="badge bg-dark">{{ $bulk_seat->rel_to_shift->shift_start_time }} to {{ $bulk_seat->rel_to_shift->shift_end_time }}</span></td>
                            <td>{{ $bulk_seat->seat_letter }}</td>
                            <td>{{ $bulk_seat->form }}</td>
                            <td>{{ $bulk_seat->to }}</td>
                            <td>{{ $bulk_seat->created_at->toDayDateTimeString() }}</td>
                            <td>
                                <a href="{{ route('bulk.seat.delete',$bulk_seat->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $bulk_seats->links('admin.layouts.pagination') }}
            </div>
        </div>
    </div>
</div>

 <!--Add new shift  Modal -->
 <div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new Bulk Seat</h4>
    <div class="custom-modal-text">
        <form class="form-horizontal" action="{{ route('seat.bulk.store') }}" method="POST" id="myshiftform">
            @csrf

            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">Seat Letter</label>
                    <select name="shift_id" class="form-control" id="">
                        <option value="">Select Shift</option>
                        @foreach ( $shifts as $shift )
                            <option value="{{ $shift->id }}">{{ $shift->shift_start_time }} to {{ $shift->shift_end_time }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">Seat Letter</label>
                    <input class="form-control" type="text" name="seat_letter" id="shift" placeholder="seat No">
                </div>
            </div>

            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="form">Form</label>
                    <input class="form-control" type="text" name="form" id="form" placeholder="seat No">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="to">To</label>
                    <input class="form-control" type="text" name="to" id="to" placeholder="seat No">
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
                seat_letter: {
                    required: true
                },
                form: {
                    required: true
                },
                to: {
                    required: true
                },
            }
        });
    </script>
@endsection