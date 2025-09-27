@extends('layout.adminLayout')


@section('title', __('translate.admins'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.admins.index') }}">
            {{ __('translate.admins') }}
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
                    
                    {!! Form::model($data->item, ['route' => ['admin.admins.edit_password', $data->item->id], 'method' => 'post','files' => true]) !!}
                    <div class="form-body">

                        <div class="form-group col-sm-6">
                            {!! Form::label('old_password', __('translate.old_password')) !!}
                            {!! Form::input('password', 'old_password', old('old_password'), ['class' => 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('password', __('translate.new_password')) !!}
                            {!! Form::input('password', 'password', old('password'), ['class' => 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('confirm_password', __('translate.confirm_password')) !!}
                            {!! Form::input('password', 'confirm_password', old('confirm_password'), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-12">
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


@section('js')
@endsection


@section('script')

    <script>
        $('#edit_image').on('change', function (e) {
            readURL(this, $('#editImage'));
        });
    </script>

@endsection

