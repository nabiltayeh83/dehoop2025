
    <div class="layout-4" >
        <div class="layout-4-item-right">
            <div class="box-custom-2 bg-accent" style="padding-bottom: 0;">
                <div class="box-custom-2-bg {{ app()->getLocale() == 'ar'? 'box-custom-3-bg':''}}">
                    <div class="box-custom-2-bg-inner">
                        <div class="box-custom-2-bg-image" style="background-image: url({{ url('frontend/images/index-2-1397x1397.png') }});"></div>
                    </div>
                </div>
                <div class="box-custom-2-inner">
                    <h2 class="wow fadeIn">     
                        {{ __('translate.getTaxiNow') }} 
                        
                        {{ now()->addHours(2)->format('H:i') }}
                        
                    </h2>
                    <div class="contacts-default">
                        <div class="unit align-items-center">
                            <div class="unit-left">
                                <div class="contacts-default-icon mdi mdi-phone-incoming"></div>
                            </div>
                            <div class="unit-body"><a class="contacts-default-link" href="tel:{{ @$settings->mobile }}"> {{ @$settings->mobile }} </a></div>
                        </div>
                    </div>
                    
                    <!--<form method="post" action="{{ route('bookingTaxi') }}" enctype="multipart/form-data" class="form-horizontal" role="form" id="form_city">-->
                    <form method="post" action="javascript:void(0)" id="bookingTaxiNow" enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                        
                        
                        <div class="row  mt-20 ">
                            <div class="col form-wrap">
                                *<input class="form-input" id="date" type="date" name="date"  min="{{ date('Y-m-d') }}" required>
                            </div>                        
                        
                            <div class="col form-wrap mt-0">
                                *<input class="form-input" id="time" type="time" name="time" min="{{ date('h-i') }}" required>
                            </div>   
                        </div>                     
                        
                        
                        <div class="row  mt-20 ">
                            <div class="col form-wrap">
                                <input class="form-input" id="persons_count" type="number" name="persons_count"  min="0" required>
                                *<label class="form-label" for="persons_count"> {{ __('translate.persons_count') }} </label><span class=""></span>
                            </div> 
                            
                            <div class="col form-wrap mt-0">
                                <input class="form-input" id="bags_count" type="number" name="bags_count" min="0">
                                <label class="form-label" for="bags_count"> {{ __('translate.bags_count') }} </label><span class=""></span>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row  mt-20 ">
                            <div class="col form-wrap">
                                <input class="form-input" id="baby_seat" type="number" name="baby_seat" min="0">
                                <label class="form-label" for="baby_seat"> {{ __('translate.baby_seat') }} </label><span class=""></span>
                            </div> 
                            
                            <div class="col form-wrap mt-0">
                                <input class="form-input" id="child_seat" type="number" name="child_seat" min="0">
                                <label class="form-label" for="child_seat"> {{ __('translate.child_seat') }} </label><span class=""></span>
                            </div>
                            
                            <div class="col form-wrap mt-0">
                                <input class="form-input" id="pet" type="number" name="pet" min="0">
                                <label class="form-label" for="pet"> {{ __('translate.pet') }} </label><span class=""></span>
                            </div>
                            
                            
                        </div>
                        
                        
                        <div class="row  mt-20 ">
                            <div class="col form-wrap carsTypesClass">
                                *<select class="form-input select button-shadow" id="car_type_id" name="car_type_id" required data-minimum-results-for-search="Infinity"  data-placeholder="{{ __('translate.cars_types') }}">
                                    <option label="{{ __('translate.cars_types') }}"></option>
                                    @foreach(App\Models\CarType::where('status', 'active')->get() as $one)
                                        <option value="{{ @$one->id }}"> {{ @$one->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="row  mt-20 ">
                            <div class="form-wrap col fromAirportSwitch">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" checked class="custom-control-input fromAirport" id="customSwitch1" name="from_airport" value="yes">
                                    <label class="custom-control-label" for="customSwitch1"> {{ __('translate.from_airport') }} </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row  mt-20 ">
                            <div class="form-wrap col airportsClass">
                                *<select class="form-input select button-shadow" id="airport_id" required name="airport_id" data-minimum-results-for-search="Infinity" data-placeholder="{{ __('translate.airports') }}">
                                    <option label="{{ __('translate.airports') }}"></option>
                                    @foreach(App\Models\Airport::where(['status' => 'active', 'work_status' => 'active'])->get() as $one)
                                        <option value="{{ @$one->id }}"> {{ @$one->name }} </option>
                                    @endforeach
                                </select>                    
                            </div>
                        </div>
                        
                        <div class="row  mt-20 ">
                            <div class="form-wrap col toClass">
                                <label> {{ __('translate.to') }} </label>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row mt-20 customerDataClass">
                            <div class="col form-wrap">
                                *<input class="form-input" id="fullname" type="text" name="name" required>
                                <label class="form-label" for="fullname"> {{ __('translate.name') }} </label><span class=""></span>
                            </div>
                        </div>
                        
                        
                           
                            <div class="row mt-20">
                                <div class="col-8 form-wrap">
                                    *<input class="form-input" id="email" type="email" name="email" required>
                                    <label class="form-label" for="email"> {{ __('translate.email') }} </label><span class=""></span>
                                </div>
                                <div class="col form-wrap mt-0">
                                    *<select class="form-input select button-shadow" name="country_id" id="country_id" required data-minimum-results-for-search="Infinity"  data-placeholder="{{ __('translate.country') }}">
                                        <option label="{{ __('translate.country') }}"></option>
                                        @foreach(App\Models\Country::where(['status' => 'active'])->get() as $one)
                                            <option value="{{ @$one->id }}" data-id="{{ @$one->code }}"> {{ @$one->name }} </option>
                                        @endforeach
                                    </select>                    
                                </div>
                                
                            </div>
                            
                            <!-----======================================================================------------>
                                @include('website.googleAutoAddress')
                            <!--=================================================================================================-->
                            
                                                     
                            
                            <div class="row mt-20">        
                                <div class="form-wrap col">
                                    <input class="form-input" id="phone" type="number" name="phone" min="0" pattern="[0-9]*" required>
                                    <label class="form-label" for="phone"> {{ __('translate.phone') }} </label><span class=""></span>
                                </div>
                            </div>
                        
                        
                            <div class="row mt-20 orderPriceDiv" style="display:none;">        
                                <div class="form-wrap col">
                                    <label class="form-label"></label>
                                        <span class="" style="margin: 0px 10px 0px 30px;">
                                            {{ __('translate.price') }}: <span class="orderPriceValue"> </span>
                                        </span>
                                </div>
                            </div>
                            
                            
                            <div class="row mt-20 orderErrorDiv" style="display:none;">
                                <div class="form-wrap col">
                                    <label class="form-label"></label>
                                        <span class="" style="margin: 0px 10px 0px 30px;">
                                            <span class="orderErrorMsg"> </span>
                                        </span>
                                </div>
                            </div>
                  
                            
                  
                            <div class="form-wrap-2 mt-20">
                                
                                <button class="button button-block button-secondary button-winona newOrderSubmitButton"  type="submit" style="margin: 0 auto; width: 30%; display:none;"> 
                                    {{ __('translate.orderNow') }} 
                                </button>
                                
                                <button onclick="calculateCost()" class="button button-block button-primary button-winona" type="button" 
                                style="margin: 0 auto; width: 30%;"> 
                                    {{ __('translate.CalculateCost') }}
                                </button>
                            </div>
                        
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="layout-4-item-left"><img src="{{ url('frontend/images/idnex-1-747x597.png') }}" alt="" width="747" height="597"/></div>
    </div>
    
