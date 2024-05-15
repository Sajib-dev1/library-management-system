@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Expensess List</h4>
                <a href="#custom-modal" class="btn btn-light waves-effect w-md mr-2 mb-2" data-animation="makeway" data-plugin="custommodal"
                data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new Seat</a>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $serial = ($espensess->currentPage() - 1) * $espensess->perPage() + 1;
                    @endphp
                    @foreach ( $espensess as $espen )
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $espen->created_at->format('m-d-Y') }}</td>
                            <td>{{ $espen->amount }}</td>
                            <td>{{ $espen->name }}</td>
                            <td>
                                <a href="{{ route('expensess.delete',$espen->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $espensess->links('admin.layouts.pagination') }}
            </div>
        </div>
    </div>
</div>

 <!--Add new shift  Modal -->
 <div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new Expensess Seat</h4>
    <div class="custom-modal-text">
        <form class="form-horizontal" action="{{ route('expensess.store') }}" method="POST" id="myshiftform">
            @csrf
            <div class="form-group m-b-25">
                <div class="col-12">
                    <label for="shift">Amount</label>
                    <input class="form-control" type="text" name="amount" id="shift" placeholder="amount">
                </div>
                <div class="col-12">
                    <label for="shift">Name</label>
                    <input class="form-control" type="text" name="name" id="shift" placeholder="name">
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
                amount: {
                    required: true
                },
                name: {
                    required: true
                },
            }
        });
    </script>
@endsection