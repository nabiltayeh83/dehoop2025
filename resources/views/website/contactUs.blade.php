@extends('layout.siteLayout')

@section('title', __('translate.contactUs'))


@section('css')
@endsection


@section('content')


    <div class="contact_area">
        <div class="container">   
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                        <h3> {{ __('translate.ContactInformation') }} </h3>    
                        <ul>
                            <li><i class="fa fa-home"></i>  {{ @$settings->address }} </li>
                            <li><i class="fa fa-phone"></i> <a href="tel:{{ @$settings->mobile }}"> {{ @$settings->mobile }} </a></li>
                            <li><i class="fa fa-envelope-o"></i> <a href="mailto:{{ @$settings->email }} "> {{ @$settings->email }} </a>  </li>
                            <li><i class="fa fa-globe"></i> <a href="{{ @$settings->url }} "> {{ @$settings->url }} </a>  </li>
                        </ul>             
                    </div> 
                </div>
                
                <div class="col-lg-6 col-md-12">
                    <div class="contact_message form">
                        <h3> {{ __('translate.GetInTouch') }} </h3>  
                        
                        
                        <!--<form id="contact-form" method="POST"  action="{{ route('storeContactMsg') }}">-->
                        

                        <form method="post" action="javascript:void(0)" id="sendContactMsg" enctype="multipart/form-data" class="form-horizontal" role="form">
                        
                            {{ csrf_field() }}
                            <p>  
                                <label> {{ __('translate.name') }} </label>
                                <input name="name" placeholder="{{ __('translate.name') }}" required type="text"> 
                            </p>
                            <p>       
                                <label> {{ __('translate.email') }} </label>
                                <input name="email" placeholder="{{ __('translate.email') }}" required type="email">
                            </p>
                            <p>          
                                <label> {{ __('translate.subject') }} </label>
                                <input name="subject" placeholder="{{ __('translate.subject') }}" required type="text">
                            </p>    
                            <div class="contact_textarea">
                                <label> {{ __('translate.message') }} </label>
                                <textarea placeholder="{{ __('translate.message') }}" required name="message"  class="form-control2" ></textarea>     
                            </div>   
                            <button type="submit"> {{ __('translate.send') }} </button>  
                            <p class="form-messege"></p>
                        </form> 
                    </div> 
                </div>
                
            </div>
        </div>    
    </div>
            
    <!--<div class="contact_map">-->
    <!--    <div class="container-fluid">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <div class="map-area">-->
    <!--                    <div id="googleMap" style="width:100%;height:460px;"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

@endsection


   
      

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdWLY_Y6FL7QGW5vcO3zajUEsrKfQPNzI"></script>
    <script  src="https://www.google.com/jsapi"></script>
    <script src="{{ url('frontend/assets/js/map.js') }}"></script>
@endsection


@section('js')
@endsection




