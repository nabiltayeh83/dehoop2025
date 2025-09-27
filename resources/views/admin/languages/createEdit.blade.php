@extends('layout.adminLayout')


@section('title', __('translate.languages'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Language.index') }}">
            {{ __('translate.languages') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.Language.update', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.Language.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">

                        
                        <div class="form-group col-sm-6">
                                {!! Form::label('code', __('translate.code') ) !!}
                                {!! Form::text('code', old('code', isset($data->item)? $data->item->code:'' ), ['class' => 'form-control']) !!}
                        </div>
                       
                       
                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('name_'.$locale->code, __('translate.name'). ' ' .$locale->name ) !!}
                                {!! Form::text('name_'.$locale->code, old('name_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->name:'' ), ['class' => 'form-control']) !!}
                            </div>
                        @endforeach 
                        

                        <div class="form-group col-sm-12">
                            <br>
                            {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.Language.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
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
