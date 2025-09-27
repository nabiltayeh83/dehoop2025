@extends('layout.adminLayout')



@section('title', __('translate.users'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.User.index') }}">
            {{ __('translate.users') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.User.update', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.User.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">
                        

                   
                        <div class="form-group col-sm-6">
                            {!! Form::label('name', __('translate.name')) !!}
                            {!! Form::text('name', old('name', @$data->item->name), ['class' => 'form-control', 'required' => 'true' ]) !!}
                        </div>
                        

                        
                        
                       <div class="form-group col-sm-6">
                        {!! Form::label('branch_id', __('translate.branch')) !!}
                        @php
                            $branches = App\Models\Branch::active()->orderBy('ordered', 'asc')->get();
                        @endphp
                        
                        <select class="form-control select " name="branch_id" id="branch_id" required>
                            <option value="" selected> {{ __('translate.choose') }} </option>
                            @foreach($branches as $one)
                                <option value="{{ @$one->id }}"{{ @$data->item->branch_id == $one->id?'selected':'' }}>
                                    {{ @$one->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                    
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('email', __('translate.email')) !!}
                            {!! Form::email('email', old('email', @$data->item->email), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('mobile', __('translate.mobile')) !!}
                            {!! Form::text('mobile', old('mobile', @$data->item->mobile), ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>
                        
                        
                        <div class="form-group col-sm-6">
                            {!! Form::label('governorate', __('translate.governorate')) !!}
                            @php $governorates = App\Models\Governorate::active()->get(); @endphp
                            <select class="form-control" name="governorate_id" id="governorate">
                                <option value="">{{ __('translate.choose') }}</option>
                            @foreach( $governorates as $one )
                                <option value="{{ $one->id }}"{{ @$one->id == @$data->item->governorate_id?'selected':'' }}>{{ $one->name }}</option>
                            @endforeach
                            </select>
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
                            {!! Form::label('edit_image', __('translate.image')) !!}
                            <div class="fileinput-new thumbnail" onclick="document.getElementById('edit_image').click()" style="cursor:pointer">
                                <img src="{{ @$data->item->image? url($data->item->image) : url('uploads/ChoosePhoto.png') }}" id="editImage" style="max-width: 400px;">
                            </div>
                            {!! Form::input('file', 'image', old('image', @$data->item->image), ['id' => 'edit_image', 'class' => 'form-control', 'style' => 'display:none', 'accept' => 'image/*' ]) !!}
                        </div>
                        

                        <div class="form-group col-sm-12">
                            <br>
                            {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.User.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
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
@endsection
