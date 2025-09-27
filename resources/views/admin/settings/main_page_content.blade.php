@extends('layout.adminLayout')


@section('title', __('translate.notifications'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Setting.main_page_content') }}">
            {{ __('translate.main_page_content') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.Setting.updateMainPageContent', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.Setting.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">


                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('about_us_title_'.$locale->code, __('translate.about_us_title_' . $locale->code ) ) !!}
                                {!! Form::text('about_us_title_'.$locale->code, old('about_us_title_'.$locale->code, isset($data->item)?
                                $data->item->translate($locale->code)->about_us_title:'' ), ['class' => 'form-control']) !!}
                            </div>
                        @endforeach 

     
                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('about_us_details_'.$locale->code, __('translate.about_us_details_' . $locale->code) ) !!}
                                {!! Form::textarea('about_us_details_'.$locale->code, old('about_us_details_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->about_us_details:'' ), ['class' => 'form-control', 'rows' => '4' ]) !!}
                            </div>
                        @endforeach      
                        
     
                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('why_us_title_'.$locale->code, __('translate.why_us_title_' . $locale->code ) ) !!}
                                {!! Form::text('why_us_title_'.$locale->code, old('why_us_title_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->why_us_title:'' ), ['class' => 'form-control']) !!}
                            </div>
                        @endforeach 
     
                        
                        @foreach($locales as $locale)
                           <div class="form-group col-sm-6">
                                {!! Form::label('why_us_details_'.$locale->code, __('translate.why_us_details_' . $locale->code) ) !!}
                                {!! Form::textarea('why_us_details_'.$locale->code, old('why_us_details_'.$locale->code, 
                                isset($data->item)?$data->item->translate($locale->code)->why_us_details:'' ), ['class' => 'form-control', 'rows' => '4' ]) !!}
                            </div>
                        @endforeach      
     
        
                        
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
