
<header class="header_area header_four">
    <div class="container-fluid p-0">
        
        <div class="header_top d-none d-sm-block">
            <div class="row align-items-center no-gutters">
                <div class="col-lg-7 col-md-12 ">
                    <div class="left_info ">
                        <ul>
                            <li><a href="tel:{{ @$settings->mobile }}"><i class="fa fa-phone"></i> {{ @$settings->mobile }} </a></li>
                            <li><a href="mailto:{{ @$settings->email }}"><i class="fa fa-envelope-open-o"></i> {{ @$settings->email }} </a></li>
                            <li>
                                <div class="header_social">
                                    <ul>
                                        <li><a target="_blank" href="{{ @$settings->tiktok }}"><i class="fab fa-tiktok"></i></a></li>
                                        <li><a target="_blank" href="{{ @$settings->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="right_info text-right d-none d-sm-block">
                        <ul>
                            <li class="language" ><a href="#"> {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }} <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_language">
                                    @foreach(App\Models\Language::active()->where('code', '<>', app()->getLocale())->get() as $one)
                                        <li><a href="{{ LaravelLocalization::getLocalizedURL($one->code, null, [], true) }}"> {{ $one->name }}  </a></li>
                                    @endforeach
                                </ul> 
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>      
         
        <div class="header_bottom sticky-header">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="{{ route('homePage') }}"><img src="{{ $settings->logo }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main_menu_inner">
                        <div class="main_menu d-none d-lg-block"> 
                            <ul>
                                <li class="@if(Route::currentRouteName() == 'homePage')  active @endif ">
                                    <a href="{{ route('homePage') }}"> {{ __('translate.home') }} </a>
                                </li>
                                <li class="@if(Route::currentRouteName() == 'aboutUs')  active @endif ">
                                    <a href="{{ route('aboutUs') }}"> {{ __('translate.aboutUs') }} </a>
                                </li>
                                <li class="@if(Route::currentRouteName() == 'ourPartner')  active @endif ">
                                    <a href="{{ route('ourPartner') }}"> {{ __('translate.ourPartner') }} </a>
                                </li>
                                <!--<li class="@if(Route::currentRouteName() == 'ourBrands')  active @endif ">-->
                                <!--    <a href="{{ route('ourBrands') }}"> {{ __('translate.ourBrands') }} </a>-->
                                <!--</li>-->
                                <li class="@if(Route::currentRouteName() == 'ourCollections')  active @endif ">
                                    <a href="{{ route('ourCollections') }}"> {{ __('translate.ourCollections') }} </a>
                                </li>
                                <li class="@if(Route::currentRouteName() == 'contactUs')  active @endif ">
                                    <a href="{{ route('contactUs') }}"> {{ __('translate.contactUs') }} </a>
                                </li>
                                
                            </ul>
                        </div>
                                    
                        <div class="mobile-menu d-lg-none">
                            <nav>  
                                <ul>
                                    <li><a href="{{ route('homePage') }}"> {{ __('translate.home') }} </a></li>
                                    <li><a href="{{ route('aboutUs') }}"> {{ __('translate.aboutUs') }} </a></li>
                                    <li><a href="{{ route('ourPartner') }}"> {{ __('translate.ourPartner') }} </a></li>
                                    <!--<li><a href="{{ route('ourBrands') }}"> {{ __('translate.ourBrands') }} </a></li>-->
                                    <li><a href="{{ route('ourCollections') }}"> {{ __('translate.ourCollections') }} </a></li>
                                    <li><a href="{{ route('contactUs') }}"> {{ __('translate.contactUs') }} </a></li>
                                    <li><a href="#"> {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown_language">
                                        @foreach(App\Models\Language::active()->where('code', '<>', app()->getLocale())->get() as $one)
                                            <li><a href="{{ LaravelLocalization::getLocalizedURL($one->code, null, [], true) }}"> {{ $one->name }}  </a></li>
                                        @endforeach
                                    </ul> 
                                </li> 
                                </ul>
                            </nav>      
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>  
</header>