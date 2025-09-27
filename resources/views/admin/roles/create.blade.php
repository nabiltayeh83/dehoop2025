@extends('layout.adminLayout')


@section('title',  __('translate.permissions'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Role.index') }}">
            {{ __('translate.permissions') }}
        </a>
    </li>
@endsection


@section('css')
@endsection


@section('content')

    <form method="post" action="{{ route('admin.Role.store') }}"enctype="multipart/form-data" class="form-horizontal" role="form" id="form_city">
    {{ csrf_field() }}
        <div class="form-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">
                    {{ __('translate.name') }} <span class="symbol">*</span>
                </label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="{{ __('translate.name') }}" id="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <hr>

            @isset($data->permissions)
                @foreach($data->permissions->where('parent_id', 0) as $one)
                    <div class="form-group">
                            
                        <div class="col-md-12" style="padding:5px; margin-bottom: 10px; background-color: #ccc;">
                                
                            <label class="col-sm-2 control-label" for="{{ $one->id }}" style="padding:5px;">
                                    <b> {{ __('translate.'.$one->name) }} </b>
                            </label>
                                
                            @if(count($one->childs) > 0)
                            @foreach($one->childs as $one)
                                <div class="form-group">
                                    <div class="col-md-12" style="padding:5px; margin-bottom: 5px; background-color: #fff;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <input type="checkbox" name="permissions[]" id="{{ $one->id }}" value="{{ $one->id }}">
                                        <label class="col-sm-2 control-label" for="{{ $one->id }}">
                                            {{ __('translate.'.$one->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endisset
            

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-primary">{{ __('translate.submit') }}</button>
                        <a href="{{ route('admin.Role.index') }}" class="btn btn-warning">
                            {{ __('translate.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection


@section('js')
@endsection


@section('script')
@endsection

