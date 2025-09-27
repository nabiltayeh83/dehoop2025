@extends('layout.adminLayout')


@section('title',  __('translate.users'))

@section('breadcrumb')
    <li>
        <a href="{{ route('admin.admins.index') }}">
            {{  __('translate.admins') }}
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
                    
    
                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.first_name') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->first_name }} </div>
                        </div>
                    </fieldset>
                    

                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.last_name') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->last_name }} </div>
                        </div>
                    </fieldset>


                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.username') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->username }} </div>
                        </div>
                    </fieldset>


                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.email') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->email }} </div>
                        </div>
                    </fieldset>
                    

                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.mobile') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->mobile }} </div>
                        </div>
                    </fieldset>
                    

                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.address') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->address }} </div>
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
