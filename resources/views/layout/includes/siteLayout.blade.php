<!DOCTYPE html>
<html class="wide wow-animation" lang="{{ app()->getLocale() == 'ar'? 'ar': 'en'}}" dir="{{ app()->getLocale() == 'ar'? 'rtl': 'ltr' }}"> 

    <head>
        
        <title> {{ @$settings->title }} @yield('title') </title>
        <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="{{ $settings->logo }}" type="image/x-icon">
        <!--<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700">-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal">
          
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
           
            <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" integrity="sha512-LT9fy1J8pE4Cy6ijbg96UkExgOjCqcxAC7xsnv+mLJxSvftGVmmc236jlPTZXPcBRQcVOWoK1IJhb1dAjtb4lQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->


        @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
        @else
        <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.css') }}">
        @endif
        <link rel="stylesheet" href="{{ url('frontend/css/fonts.css') }}">
        <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="{{ url('frontend/css/datepicker.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="sha512-E4kKreeYBpruCG4YNe4A/jIj3ZoPdpWhWgj9qwrr19ui84pU5gvNafQZKyghqpFIHHE4ELK7L9bqAv7wfIXULQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
        <meta name="description" content="{{ @$settings->description }}">
        <meta name="keywords" content="{{ @$settings->keywords }}">

   
        @yield('style')
        

        
    
    </head>
  
    <body>
        <div class="ie-panel">
            <a href="http://windows.microsoft.com/en-US/internet-explorer/">
                <img src="{{ url('frontend/images/ie8-panel/warning_bar_0000_us.jpg') }}" height="42" width="820" alt="{{ @$settings->title }}">
            </a>
        </div>
        <div class="preloader" id="loading">
            <div class="preloader-body">
                <div id="loading-center-object">
                    <div class="object" id="object_four"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_one"></div>
                </div>
            </div>
        </div>
        
        <div class="page">

            @include('layout.includes.siteHeader')
    
            @yield('content')

            @include('layout.includes.siteFooter')
            
            
            
            <div class="modal" id="myModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Order Price</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                  </div>
                  <div class="modal-body">
                    <p>Your Order Price is : <span id="order-price"></span></p>
                    
                  </div>
                  <!--<div class="modal-footer">-->
                  <!--  <button type="button" class="btn btn-secondary close-modal" >Close</button>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
            
            
            <div class="modal" id="myModal1" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> {{ __('translate.alert') }} </h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                  </div>
                  <div class="modal-body">
                    <p> {{ __('translate.reservationAfterTwoHours') }} {{ @$settings->order_hours }} {{ __('translate.reservationAfterTwoHours1') }} </p>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal" id="myModal2" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> {{ __('translate.alert') }} </h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                  </div>
                  <div class="modal-body">
                    <p> {{ __('translate.wrongCountry') }} </p>
                    
                  </div>
                </div>
              </div>
            </div>

            
     
        </div>
    
        <div class="snackbars" id="form-output-global"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/fontawesome.min.js" integrity="sha512-c41hNYfKMuxafVVmh5X3N/8DiGFFAV/tU2oeNk+upk/dfDAdcbx5FrjFOkFhe4MOLaKlujjkyR4Yn7vImrXjzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ url('frontend/js/core.min.js') }}"></script>
        <script src="{{ url('frontend/js/script.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ url('frontend/js/bootstrap-datepicker.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js" integrity="sha512-hcV6DX35BKgiTiWYrJgPbu3FxS6CsCjKgmrsPRpUPkXWbvPiKxvSVSdhWX0yXcPctOI2FJ4WP6N1zH+17B/sAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ url('frontend/js/timepicker-bs4.js') }}"></script>
        
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->





  <script>
        // {{ date('Y-m-d') }}
        var lang = "{{ app()->getLocale() }}";
        
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: lang,
            startDate: "{{ date('Y-m-d') }}"
        })

        $('.next i').removeClass();
        $('.next i').addClass("fa-solid fa-arrow-right");

        jQuery('#timepicker').timepicker();
        $('.cancel-btn').css('display', 'none');

            //  $("#timepicker").timepicker();

// $('#datepicker').datepicker('setStartDate', '05/20/2023');

        // $("#timepicker").flatpickr({
        //     enableTime: true,
        //     noCalendar: true,
        //     dateFormat: "H:i",
        // });

        </script>

  
        @yield('script')
 

    
    
        <script>


        $(document).on('change','#car_type_id',function(e){
            var seats = $(this).find(':selected').data('id');
            $('#persons_count').attr('max', seats);
        });
         

        
        $(document).on('click','#otherDataLink',function(e){
            e.preventDefault()
            $('.otherData').show(1000);
            $('.passengersDetails').hide(1000);
        });
         
        
        $(document).on('click','#passengersDetailsLink',function(e){
            e.preventDefault()
            $('.passengersDetails').show(1000);
            $('.otherData').hide(1000);
        });
        
         
         $(document).on('click','#changeUpDown',function(e){
              e.preventDefault()
               
            if($('input[name="from_airport"]').is(':checked')){
                // alert('checked')
                $('input[name="from_airport"]').prop('checked', false); // Checks it
                
                $(".customerDataClass").insertBefore($(".toClass"));
                $(".airportsClass").insertAfter($(".toClass"));
                
                
              
            }
            else{
                // alert('unckeck')
                $('input[name="from_airport"]').prop('checked', true);
                $(".airportsClass").insertBefore($(".toClass"));
                $(".customerDataClass").insertAfter($(".toClass"));
                
                // $(".airportsClass").insertAfter($(".fromAirportSwitch"));
                // $(".toClass").insertAfter($(".airportsClass"));
            }
        
        
            });
         
   
            $(document).on('change','#autocomplete',function(e){
                $('.orderPriceDiv').hide(1000);
                $('.newOrderSubmitButton').hide(1000);
                $('.orderPriceValue').html(null);
                $('#order_cost').val(null);
                $('#latitude').val(null);
                $('#longitude').val(null);
                return false;
            });
            
            $(document).on('change','#car_type_id',function(e){
                $('.orderPriceDiv').hide(1000);
                $('.newOrderSubmitButton').hide(1000);
                $('.orderPriceValue').html(null);
                $('#order_cost').val(null);
                return false;
            });
       
            $(document).on('change','#airport_id',function(e){
                $('.orderPriceDiv').hide(1000);
                $('.newOrderSubmitButton').hide(1000);
                $('.orderPriceValue').html(null);
                $('#order_cost').val(null);
                return false;
            });
       
       
       
   
            function calculateCost(){
                
                
                // var country_id = $('#country_id').val();
                // var country = $('#country').val();
                // alert(country);
                
                var autocomplete = $('#autocomplete').val();
                var car_type_id = $('#car_type_id').val();
                var airport_id = $('#airport_id').val();
                var country_id = $('#country_id').val();
                

                var customer_latitude = $('#latitude').val();
                var customer_longitude = $('#longitude').val();
                var airport_lat = $('#airport_lat').val();
                var airport_lng = $('#airport_lng').val();
            
                if(!car_type_id){
                    swal(" {{ __('translate.pleaseEnterCarType') }}");
                    // $('.orderErrorDiv').show(1000);
                    // $('.orderErrorMsg').html("{{ __('translate.pleaseEnterRequiredFields') }}");
                    return false;
                }
                
                if(!airport_id){
                    swal(" {{ __('translate.pleaseEnterAirport') }}");
                    // $('.orderErrorDiv').show(1000);
                    // $('.orderErrorMsg').html("{{ __('translate.pleaseEnterRequiredFields') }}");
                    return false;
                }
                
                if(!country_id){
                    swal(" {{ __('translate.pleaseEnterCountry') }}");
                    // $('.orderErrorDiv').show(1000);
                    // $('.orderErrorMsg').html("{{ __('translate.pleaseEnterRequiredFields') }}");
                    return false;
                }
                
                if(!autocomplete){
                    swal(" {{ __('translate.pleaseEnterStreetAndHouseNumber') }}");
                    // $('.orderErrorDiv').show(1000);
                    // $('.orderErrorMsg').html("{{ __('translate.pleaseEnterStreetAndHouseNumber') }}");
                    return false;
                }
                
                 var input = document.getElementById('autocomplete');
                 
                if(containsNumbers(input.value) == false){
                    
                    // $('#autocomplete').css("border", "3px solid red");
                    // $('.orderErrorDiv').show(1000);
                    swal(" {{ __('translate.pleaseEnterStreetAndHouseNumber') }}");
                    // $('.orderErrorMsg').html("{{ __('translate.pleaseEnterStreetAndHouseNumber') }}");
                    return false;
                }
                
            
                var url = "{{ url('/getOrderCost/') }}";

                if(autocomplete && car_type_id && customer_latitude && customer_longitude && airport_lat && airport_lng){
                    $.ajax({
                        type: "GET",
                        url: url+'/'+car_type_id+'/'+customer_latitude+'/'+customer_longitude+'/'+airport_lat+'/'+airport_lng,
            
                        success: function (response) {
                            if(response)
                            {
                                // $('#order_cost').attr('value', response);
                                $('#order_cost').val(response);

                                $('.orderErrorDiv').hide(1000);
                                $('.orderPriceDiv').show(1000);
                                $('.orderPriceValue').html(response);
                                $('.newOrderSubmitButton').show(1000);
                                // $('#order-price').html(response);
                                // $('#myModal').modal('show'); 
                            }
                        }
                    });
                }
                else{
                    // $('#order_cost').attr('value', null)
                    $('.orderPriceDiv').hide(1000);
                    $('.orderPriceValue').html();
                    $('.newOrderSubmitButton').hide(1000);
                }
                $('.orderPriceDiv').hide(1000);
                $('.orderPriceValue').html(); 
                $('.newOrderSubmitButton').hide(1000);
            }
        
        
        
        
        //   $("#close-modal").click(function(){
            //   var modal = document.getElementById("myModal");
            //     var btn = document.getElementsByClassName("close-modal");
            //     btn.onclick = function() {
            //       modal.style.display = "none";
            //     }
            //   $('#myModal').css('display', 'none');
            // });
        
        
        
        
         $('.newOrderSubmitButton').click(function() {
              $('.passengersDetails').show(1000);
        });
    
    
    
    
    
        $(document).on('change','#country_id',function(e){
            var country_id = $(this).val();

            var url = "{{ url('/getCities/') }}";
        
        
              if(country_id){
                $.ajax({
                  type: "GET",
                  url: url+'/'+country_id,
                  success: function (response) {
                      if(response)
                      {    
                        $(".city").empty();
                        $.each(response, function(index, value){
                          $(".city").append('<option value="'+value.id+'">'+ value.name +'</option>');
                        });
                      }
                  }
                });
              }
              else{
                $(".city").empty();
              }
        });
        
        
        // $(document).on('change','.fromAirport',function(e){
         
        //   if($('input[name="from_airport"]').is(':checked'))
        //     {
        //         // $(".airportsClass").show('1000');
        //         // $(".toClass").show('1000');
        //         // $( ".toClass" ).after( $(".customerDataClass") );
        //         $(".airportsClass").insertAfter($(".fromAirportSwitch"));
        //         $(".toClass").insertAfter($(".airportsClass"));

        //     }else
        //     {
        //         // $(".airportsClass").hide('1000');
        //         // $(".toClass").hide('1000');
        //         $(".customerDataClass").insertBefore($(".toClass"));
        //         $(".airportsClass").insertAfter($(".toClass"));
        //     }
            
        // });
        
        
        $(document).on('submit','#bookingTaxiNow',function(e){
    
                
                var date = $('#datepicker').val();
                var time = $('#timepicker').val();
                
                var dateNow = "{{ date('Y-m-d') }}";
                var timeNow = "{{ now()->addHours($settings->order_hours)->format('H:i') }}";
                

                var dt1 = new Date("{{ date('Y-m-d') }}" + ", " + time);
                var dt2 = new Date("{{ date('Y-m-d') }}" + ", " + timeNow);
                var diffMs = (dt1 - dt2) / (1000*60*60);

                alert('fffff');

                 
                if(dateNow == date && diffMs < 2){
                      $('#myModal1').modal('show'); 
                    return false;
                }
    
                var short_code = $('#short_code').val();
                
                var countryCode = $('#country_id').find(':selected').data('id');
                var countryCodeUpper = countryCode.toUpperCase();
                
                if(short_code != countryCodeUpper){
                    $('#myModal2').modal('show'); 
                    return false;
                }

                

                var token = $("input[name = _token]").val();
                var formData = new FormData(this);

                $.ajax({
                url: "{{ route('bookingTaxi')}}",
                type: "POST",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
    
                success: function (response) {
                    if(response)
                    {    
                        if(response['id']){
                            $("#bookingTaxiNow").trigger("reset");
                            // swal(" {{ __('translate.thankYou') }} ", " {{ __('translate.YourRequestBooked') }} ", "success");                            
                            swal(" {{ __('translate.YourRequestBooked') }} ");                            
                        }
                        else{
                            // swal(" {{ __('translate.alert') }} ", " {{ __('translate.orderAlreadyBooked') }} ", "success");                            
                            swal(" {{ __('translate.orderAlreadyBooked') }} ");                            
                        }
                        

                    }
                    
                    // swal(" {{ __('translate.alert') }} ", " {{ __('translate.orderAlreadyBooked') }} ", "success"); 
                    // swal(" {{ __('translate.orderAlreadyBooked') }} "); 
                }
            });


            // swal(" {{ __('translate.thankYou') }} ", " {{ __('translate.YourRequestBooked') }} ", "success");

            return false;

        });
        
    </script>
    
    
    
    
    @yield('js')

 
        
  </body>
  
 
  
</html>