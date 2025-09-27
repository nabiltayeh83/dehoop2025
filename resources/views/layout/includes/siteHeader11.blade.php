
    <header class="section {{ Route::currentRouteName() == 'homePage'? 'page-header page-header-1' : 'page-header page-header-4' }} ">
        
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="10px" data-xl-stick-up-offset="10px" data-xxl-stick-up-offset="10px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                <div class="rd-navbar-main">
                    <div class="rd-navbar-panel">
                    
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        
                        <div class="rd-navbar-brand"> 
                            <a class="brand" href="{{ route('homePage') }}">
                                <img class="brand-logo-dark" src="{{ @$settings->logo }}" alt="{{ @$settings->title }}" height="20" srcset="images/logo-222x66.png 2x"/></a></div>
                        
                    </div>
              
                    <div class="rd-navbar-nav-wrap">
                        
                        
                        
                        <ul class="rd-navbar-nav">
                            <!--<li class="rd-nav-item"><a class="rd-nav-link" href="#">Get Our App</a></li>-->
                                
                            <li class="rd-nav-item">
                                
                                    <?php
                                        $langEn = LaravelLocalization::getSupportedLocales()['en'];
                                        $langFr = LaravelLocalization::getSupportedLocales()['fr'];
                                        $langAr = LaravelLocalization::getSupportedLocales()['ar'];
                                        $langNl = LaravelLocalization::getSupportedLocales()['nl'];
                                    ?>
                                    
                                    @foreach(App\Models\Language::get() as $one)
                                        {{ $one->lang }}
                                    @endforeach
                                    
                                    
                                
                                <a class="rd-nav-link" href="#"> {{ LaravelLocalization::getSupportedLocales()[app()->getLocale()]['native'] }} </a>
                                <div class="rd-menu rd-navbar-megamenu">
                                    
                                    <ul class="rd-navbar-megamenu-inner">
                                        <li class="rd-megamenu-item">
                                            <ul class="rd-megamenu-list">

                                            <li class="rd-megamenu-list-item">
                                                <a class="rd-megamenu-list-link" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"> 
                                                    {{ $langEn['native'] }} 
                                                </a>
                                            </li>
                                                
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ LaravelLocalization::getLocalizedURL('fr', null, [], true) }}"> {{ $langFr['native'] }} </a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"> {{ $langAr['native'] }} </a></li>
                                            <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ LaravelLocalization::getLocalizedURL('nl', null, [], true) }}"> {{ $langNl['native'] }} </a></li>
                                                
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </li>
                                
                            <li class="rd-nav-item"><a class="rd-nav-link" href="#"> {{ __('translate.pages') }}  </a>
                                <div class="rd-menu rd-navbar-megamenu">
                                    <ul class="rd-navbar-megamenu-inner">
                                        <li class="rd-megamenu-item">
                                            <ul class="rd-megamenu-list">
                                                @foreach(App\Models\Page::active()->get() as $one)
                                                    <li class="rd-megamenu-list-item">
                                                        <a class="rd-megamenu-list-link" href="{{ route('pageDetails', $one->id) }}"> 
                                                            {{ @$one->title }} 
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                        
                                        <li class="rd-megamenu-item">
                                            <ul class="rd-megamenu-list">
                                                <!--@if(Auth::check())-->
                                                <!--    <li class="rd-megamenu-list-item">-->
                                                <!--        <a class="rd-megamenu-list-link" href="{{ route('logoutUsers') }}"> {{ __('translate.logout') }} </a>-->
                                                <!--    </li>-->
                                                <!--@else-->
                                                <!--    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ route('SignIn') }}"> {{ __('translate.signin') }} </a></li>-->
                                                <!--@endif-->
                                                    
                                                <!--<li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ route('SignUp') }}"> {{ __('translate.signup') }} </a></li>-->
                                                <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ route('getFaqs') }}"> {{ __('translate.faqs') }} </a></li>
                                                <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ route('getServices') }}"> {{ __('translate.services') }} </a></li>
                                                <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="{{ route('getTestimonials') }}"> {{ __('translate.testimonials') }}  </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
              
                    <div class="rd-navbar-element {{ Route::currentRouteName() == 'homePage'? 'bg-accent' : '' }} ">
                  
                        <!--@if(Auth::check())-->
                        <!--    <a class="button button-sm button-default-outline button-winona" href="{{ route('logoutUsers') }}"> {{ __('translate.logout') }}  </a>-->
                        <!--@else-->
                        <!--    <a class="button button-sm button-default-outline button-winona" href="{{ route('SignIn') }}"> {{ __('translate.signin') }}  </a>-->
                        <!--@endif-->

                        <!--<button class="rd-navbar-aside-open-toggle" data-multitoggle="#rd-navbar-aside" aria-label="Sidebar toggle"><span></span><span></span><span></span></button>-->
                    
                    </div>
                            
                    <div class="rd-navbar-dummy"></div>
                </div>
            
              <!--  <div class="rd-navbar-aside" id="rd-navbar-aside"> -->
            
              <!--      <div class="rd-navbar-aside-header">-->
              <!--          <p class="rd-navbar-aside-title">Navigation</p>-->
              <!--          <button class="rd-navbar-aside-close-toggle linearicons-cross2" data-multitoggle="#rd-navbar-aside" data-scope=".rd-navbar" aria-label="Sidebar toggle"></button>-->
              <!--      </div>-->
                    
              <!--      <div class="rd-navbar-aside-main">-->
              <!--          <div class="rd-navbar-aside-group navbar" data-navbar="{&quot;stuck&quot;: false, &quot;anchor&quot;: {&quot;offsetRef&quot;: &quot;.rd-navbar-main&quot;}}">-->
              <!--          <div class="navbar-inner">-->
              <!--              <a class="rd-navbar-aside-link" href="about-us.html">About Us</a>-->
              <!--              <a class="rd-navbar-aside-link" href="faq.html">FAQ</a>-->
              <!--              <a class="rd-navbar-aside-link" href="testimonials.html">Testimonials</a>-->
              <!--              <a class="rd-navbar-aside-link" href="our-team.html">Our Team</a>-->
              <!--          </div>-->
              <!--      </div>-->
                    
              <!--</div>-->
              
              <!--  </div>-->
            </nav>
        </div>
        
        
        @if(Route::currentRouteName() == 'homePage')
            @include('website.getTaxiNow')
        @endif

    </header>