@extends('layout.adminLayout')


@section('title', __('translate.languages'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Language.index') }}">
            {{ __('translate.languages') }}
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
                            <div class="col-md-9"> <b> {{ __('translate.code') }} </b><br> {{ @$data->item->code }} </div>
                        </div>
                    </fieldset>
                    

                </div>
            </div>
        </div>
    </div>

@endsection



@section('js')


@endsection



@section('script')
@endsection
