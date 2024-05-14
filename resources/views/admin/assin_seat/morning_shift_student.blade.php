@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Morning Shift Student</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderd">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Shift Start Time</th>
                            <th>Shift End Time</th>
                            <th>Atendace</th>
                        </tr>
                        @foreach ( $morning_shifts as $sl=>$morning_shift )  
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>{{ $morning_shift->rel_to_user->name }}</td>
                                <td>{{ $morning_shift->rel_to_user->email }}</td>
                                <td>{{ $morning_shift->start_date }}</td>
                                <td>{{ $morning_shift->end_date }}</td>
                                <td>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" {{ $morning_shift->status == 1?'checked':'' }} data-toggle="toggle" data-id="{{ $morning_shift->id }}" student_id="{{ $morning_shift->rel_to_user->id }}" class="status" value="{{ $morning_shift->status }}">
                                    </label>                                      
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
<script>
    $('.status').change(function(){
        var assin_id = $(this).attr('data-id');
        var student_id = $(this).attr('student_id');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "POST",
            url: '/getassinstatus',
            data: { 'assin_id':assin_id,'student_id':student_id },
            success: function( data ) {
                // alert(data);
            }
        });
    })
</script>
@endsection