@extends('layout.adminLayout')


@section('title', __('translate.notifications'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Setting.notifications') }}">
            {{ __('translate.notifications') }}
        </a>
    </li>
@endsection



@section('css_file_upload')
    <link href="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css"/>
@endsection


@section('css')
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    
                    
                    
                    @if(isset($data->item))
                    {!! Form::model($data->item, ['route' => ['admin.Setting.updateNotifications', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.Setting.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">


                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('emails_cc', __('translate.emails_cc')) !!}
                            {!! Form::textarea('emails_cc', old('emails_cc', $data->item->emails_cc), ['class' => 'form-control']) !!}
                        </div>
                        
                        
                        
                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('title_'.$locale->code, __('translate.title_' . $locale->code ) ) !!}
                                {!! Form::text('title_'.$locale->code, old('title_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->notification_title:'' ), ['class' => 'form-control']) !!}
                            </div>
                        @endforeach 

                        
                        <div class="form-group col-sm-6" style="margin-bottom:13px;">
                            {!! Form::label('order_requested', __('translate.requested')) !!}
                            {!! Form::textarea('order_requested', old('order_requested', $data->item->order_requested), ['class' => 'form-control ckeditor']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6" style="margin-bottom:13px;">
                            {!! Form::label('order_driver_assigned', __('translate.driver_assigned')) !!}
                            {!! Form::textarea('order_driver_assigned', old('order_driver_assigned', $data->item->order_driver_assigned), ['class' => 'form-control ckeditor']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6" style="margin-bottom:13px;">
                            {!! Form::label('order_in_progress', __('translate.in_progress')) !!}
                            {!! Form::textarea('order_in_progress', old('order_in_progress', $data->item->order_in_progress), ['class' => 'form-control ckeditor']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6" style="margin-bottom:13px;">
                            {!! Form::label('order_done', __('translate.done')) !!}
                            {!! Form::textarea('order_done', old('order_done', $data->item->order_done), ['class' => 'form-control ckeditor']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6" style="margin-bottom:13px;">
                            {!! Form::label('order_cancelled', __('translate.cancelled')) !!}
                            {!! Form::textarea('order_cancelled', old('order_cancelled', $data->item->order_cancelled), ['class' => 'form-control ckeditor']) !!}
                        </div>
        
                        
                        <div class="form-group col-sm-12" style="margin-bottom:13px;">
                            <br>
                            {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.Setting.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
                        </div>
                 
                        
                    </div>
                    {!! Form::close() !!}
                    

                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js_file_upload')
    <script src="{{admin_assets('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
@endsection


@section('js')
@endsection


@section('script')
    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
        $('#edit_file').on('change', function (e) {
            readURL(this, $('#edit_file'));
        });
    </script>
@endsection
