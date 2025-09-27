@extends('layout.adminLayout')


@section('title', __('translate.settings'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Setting.index') }}">
            {{ __('translate.settings') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.Setting.update', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.Setting.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">
                    
                    
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.logo') }}
                        </div>
                        
                        <div class="form-group col-sm-12 row">
                            <div class="form-group col-sm-6">
                                <div class="fileinput-new thumbnail" onclick="document.getElementById('edit_image').click()" style="cursor:pointer">
                                    <img src="{{ @$data->item->logo? url($data->item->logo) : url('uploads/ChoosePhoto.png') }}" id="editImage" style="max-width: 300px;">
                                </div>
                                {!! Form::input('file', 'image', old('image', @$data->item->image), ['id' => 'edit_image', 'class' => 'form-control', 'style' => 'display:none', 'accept' => 'image/*' ]) !!}
                            </div>
                        </div>
                    
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.title') }}
                        </div>
                        
                        <div class="form-group col-sm-12 row"> 
                            @foreach($locales as $locale)
                                <div class="form-group col-sm-6">
                                    {!! Form::label('title_'.$locale->code, $locale->name ) !!}
                                    {!! Form::text('title_'.$locale->code, old('title_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->title:'' ), ['class' => 'form-control']) !!}
                                </div>
                            @endforeach 
                        </div>
                        
                        
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.description') }}
                        </div>
                        
                        <div class="form-group col-sm-12 row">
                            @foreach($locales as $locale)
                               <div class="form-group col-sm-6">
                                    {!! Form::label('description_'.$locale->code, $locale->name ) !!}
                                    {!! Form::textarea('description_'.$locale->code, old('description_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->description:'' ), ['class' => 'form-control', 'rows' => '4' ]) !!}
                                </div>
                            @endforeach 
                        </div>
                        
                        
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.keywords') }}
                        </div>
                        
                        <div class="form-group col-sm-12 row">
                            @foreach($locales as $locale)
                               <div class="form-group col-sm-6">
                                    {!! Form::label('keywords_'.$locale->code, $locale->name ) !!}
                                    {!! Form::textarea('keywords_'.$locale->code, old('keywords_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->keywords:'' ), ['class' => 'form-control', 'rows' => '4' ]) !!}
                                </div>
                            @endforeach 
                        </diV>
                        
                        
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.address') }}
                        </div>
                        
                        <div class="form-group col-sm-12 row">
                            @foreach($locales as $locale)
                               <div class="form-group col-sm-6">
                                    {!! Form::label('address_'.$locale->code, $locale->name ) !!}
                                    {!! Form::textarea('address_'.$locale->code, old('address_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->address:'' ), ['class' => 'form-control', 'rows' => '4' ]) !!}
                                </div>
                            @endforeach 
                        </div>
                        
                        
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.contact') }}
                        </div>
                        
                        
                        <div class="form-group col-sm-12 row">

                            <div class="form-group col-sm-6">
                                {!! Form::label('url', 'URL') !!}
                                {!! Form::url('url', old('url', $data->item->url), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('email', __('translate.email')) !!}
                                {!! Form::email('email', old('email', $data->item->email), ['class' => 'form-control']) !!}
                            </div>
                        
                            <div class="form-group col-sm-6">
                                {!! Form::label('mobile', __('translate.mobile')) !!}
                                {!! Form::text('mobile', old('mobile', $data->item->mobile), ['class' => 'form-control']) !!}
                            </div>
                        
                        
                            <div class="form-group col-sm-6">
                                {!! Form::label('tiktok', 'Tiktok') !!}
                                {!! Form::url('tiktok', old('tiktok', $data->item->tiktok), ['class' => 'form-control']) !!}
                            </div>
                            
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('instagram', 'Instagram') !!}
                                {!! Form::url('instagram', old('linked_in', $data->item->instagram), ['class' => 'form-control']) !!}
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group col-sm-12" style="background-color: #ccc; padding:10px; margin: 3px 0px 10px 0px;">
                            {{ __('translate.legal_information') }}
                        </div>
                        
                        
                        <div class="form-group col-sm-12 row">
                            <div class="form-group col-sm-6">
                                {!! Form::label('eur_comp_search', __('translate.eur_comp_search')  ) !!}
                                {!! Form::url('eur_comp_search', old('eur_comp_search', $data->item->eur_comp_search), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('lux_comp_number', __('translate.lux_comp_number')) !!}
                                {!! Form::text('lux_comp_number', old('lux_comp_number', $data->item->lux_comp_number), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('lux_comp_url', __('translate.lux_comp_url')  ) !!}
                                {!! Form::url('lux_comp_url', old('lux_comp_url', $data->item->lux_comp_url), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group col-sm-6">
                                {!! Form::label('vat_number', __('translate.vat_number')) !!}
                                {!! Form::text('vat_number', old('vat_number', $data->item->vat_number), ['class' => 'form-control']) !!}
                            </div>
                            
                             <div class="form-group col-sm-6">
                                {!! Form::label('vat_url', __('translate.vat_url')  ) !!}
                                {!! Form::url('vat_url', old('vat_url', $data->item->vat_url), ['class' => 'form-control']) !!}
                            </div>
                            
                        </div>
                        
  
                        
                        <div class="form-group col-sm-12">
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
