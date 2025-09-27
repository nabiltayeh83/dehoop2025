<!doctype html>
<html class="no-js" lang="zxx">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
    
        <title> {{ @$settings->title }} - @yield('title') </title>
        <meta name="description" content="{{ @$settings->description }}">
        <meta name="keywords" content="{{ @$settings->keywords }}">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/x-icon" href="{{ @$settings->logo }}">
        <link rel="stylesheet" href="{{ url('frontend/assets/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="{{ url('frontend/assets/css/bundle.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/assets/css/plugins.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/assets/css/responsive.css') }}">
        <script src="{{ url('frontend/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        @yield('css')
        
    </head>
    
    <body>
            
        @include('layout.includes.siteHeader')
    
        @if(Route::currentRouteName() != 'homePage')
            
            <div class="breadcrumb-section blog_bread" style="margin-top: 20px;">
                <div class="container">   
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb_content">
                                <ul>
                                    <li><a href="{{ route('homePage') }}"> {{ __('translate.home') }} </a></li>
                                    @yield('breadcrumbItem')

                                    <li class="active"> <b> @yield('title') </b> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            
            
        @endif
    

        @yield('content')

        @include('layout.includes.siteFooter')
            
        <script src="{{ url('frontend/assets/js/vendor/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ url('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
        <script src="{{ url('frontend/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('frontend/assets/js/plugins.js') }}"></script>
        <script src="{{ url('frontend/assets/js/main.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        
        <script>
        
            $(document).on('submit','#sendContactMsg',function(e){
    
                var token = $("input[name = _token]").val();
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('storeContactMsg')}}",
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
        
                    success: function (response) {
                        if(response)
                        {    
                            $("#sendContactMsg").trigger("reset");
                            swal(" {{ __('translate.MessageSuccessfullySent') }} ");                            
                        }
                    }
                });

                return false;

            });            


            $(document).on('submit','#storeMailList',function(e){
    
                var token = $("input[name = _token]").val();
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('storeMailList')}}",
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
        
                    success: function (response) {
                        if(response)
                        {    
                            $("#storeMailList").trigger("reset");
                            swal(" {{ __('translate.emailAddedToMailingList') }} ");                            
                        }
                    }
                });

                return false;

            });            

        
        </script>
        
        
        @yield('script')
        
        @yield('js')
        
    </body>
</html>
