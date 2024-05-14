@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Shift List</h4>
                <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="makeway" data-plugin="custommodal"
                data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Shift</a>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>shift Time</th>
                    <th>amount</th>
                    <th>full day status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ( $shifts as $sl=>$shift )
                        <tr>
                            <th scope="row">{{ $sl+1 }}</th>
                            <td>{{ $shift->shift_start_time }} - {{ $shift->shift_end_time }}</td>
                            <td>{{ $shift->amount }}</td>
                            <td>
                                @if ($shift->full_day_shift == 1)
                                    <p style="color: #0d0c0c"><i>All</i></p>
                                @else
                                <p style="width:15px; height:15px; background:#fcfcfc; border-radius:50%; border:5px solid #37f108;"><i></i></p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $shifts->links('admin.layouts.pagination') }}
            </div>
        </div>
    </div>
</div>

 <!--Add new shift  Modal -->
 <div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update shift</h4>
    <div class="custom-modal-text">
        <form class="form-horizontal" action="{{ route('shift.store') }}" method="POST" id="myshiftform">
            @csrf

            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">Select shift time</label>
                    <select name="type_shift" class="form-control" id="">
                        <option value="">Select Shift</option>
                        @foreach ( $sift_info as $sift )
                            <option value="{{ $sift->id }}">{{ $sift->shift_start_time  }} To {{ $sift->shift_end_time }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">shift start time</label>
                    <input class="form-control" type="text" name="shift_start_time" id="shift" placeholder="08:00 am">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">shift end time</label>
                    <input class="form-control" type="text" name="shift_end_time" id="shift" placeholder="02:00 am">
                </div>
            </div>
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="amount">Amount</label>
                    <input class="form-control" type="number" name="amount" id="amount" placeholder="$0.00">
                </div>
            </div>
            <div class="form-group m-b-20">
                <div class="col-12">
                    <label for="">is full day shift?</label>
                    <div class="checkbox checkbox-custom">
                        <input id="checkbox15" type="checkbox" name="full_day_shift" value="1">
                        <label for="checkbox15">
                            yes
                        </label>
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
                shift_start_time: {
                    required: true
                },
                shift_end_time: {
                    required: true
                },
                amount: {
                    required: true
                }
            }
        });
    </script>
@endsection