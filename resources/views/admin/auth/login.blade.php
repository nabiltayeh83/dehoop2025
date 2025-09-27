<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8" />
        <title> {{ $setting->title }} </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" href="{{ url($setting->logo) }}">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;800&display=swap" rel="stylesheet">
	  
	    <style>
        html {
            height: 100%;
        }

        body {
            color: #575a5d;
            font-family: 'Tajawal', sans-serif !important;
            font-size: 14px;
            font-weight: normal;
            letter-spacing: 0.01em;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-font-feature-settings: "kern" 1;
            -moz-font-feature-settings: "kern" 1;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f5f6f7;
            @if(app()->getLocale() == "ar")
                direction: rtl;
                text-align: right;
            @else
                direction: ltr;
            @endif
            -moz-osx-font-smoothing: grayscale;
        }

        a:hover {
            text-decoration: none
        }

        .logoLogin {
            padding: 30px 30px 0;
            margin: 30px 20px 0 20px;
        }

        .logoLogin img {
            max-width: 250px;
        }

        .login-wrapper {
            height: 100%;
            /* background-color: #F94B4B;*/
        }

        .login-wrapper > * {
            height: 100%;
        }

        .login-wrapper .bg-pic {
            position: absolute;
            width: 100%;
            overflow: hidden;
        }

        .login-wrapper .bg-pic > img {
            height: 100%;
            width: 100%;
            opacity: 0.7;
        }

        .login-wrapper .login-container {
            width: 496px;
            display: block;
            position: relative;
            float: right;
            height: 100%;
        }
        .login-container{
            height: 100%;
            margin-top: 76px;
        }


        .login-wrapper .bg-caption {
            width: 500px;
        }

        .formLogin {
            padding-top: 15px
        }

        .form-group-default {
            background-color: #fff;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.07);
            border-radius: 2px;
            padding-top: 7px;
            padding-left: 12px;
            padding-right: 12px;
            padding-bottom: 4px;
            overflow: hidden;
            width: 100%;
            -webkit-transition: background-color 0.2s ease;
            transition: background-color 0.2s ease;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label:not(.error) {

            font-size: 10.5px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .form-group-default label {
            margin: 0;
            display: block;
            opacity: 1;
            -webkit-transition: opacity 0.2s ease;
            transition: opacity 0.2s ease;
        }

        .form-group-default .form-control {
            border: none;
            height: 25px;
            min-height: 25px;
            padding: 0;
            margin-top: -4px;
            background: none;
        }

        .form-control {
            background-color: #fff;
            background-image: none;
            border: 1px solid rgba(0, 0, 0, 0.07);

            -webkit-appearance: none;
            color: #2c2d2f;
            outline: 0;
            padding: 8px 12px;
            line-height: normal;
            font-size: 14px;
            font-weight: normal;
            vertical-align: middle;
            min-height: 35px;
            -webkit-transition: all 0.12s ease;
            transition: all 0.12s ease;
            box-shadow: none;
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -webkit-transition: background 0.2s linear 0s;
            transition: background 0.2s linear 0s;
        }

        .form-control:focus {
            outline: 0 !important;
            box-shadow: none;
        }

        .form-control:focus::-moz-placeholder {
            color: inherit;
            opacity: 0.7;
            font-size: 12px
        }

        .form-control:focus:-ms-input-placeholder {
            color: inherit;
            opacity: 0.7;
            font-size: 12px
        }

        .form-control:focus::-webkit-input-placeholder {
            color: inherit;
            opacity: 0.7;
            font-size: 12px
        }

        .form-control::-moz-placeholder {
            color: inherit;
            opacity: 0.33;
            font-size: 12px
        }

        .form-control:-ms-input-placeholder {
            color: inherit;
            opacity: 0.33;
            font-size: 12px
        }

        .form-control::-webkit-input-placeholder {
            color: inherit;
            opacity: 0.33;
            font-size: 12px
        }

        .titleLog {
            font-size: 20px;
        }

        .pull-right {
            float: right !important;
        }

        .pull-bottom {
            position: absolute !important;
            bottom: 0;
        }

        .btnSub {
            margin-right: 5px;
            min-width: 120px;
            margin-top: 10px;
            background-color: #EE1818;
            border-color: #EE1818;
            color: #fff;
            box-shadow: none;
        }

        .btnSub:hover, .btnSub:focus {
            opacity: .7;
            background-color: #EE1818;
            border-color: #EE1818;
            color: #fff;
        }

        @media (max-width: 768px) {
            .login-wrapper .login-container {
                width: 100%;
            }

            .register-container {
                width: 100%;
                padding: 15px;
            }
        }

        @media only screen and (max-width: 321px) {
            .login-wrapper .login-container {
                width: 100%;
            }
        }

    </style>
    </head>
	
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                        <div class="login-container bg-white">
                            <div align="center">
                                <img class="mt-5" src="{{$setting->logo}}" alt="logo" style="max-width:150px;">
                            </div>

                            <div class="logoLogin">
                                <p class="titleLog text-center">
                                    <b> {{ $setting->title }} </b>
                                </p>
                   
                                @if(count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-primary">
                                        <div class="d-flex flex-column">
                                            <span> {{ $error }} </span>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                        
                                @if (session('status'))
                                    <div class="alert alert-primary">
                                        <div class="d-flex flex-column">
                                            <span>
                                                {{  session('status')  }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
             
          
                                {!! Form::open(['route' => 'admin.login','files' => true, 'class' => 'formLogin']) !!}
                                <div class="form-body">
            
                                    <div class="form-group form-group-default">
                                        {!! Form::label('email', __('translate.email')) !!}
                                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group form-group-default">
                                        {!! Form::label('password', __('translate.password')) !!}
                                        {!! Form::input('password', 'password', old('password'), ['class' => 'form-control']) !!}
                                    </div>
        
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit(__('translate.SignIn'), ['class' => 'btn btnSub']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                <div class="col-md-3"></div>
                </div>
        </div>
    </body>
    
</html>