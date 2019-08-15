<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="../../images/favicon.ico"> --}}

    <title> welcomee </title>
  
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
</head>
<body class="hold-transition bg-img" style="background-image: url(../../images/gallery/full/6.jpg)" data-overlay="4">
    
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row no-gutters justify-content-md-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile h-p100">
                            <h2>{{ trans('message.Getstarted') }} <br> {{ trans('withUs') }}</h2>
                            <p class="text-white">{{ trans('message.login') }}</p>

                            <div class="text-center text-white">
                              <p class="mt-20">- {{ trans('message.login') }} With -</p>
                              <p class="gap-items-2 mb-20">
                                  <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>
                                  <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                                  <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                                  <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                                </p>
                            </div>
                            <div class="text-center text-white">
                                <a href="{{asset('/')}}" class="mt-20 text-center text-white">
                                    <i class="fa fa-home"></i>{{ trans('message.GoHome') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="p-40 bg-white content-bottom h-p100">
                            <form action="{{ route('login') }}" method="post" class="form-element">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info border-info">
                                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        {{-- <input type="text" class="form-control pl-15" placeholder="{{ __('E-Mail Address') }}"> --}}

                                        {{-- <div class="col-md-6"> --}}
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} pl-15" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info border-info">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        </div>
                                        {{-- <input type="password" class="form-control pl-15" placeholder="Password"> --}}

                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}  pl-15" name="password" required placeholder="{{ __('Password') }}">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="checkbox">
                                            <input type="checkbox" id="basic_checkbox_1" >
                                            <label for="basic_checkbox_1">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <div class="fog-pwd text-right">
                                            <a href="javascript:void(0)"><i class="ion ion-locked"></i> </a><br>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-block margin-top-10">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>     

                            <div class="text-center">
                                <p class="mt-15 mb-0">{{ trans('message.donotHasAccount') }}<a href="{{ route('registercustom') }}" class="text-info ml-5">{{ trans('message.login') }}</a></p>
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

</body>
</html>
