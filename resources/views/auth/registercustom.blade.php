<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../images/favicon.ico">

    <title> Register </title>
   <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/bootstrap.min.css') }}">
    
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/bootstrap-extend.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/master_style.css') }}">

    <!-- Superieur Admin skins -->
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/_all-skins.css') }}">
    {{-- link font-awsome --}}
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminTemplate/Css/toastr.min.css') }}">
     @routes()
</head>

<body class="hold-transition bg-img" style="background-image: url(../../images/gallery/full/6.jpg)" data-overlay="4">
    
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row no-gutters justify-content-md-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile h-p100">
                            <h2>{{ trans('message.Getstarted') }} <br> {{ trans('withUs') }}</h2>
                            <p class="text-white">{{ trans('message.newMember') }}</p>

                            <div class="text-center text-white">
                                <p class="mt-20">-{{ trans('message.register') }} -</p>
                                <p class="gap-items-2 mb-20">
                                    <a class="btn btn-social-icon btn-outline btn-white" href="auth/facebook"><i class="fa fa-facebook"></i></a>
                                    <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                                    <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                                    <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                                </p>
                            </div>
                            <div class="text-center text-white">
                                <a href="{{asset('/')}}" class="mt-20 text-center text-white">
                                    <i class="fa fa-home"></i> {{ trans('message.GoHome') }}
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="p-40 bg-white content-bottom">
                            <form action="#" method="post" class="form-element">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info border-info">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control pl-15" placeholder="Full Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info border-info">
                                                <i class="fa fa-envelope-open-o"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control pl-15" placeholder="Email" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend form-control">
                                            <p class="input-group-text bg-info border-info" style="text-align:center">
                                                <i class="fa fa-object-group"></i> {{ trans('message.course') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <select name="subject_id" id="subject_id" class="form-control pl-15">
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1" >
                                            <label for="basic_checkbox_1">{{ trans('message.agree') }}<a href="#" class="text-warning"><b>
                                            {{ trans('message.tearm') }}</b></a></label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info btn-block margin-top-10">{{ trans('message.register') }}</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form> 

                            <div class="text-center">
                                <p class="mt-15 mb-0">{{ trans('message.hassAccount') }}<a href="{{ route('login') }}" class="text-danger ml-5"> {{ trans('message.login') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/adminTemplate/Js/jquery-3.3.1.js') }}"></script>
    <!-- popper -->
    <script src="{{ asset('bower_components/adminTemplate/Js/popper.min.js') }}"></script>
    <!-- Bootstrap 4.0-->
    <script src="{{ asset('bower_components/adminTemplate/Js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminTemplate/Js/toastr.min.js') }}"></script>
    {{-- custom js --}}
    <script src ={{ asset('/js/admin.js') }}></script>


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '441817523214128',
      cookie     : true,
      xfbml      : true,
      version    : 'v4.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "http://localhost/projectAbc/public/";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
