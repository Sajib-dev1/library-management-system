@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Socile icon List</h4>
                    <table class="table table-borderd">
                        <tr>
                            <th>SL</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach ( $sociles as $sl=>$socile )
                            <tr>
                                <td>{{ $sl+1 }}</td>
                                <td>
                                    <span><i class="fa {{ $socile->socile_icon }} socile_btn" style="font-family: fontawesome; font-size:30px"></i></span>
                                </td>
                                <td>
                                    <a href="{{ $socile->socile_link }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{ route('studend.socile.delete',$socile->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        @php
        $fonts = array(                             
            'fa-twitter-square',                     
            'fa-facebook-square',
            'fa-linkedin-square',
            'fa-twitter',                            
            'fa-facebook',                           
            'fa-github', 
            'fa-pinterest',                          
            'fa-pinterest-square',                   
            'fa-google-plus-square',                 
            'fa-google-plus', 
            'fa-linkedin',
            'fa-youtube-square',                     
            'fa-youtube', 
            'fa-youtube-play',                            
            'fa-stack-overflow',                     
            'fa-instagram',                          
            'fa-flickr',  
            'fa-skype',
            'fa-facebook-official',                  
            'fa-pinterest-p',                        
            'fa-whatsapp',                                                       
        );
        @endphp
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h6>Add New Socile Icon</h6>
                    <div class="col-lg-12">
                        @foreach ( $fonts as $icon )
                            <button type="button" style="border: none" class="btn btn-info my-2">
                                <i class="fa {{ $icon }} socile_btn" style="font-family: fontawesome;" socile-icon="{{ $icon }}"></i>
                            </button>
                        @endforeach
                    </div>
                    <form action="{{ route('student.socile.store') }}" method="post" id="mysocile">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Socile Icon</label><br>
                            <input type="text" name="socile_icon" id="icon" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Socile Link</label>
                            <input type="text" name="socile_link" class="form-control" placeholder="pest your socile link">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Form submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    <script>
        $('.socile_btn').click(function(){
            var icon = $(this).attr('socile-icon');
            $('#icon').attr('value',icon);
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
        $( "#mysocile" ).validate({
            rules: {
                socile_link: 'required',
            }
        })
    </script>
@endsection