@extends('layout.adminLayout')


@section('title', __('translate.collections'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Collection.index') }}">
            {{ __('translate.collections') }}
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
                            <div class="col-md-9"> <b> {{ __('translate.name') }} </b><br> {{ @$data->item->name }} </div>
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
