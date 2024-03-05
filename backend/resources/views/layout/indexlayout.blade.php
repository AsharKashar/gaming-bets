<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    @include('layout.partials.head')
    @stack('css')

    <style>
        .errors {
            position:  fixed;
            max-width: 40vw;
            top:       5.4rem;
            right:     0;
            z-index:   5000;
        }
    </style>
</head>

<body>
  

@include('layout.partials.indexheader')
@if(isset($errors) && count($errors->all()))
    <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('msg'))

    <div class="errors alert alert-dismissible fade show alert-dark" role="alert">
        {{Session::get('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@yield('content')

@include('layout.partials.footer')
@include('layout.partials.footer-scripts')

@stack('js')
@yield('scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });    $("#loginBtn").click(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $("#loginForm");
        var url = '/login';

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), //
            success: function(data)
            {
                console.log(data)
                if(data.status){
                    location.reload();
                }else{
                    $("#loginMsg").show()
                    $("#loginMsg").html(data.msg)
                }
            }
        });


    });
    
</script>
</body>

</html>
