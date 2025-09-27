<!DOCTYPE html>

<html lang="{{ app()->getLocale() == 'en'? 'en': 'ar' }}" dir="{{ app()->getLocale() == 'ar'? 'rtl': 'ltr' }}">
    
<head>
    <base href="">
    <title> {{ $setting->title }} - @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{$setting->logo}}" />
    <link href="{{ url('new_assets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('new_assets/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    
    
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo" />
        <link href="{{ url('new_assets/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('new_assets/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="{{ url('new_assets/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('new_assets/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
        <link href="{{ url('new_assets/assets/css/myStyle.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .symbol {
            color: red;
        }
        .form-control{
            margin-bottom: 15px;
        }
        
        #map-canvas {
            width: 800px;
            height: 350px;
        }
    </style>
    
    
    <style>
        ul.breadcrumb {
          padding: 5px 5px;
          list-style: none;
        }
        ul.breadcrumb li {
          display: inline;
          font-size: 18px;
        }
        ul.breadcrumb li+li:before {
          padding: 3px;
          color: black;
          content: "/\00a0";
        }
        ul.breadcrumb li a {
          color: #0275d8;
          text-decoration: none;
        }
        ul.breadcrumb li a:hover {
          color: #01447e;
          text-decoration: underline;
        }
    </style>
    
    <style>
        .dropbtn {
          background-color: #4CAF50;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        
        .dropdown {
          position: relative;
          display: inline-block;
        }
        
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        
        .dropdown-content a:hover {background-color: #f1f1f1}
        
        .dropdown:hover .dropdown-content {
          display: block;
        }
        
        .dropdown:hover .dropbtn {
          background-color: #3e8e41;
        }
    </style>

  
    @yield('css')
    
   
</head>


<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <div class="d-flex flex-column flex-root">

        <div class="page d-flex flex-row flex-column-fluid">
            @include('layout.includes.adminSidebar')

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <div id="kt_header" style="" class="header align-items-stretch">

                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                        
                                <span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
										<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
									</svg>
								</span>
                        
                            </div>
                        </div>
                    
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <div class="d-flex align-items-stretch" id="kt_header_nav">
                        </div>
                   
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <div class="d-flex align-items-stretch flex-shrink-0">
                               
                               
                               <div class="d-flex align-items-center ms-1 ms-lg-3" style="padding: 10px">
                         

                                    <div class="dropdown">
                                        <button class="dropbtn"> {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }}  </button>
                                        <div class="dropdown-content">
                                            

                                            @foreach(App\Models\Language::active()->where('code', '<>', app()->getLocale())->get() as $one)
                                                <a href="{{ LaravelLocalization::getLocalizedURL($one->code, null, [], true) }}"> 
                                                    {{ $one->name }}
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <b> {{ auth()->guard('admin')->user()->first_name }}  {{ auth()->guard('admin')->user()->last_name }}  </b>
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-5">
                                            <a href="{{ route('admin.admins.edit',auth()->guard('admin')->user()->id) }}" class="menu-link px-5">
                                                {{__('translate.edit_my_profile')}}
                                            </a>
                                        </div>
                                        <div class="menu-item px-5">
                                            <a href="{{route('admin.admins.edit_password',auth()->guard('admin')->user()->id)}}" class="menu-link px-5">
                                                <span class="menu-text">{{__('translate.ChangePassword')}}</span>
                                            </a>
                                        </div>
                                        <div class="menu-item px-5">
                                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">
                                                {{__('translate.logout')}}
                                            </a>
                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                        <div class="separator my-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    @if(Route::currentRouteName() != 'admin.admin.home')
                    <div class="toolbar" id="kt_toolbar">
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <ul class="breadcrumb">
                                    <li><a href="{{ route('admin.admin.home') }}"> {{ __('translate.home') }} </a></li>
                                    @yield('breadcrumb')
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                        
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                        
                            @if (count($errors) > 0)
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

                            @yield('content')
                        
                        </div>
                    </div>
                </div>
                
                @include('layout.includes.adminFooter')
            </div>
        </div>
    </div>


    <script>var hostUrl = "assets/";</script>
    <script src="{{ url('new_assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('new_assets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ url('new_assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/custom/modals/upgrade-plan.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/custom/modals/create-app.js') }}"></script>
    <script src="{{ url('new_assets/assets/js/custom/modals/users-search.js') }}"></script>
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>--}}
    <script src="{{ url('new_assets/assets/js/custom.js') }}" type="text/javascript"></script>
    <script src="https://cdn.ckeditor.com/4.17.2/full/ckeditor.js"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('APIGoogleKey')}}&libraries=places" type="text/javascript"></script>


    <div class="modal fade" id="myConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
        <div class="modal-dialog" id="confirm-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="confirmCancel"></button>
                    <h4 class="modal-title" id="confirm-title"></h4>
                </div>
                <div class="modal-body new_font" id="confirm-body" style="font-size: 16px;"></div>
                <div class="modal-footer" id="confirm-footer">
                    <button type="button" class="btn font-green" data-dismiss="modal" id="msgCancelBtn">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="MyMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="msg-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="msgCancel"></button>
                    <h4 class="modal-title" id="msg-title"></h4>
                </div>
                <div class="modal-body new_font" style="font-size: 16px;" id="msg-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn font-green" data-dismiss="modal" id="msgCancelBtn">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div id="deleteAll" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{__('translate.delete')}}</h4>
                </div>
                <div class="modal-body">
                    <p>{{__('translate.confirmDeleteAll')}} </p>
                </div>
                <div class="modal-footer">
                    <button class="btn default" data-dismiss="modal" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                    <a href="#" class="confirmAll" data-action="delete"><button class="btn btn-danger"> Delete </button></a>
                </div>
            </div>
        </div>
    </div>


    <div id="activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{__('translate.activation')}}</h4>
                </div>
                <div class="modal-body">
                    <p>{{__('translate.confirmActiveAll')}} </p>
                </div>
                <div class="modal-footer">
                    <button class="btn default" data-dismiss="modal" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                    <a href="#" class="confirmAll" data-action="active">
                        <button class="btn btn-success"> Yes </button>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div id="cancel_activation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">{{__('translate.cancel_activation')}}</h4>
                </div>
                <div class="modal-body">
                    <p>{{__('translate.confirmNotActiveAll')}} </p>
                </div>
                <div class="modal-footer">
                    <button class="btn default" data-dismiss="modal" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close" > Cancel </button>
                    <a href="#" class="confirmAll" data-action="not_active"><button class="btn btn-success"> Yes </button></a>
                </div>
            </div>
        </div>
    </div>


    @yield('js')


    <script>
        $('#active').on('click', function (e) {
            $('#activation').modal('show');
        });

        $('#not_active').on('click', function (e) {
            $('#cancel_activation').modal('show');
        });
        
        $('#delete_all').on('click', function (e) {
            $('#deleteAll').modal('show');
        });
    
    
        $(document).on('change','.changePermission',function(e){
            var permissionTxt = $(this).val();
            var ordersSelectd = permissionTxt.indexOf("orders");
            if(ordersSelectd >= 0){
                $('.selectDriver').show(1000);
            }
            else{
                $('.selectDriver').hide(1000);
            }
        });


        $('.table').on('click', '.btn-delete', function () {
        var BTN = $(this);
        var id = BTN.data('id');
        // alert(id);
        showConfirm("{{ __('translate.delete') }}", 'deleteBtn', "{{ __('translate.AreYouSureYouWantToDelete') }}", "modal-30");
        var segment = '{{explode("/", request()->url())[5] }}';
        

        var url = '{{url(getLocal())}}' + "/admin/" + segment + '/' + id;


        var csrf_token = '{{csrf_token()}}';
        $("#deleteBtn").click(function () {
            $.ajax({
                type: 'post',
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {_method: 'delete'},
                success: function (response) {
                    console.log(response);
                    // showMsg('حذف ملف', 'تم الحذف', 'success', 'modal-30');
                    BTN.closest('tr').remove();
                },
                error: function (e) {
                    console.log('error');
                    // showMsg('حذف ملف', 'لم يتم الحذف', 'danger', 'modal-30');
                }
            });
            hideConfirm();
        });
    });



        
        
        
        
    </script>

    <script>

        // CKEDITOR.replace( 'details_en' );
        // CKEDITOR.replace( 'details_ar' );
        // CKEDITOR.replace( 'details_fr' );
        // CKEDITOR.replace( 'details_nl' );
    
        // CKEDITOR.replace( 'description_ar' );
        // CKEDITOR.replace( 'description_en' );

        // CKEDITOR.replace( 'overview' );
        // CKEDITOR.replace( 'key_aspects' );
        // CKEDITOR.replace( 'key_takeaways' );

        $(document).on('change','.country',function(e){
            var country_id = $(this).val();
            var url = "{{ url(app()->getLocale().'/admin/getCities/') }}";
            
            if(country_id){
                $.ajax({
                    type: "GET",
                    url: url+'/'+country_id,
                    success: function (response) {
                        if(response)
                        {
                            $(".city").empty();
                            $(".city").append('<optgroup label="{{__('translate.choose_city')}}">');
                            $.each(response, function(index, value){
                            $(".city").append('<option value="'+value.id+'">'+ value.name +'</option>');
                            $(".city").append('</optgroup>');
                        });
                    }
                }
            });
        }
            else{
                $(".city").empty();
            }
        });

    </script>

    <script>
        $(document).on('click','#checkboxall',function(e){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });

        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });

        $('#edit_image1').on('change', function (e) {
            readURL(this, $('#editImage1'));
        });
        
        $('#all_images').on('change', function (e) {
            readURLMultiple(this, $('.imageupload'));
        });        
        

        var IDArray = [];
        
        $("input:checkbox[name=chkBox]:checked").each(function () {
            IDArray.push($(this).val());
        });
        
        if (IDArray.length == 0) {
            $('.event').attr('disabled', 'disabled');
        }
        
        $('.chkBox').on('change', function () {
            var IDArray = [];
            $("input:checkbox[name=chkBox]:checked").each(function () {
                IDArray.push($(this).val());
            });
            if (IDArray.length == 0) {
                $('.event').attr('disabled', 'disabled');
            } 
            else {
                $('.event').removeAttr('disabled');
            }
        });
        
        $('.confirmAll').on('click', function (e) {
            e.preventDefault();
            var action = $(this).data('action');

            var url = "{{ url('/admin/changeStatus/'.Request::segment(3)) }}";
        
        
            var csrf_token = '{{csrf_token()}}';
            var IDsArray = [];
            
            $("input:checkbox[name=chkBox]:checked").each(function () {
                IDsArray.push($(this).val());
            });

            if (IDsArray.length > 0) {
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    url: url,
                    data: {action: action, IDsArray: IDsArray, _token: csrf_token},
                    success: function (response) {
                        if (response === 'active') {
                            $.each(IDsArray, function (index, value) {
                                $('#label-' + value).removeClass('btn-light-danger');
                                $('#label-' + value).addClass('btn-light-success');
                                $r = '{{app()->getLocale()}}';
                                if($r == 'ar'){
                                    $('#label-' + value).text('فعال ');
                                }
                                else{
                                    $('#label-' + value).text('active');
                                }
                            });
                            $('#activation').modal('hide');
                        } 
                        else if (response === 'not_active') {
                            $.each(IDsArray, function (index, value) {
                                $('#label-' + value).removeClass('btn-light-success');
                                $('#label-' + value).addClass('btn-light-danger');
                                $r = '{{app()->getLocale()}}';
                                if($r == 'ar'){
                                    $('#label-' + value).text('غير فعال');
                                }
                                else{
                                    $('#label-' + value).text('Not Active');
                                }
                            });
                            $('#cancel_activation').modal('hide');
                        }
                        else if (response === 'delete') {
                            $.each(IDsArray, function (index, value) {
                                $('#tr-' + value).hide(2000);
                            });
                            $('#deleteAll').modal('hide');
                        }

                        IDArray = [];
                        $("input:checkbox[name=chkBox]:checked").each(function () {
                            $(this).prop('checked', false);
                        });
                        $('.event').attr('disabled', 'disabled');
                    },
                    fail: function (e) {
                        alert(e);
                    }
                });
            } 
            else {
                alert('{{__('translate.not_selected')}}');
            }
        });
    
        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    target.attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }



        $('#toolsTable1').DataTable({
            dom: 'Bfrtip',
            searching: false,
            "oLanguage": {
                "sSearch": "{{__('translate.search')}}"
            },
            bInfo: true, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            paging: false,//Dont want paging
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        $('.btn--filter').click(function () {
            $('.box-filter-collapse').slideToggle(500);
        });

        function readURLMultiple(input, target) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (var i = 0; i < filesAmount; i++){
                    var reader = new FileReader();
                    reader.onload = function (event){
                        target.append('<div class="imageBox text-center" style="width:150px;height:190px;margin:5px; padding:3px;"><img src="'+event.target.result+'" style="width:150px;height:150px; padding:3px;"><button class="btn btn-danger deleteImage" type="button">{{__("translate.remove")}}</button><input class="attachedValues" type="hidden" name="filename[]" value="'+event.target.result+'"></div>');
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $(document).on("click", ".deleteImage", function () {
            $(this).parent().remove();
        });

    </script>


    @yield('script')

</body>
</html>