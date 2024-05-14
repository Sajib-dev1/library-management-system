@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-box">
                    <h4 class="m-t-0 m-b-30 header-title">Student profile update</h4>
            
                    <form role="form" action="{{ route('student.education.update') }}" id="myform" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Education</label>
                                    <input type="text" name="education" class="form-control" placeholder="Senior Graphic Designer">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Course Start date</label>
                                    <input type="date" name="course_start" class="form-control" placeholder="Senior Graphic Designer">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Course End date</label>
                                    <input type="date" name="course_end" class="form-control" placeholder="Senior Graphic Designer">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Institute webside</label>
                                    <input type="text" name="webside_url" class="form-control" placeholder="Institute webside url">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Short description</label>
                                    <textarea name="short_desp" class="form-control" id="" cols="30" rows="4" placeholder="short description"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
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
        $( "#myform" ).validate({
            rules: {
                education: {
                    required: true
                },
                webside_url: {
                    required: true,
                },
                short_desp: {
                    required: true,

                },
            }
        });
    </script>
@endsection