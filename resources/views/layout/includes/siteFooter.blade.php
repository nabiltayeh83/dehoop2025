
<div class="footer_area">
    <div class="container">
        <div class="footer_top top_four">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single_footer">
                        <h3> {{ @$settings->title }} </h3>
                        <p> {{ @$settings->description }} </p>
                        
                        <div class="left_info">
                        <!--<ul>-->
                        <!--    <li class="px-2" style=" display: inline"><a href="tel:{{ @$settings->mobile }}"><i class="fa fa-phone"></i> {{ @$settings->mobile }} </a></li>-->
                        <!--    <li class="px-2"  style=" display: inline"><a href="mailto:{{ @$settings->email }}"><i class="fa fa-envelope-open-o"></i> {{ @$settings->email }} </a></li>-->
                            
                        <!--</ul>-->
                        
                        <div class="footer_social">
                            <ul>
                                <li><a target="_blank" href="{{ @$settings->tiktok }}"><i class="fab fa-tiktok"></i></a></li>
                                <li><a target="_blank" href="{{ @$settings->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="single_footer column_2">
                        <h3> {{ __('translate.links') }} </h3>
                        <ul>
                            <li> <a href="{{ route('homePage') }}"> {{ __('translate.home') }} </a> </li>
                            <li> <a href="{{ route('aboutUs') }}"> {{ __('translate.aboutUs') }} </a> </li>
                            <li> <a href="{{ route('ourPartner') }}"> {{ __('translate.ourPartner') }} </a> </li>
                            <!--<li> <a href="{{ route('ourBrands') }}"> {{ __('translate.ourBrands') }} </a> </li>-->
                            <li> <a href="{{ route('ourCollections') }}"> {{ __('translate.ourCollections') }} </a> </li>
                            <li> <a href="{{ route('contactUs') }}"> {{ __('translate.contactUs') }} </a> </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="single_footer column_2">
                        <h3> {{ __('translate.LegalInformation') }} </h3>
                        <ul>
                            <li> {{ __('translate.Registered') }}: {{ @$settings->vat_number }}  </li>
                            <li><a href="{{ @$settings->eur_comp_search }}" target="_blank"> {{ __('translate.CompanyRegistration') }}  </a></li>
                            <li><a href="{{ @$settings->lux_comp_url }}" target="_blank"> {{ __('translate.LuxembourgRCS') }} {{ @$settings->lux_comp_number }}  </a></li>
                            <li><a href="{{ @$settings->vat_url }}" target="_blank"> {{ __('translate.vat') }}: {{ @$settings->vat_number }}  </a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="single_footer column_3">
                        <h3> {{ __('translate.GetInTouch') }} </h3>
                        <ul>
                            <li><i class="fa fa-home"></i> {{ @$settings->address }} </li>
                            <li><i class="fa fa-phone"></i><a href="tel:{{ @$settings->mobile }}"> {{ @$settings->mobile }} </a> </li>
                            <li><i class="fa fa-envelope-open-o"></i> <a href="mailto:{{ @$settings->email }}"> {{ @$settings->email }} </a></li>
                            <li><i class="fa fa-globe"></i> <a href="{{ @$settings->url }}"> {{ @$settings->url }} </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="copyright_area copyright_four">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="copyright_conent">
                        <p>&copy; {{ date('Y') }} {{ @$settings->title }}. {{ __('translate.AllRightsReserved') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="footer_menu text-right">
                        <img src="{{ @$settings->logo }}" style="max-width: 100px;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>