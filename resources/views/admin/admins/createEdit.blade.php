@extends('layout.adminLayout')


@section('title', __('translate.admins'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.admins.index') }}">
            {{ __('translate.admins') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.admins.update', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.admins.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">
                        
                   
                        <div class="form-group col-sm-6">
                            {!! Form::label('first_name', __('translate.first_name')) !!}
                            {!! Form::text('first_name', old('first_name', @$data->item->first_name), ['class' => 'form-control', 'required' => 'true' ]) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('last_name', __('translate.last_name')) !!}
                            {!! Form::text('last_name', old('last_name', @$data->item->last_name), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('username', __('translate.username')) !!}
                            {!! Form::text('username', old('username', @$data->item->username), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('email', __('translate.email')) !!}
                            {!! Form::email('email', old('email', @$data->item->email), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('mobile', __('translate.mobile')) !!}
                            {!! Form::text('mobile', old('mobile', @$data->item->mobile), ['class' => 'form-control']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('address', __('translate.address')) !!}
                            {!! Form::text('address', old('address', @$data->item->address), ['class' => 'form-control']) !!}
                        </div>
                        
                        
                        @if(!isset($data->item))
                        <div class="form-group col-sm-6">
                            {!! Form::label('password', __('translate.password')) !!}
                            {!! Form::input('password', 'password', old('password'), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('confirm_password', __('translate.confirm_password')) !!}
                            {!! Form::input('password', 'confirm_password', old('confirm_password'), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        @endif
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('role_id', __('translate.permissions')) !!}
                            {!! Form::select('role_id', App\Models\Role::pluck('name','id'), old('role_id', @$data->item->role_id), ['class' => 'form-control']) !!}
                        </div>
                        

                        <div class="form-group col-sm-12">
                            <br>
                            {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
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
