@extends('layout.adminLayout')


@section('title', __('translate.Sliders'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Slider.index') }}">
            {{ __('translate.sliders') }}
        </a>
    </li>
@endsection


@section('css')
@endsection


@section('content')
    <div class="row">
        
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-body form">

                    
                    <fieldset style="padding: 10px; border-bottom:1px dotted #ccc;">
                        <div class="form-group">
                            <div class="col-md-9"> <b> {{ __('translate.guiding_title1') }} </b><br> {{ @$data->item->guiding_title1 }} </div>
                        </div>
                    </fieldset>
                    
                    
                    <fieldset style="padding: 10px; border-bottom:1px dotted #ccc;">
                        <div class="form-group">
                            <div class="col-md-9"> <b> {{ __('translate.guiding_title2') }} </b><br> {{ @$data->item->guiding_title2 }} </div>
                        </div>
                    </fieldset>

                    <fieldset style="padding: 10px; border-bottom:1px dotted #ccc;">
                        <div class="form-group">
                            <div class="col-md-9"> <b> {{ __('translate.title') }} </b><br> {{ @$data->item->title }} </div>
                        </div>
                    </fieldset>
                    
        
                    <fieldset style="padding: 10px; border-bottom:1px dotted #ccc;">
                        <div class="form-group">
                            <div class="col-md-9"> <b> {{ __('translate.details') }} </b><br> {!! @$data->item->details !!} </div>
                        </div>
                    </fieldset>
                    



                    @if(isset($data->item->image))
                    <fieldset style="padding: 10px; border-bottom:1px dotted #ccc;">
                        <div class="form-group">
                            <div class="col-md-9"> <img src="{{ @$data->item->image }}" style="max-width: 400px;"> </div>
                        </div>
                    </fieldset>
                    @endif
                    


                    
                    
            

                </div>
            </div>
        </div>
    </div>

@endsection



@section('js')


@endsection



@section('script')
@endsection
