@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-12 m-auto">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Assine all Student</h4>
            </div>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Student Photo</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Seat Name</th>
                    <th>Shift</th>
                    <th>Pament Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $serial = ($assign_students->currentPage() - 1) * $assign_students->perPage() + 1;
                    @endphp
                    @foreach ( $assign_students as $assign_student )
                        <tr>
                            <th scope="row">{{ $serial++ }}</th>
                            <td>
                                @if ($assign_student->photo == null)
                                <img src="{{ Avatar::create($assign_student->rel_to_user->name)->toBase64() }}" width="40"/>
                                @else
                                    <img src="{{ asset('uploads/user') }}/{{ $assign_student->rel_to_user->photo }}" width="40" height="40" alt="">
                                @endif
                            </td>
                            <td>{{ $assign_student->rel_to_user->name }}</td>
                            <td>{{ $assign_student->rel_to_user->email }}</td>
                            <td>{{ $assign_student->start_date }}</td>
                            <td>{{ $assign_student->end_date }}</td>
                            <td>{{ $assign_student->rel_to_set->seat_no }}</td>
                            <td>
                                @if ($assign_student->rel_to_set->shift_id == 1)
                                    morning
                                @elseif ($assign_student->rel_to_set->shift_id == 2)
                                    After noon
                                    @else
                                    Full Shift
                                @endif
                            </td>
                            <td>
                                @if ($assign_student->pament_status == 1)
                                Cash
                                @elseif ($assign_student->pament_status == 2)
                                Bank Transfar
                                @elseif ($assign_student->pament_status == 3)
                                Online Banking
                                @else
                                Phone Pay
                                @endif
                            </td>
                            <td>{{ $assign_student->amount }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"data-bs-target="#asignviewModal{{ $assign_student->id }}"> <i class="fa fa-eye" aria-hidden="true"></i> </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $assign_students->links('admin.layouts.pagination') }}
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
  
  <!-- Modal -->
  @foreach ( $assign_students as $assign_student )
    <div class="modal fade" id="asignviewModal{{ $assign_student->id }}" tabindex="-1" aria-labelledby="asignviewModalLabel{{ $assign_student->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="asignviewModalLabel{{ $assign_student->id }}">Student Asign Student List</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table table-borderd">
                <tr>
                    <th>Shift Time </th>
                    <td> {{ $assign_student->start_date }} TO {{ $assign_student->end_date }}</td>
                </tr>
                <tr>
                    <th>Student photo </th>
                    <td>
                        @if ($assign_student->rel_to_user->photo == null)
                        <img src="{{ Avatar::create($assign_student->rel_to_user->name)->toBase64() }}" width="70" />
                        @else
                            <img src="{{ asset('uploads/user') }}/{{ $assign_student->rel_to_user->photo }}" width="150" height="80" alt="">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Student About Information </th>
                    <td> {{ $assign_student->rel_to_user->about_info }}</td>
                </tr>
                <tr>
                    <th>Student Name </th>
                    <td> {{ $assign_student->rel_to_user->name }}</td>
                </tr>
                <tr>
                    <th>Student email </th>
                    <td> {{ $assign_student->rel_to_user->email }}</td>
                </tr>
                <tr>
                    <th>Student Paid Amount </th>
                    <td> {{ $assign_student->paid_amount }}</td>
                </tr>
                <tr>
                    <th>Student Seat No </th>
                    <td> {{ $assign_student->rel_to_set->seat_no }}</td>
                </tr>
                <tr>
                    <th>Student Profetion </th>
                    <td> {{ $assign_student->rel_to_user->profetion }}</td>
                </tr>
                <tr>
                    <th>Student Phone </th>
                    <td> {{ $assign_student->rel_to_user->phone }}</td>
                </tr>
            </table>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-success rounded-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
  @endforeach
@endsection