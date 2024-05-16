@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Expensess All List</h4>
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
                        $serial = ($expenses_listes->currentPage() - 1) * $expenses_listes->perPage() + 1;
                    @endphp
                    @foreach ( $expenses_listes as $sl=>$expenses_liste )
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $expenses_liste->created_at->format('m-d-Y') }}</td>
                            <td>{{ $expenses_liste->amount }}</td>
                            <td>{{ $expenses_liste->name }}</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $expenses_listes->links('admin.layouts.pagination') }}
            </div>
           <tr>
            <td>
                <div class="d-flex justify-content-between pe-5">
                    <h4 class="header-title">Total amount:</h4>
                    <h4 class="header-title">&#2547; {{ $total_amount }}</h4>
                </div>
            </td>
           </tr>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
            
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="m-t-0 header-title">Income All List</h4>
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
                        $serial = ($expenses_listes->currentPage() - 1) * $expenses_listes->perPage() + 1;
                    @endphp
                    @foreach ( $expenses_listes as $sl=>$expenses_liste )
                        <tr>
                            <td>{{ $serial++ }}</td>
                            <td>{{ $expenses_liste->created_at->format('m-d-Y') }}</td>
                            <td>{{ $expenses_liste->amount }}</td>
                            <td>{{ $expenses_liste->name }}</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $expenses_listes->links('admin.layouts.pagination') }}
            </div>
           <tr>
            <td>
                <div class="d-flex justify-content-between pe-5">
                    <h4 class="header-title">Total amount:</h4>
                    <h4 class="header-title">{{ $total_amount }}</h4>
                </div>
            </td>
           </tr>
        </div>
    </div>
</div>
@endsection