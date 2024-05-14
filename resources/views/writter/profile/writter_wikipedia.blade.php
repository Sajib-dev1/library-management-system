@extends('writter.writter_master')
@section('content')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h6>Writter Summary</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('writter.summary.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Summary</label>
                            <textarea name="summary" class="form-control" id="myTextarea" cols="30" rows="10"></textarea>
                       </div>
                       <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
                    </form>
                </div>
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
        ClassicEditor
        .create(document.querySelector("#myTextarea"))
        .catch(error => {
            console.error( error );
        } );
    </script>
@endsection