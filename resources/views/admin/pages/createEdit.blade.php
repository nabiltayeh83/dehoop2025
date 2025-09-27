@extends('layout.adminLayout')


@section('title', __('translate.pages'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Page.index') }}">
            {{ __('translate.pages') }}
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
                    {!! Form::model($data->item, ['route' => ['admin.Page.update', $data->item->id], 'method' => 'post','files' => true]) !!}
                    {{ method_field('PATCH')}}
                    @else
                        {!! Form::open(['route' => 'admin.Page.store','files' => true]) !!}
                    @endif
                    
                    <div class="form-body">


                        <div class="form-group col-sm-12 row" style="background-color: #ccc; padding:10px; margin-bottom: 5px;">
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
                        

                        <div class="form-group col-sm-12 row" style="background-color: #ccc; padding:10px; margin-bottom: 5px;">
                            {{ __('translate.details') }}
                        </div>


                        <div class="form-group col-sm-12 row">
                            @foreach($locales as $locale)
                               <div class="form-group col-sm-6">
                                    {!! Form::label('details_'.$locale->code, $locale->name  ) !!}
                                    {!! Form::textarea('details_'.$locale->code, old('details_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->details:'' ), ['class' => 'form-control', 'rows' => 5, 'required' => 'required' ]) !!}
                                </div>
                            @endforeach 
                        </div>
                 
                 
                       <!--<div class="form-group col-sm-12 row" style="background-color: #ccc; padding:10px; margin-bottom: 5px;">-->
                       <!--     {{ __('translate.keywords') }}-->
                       <!-- </div>-->
                       <!-- <div class="form-group col-sm-12 row">-->
                       <!--     @foreach($locales as $locale)-->
                       <!--        <div class="form-group col-sm-6">-->
                       <!--             {!! Form::label('keywords_'.$locale->code, $locale->name ) !!}-->
                       <!--             {!! Form::textarea('keywords_'.$locale->code, old('keywords_'.$locale->code, isset($data->item)?$data->item->translate($locale->code)->keywords:'' ), ['class' => 'form-control', 'rows' => 5, 'required' => 'required' ]) !!}-->
                       <!--         </div>-->
                       <!--     @endforeach -->
                       <!-- </div>-->
                  

   
                        
                        <!--<div class="form-group col-sm-6">-->
                        <!--    {!! Form::label('edit_image', __('translate.image')) !!}-->
                        <!--    <div class="fileinput-new thumbnail" onclick="document.getElementById('edit_image').click()" style="cursor:pointer">-->
                        <!--        <img src="{{ @$data->item->image? url($data->item->image) : url('uploads/ChoosePhoto.png') }}" id="editImage" style="max-width: 400px;">-->
                        <!--    </div>-->
                        <!--    {!! Form::input('file', 'image', old('image', @$data->item->image), ['id' => 'edit_image', 'class' => 'form-control', 'style' => 'display:none', 'accept' => 'image/*' ]) !!}-->
                        <!--</div>-->
                 

                        <div class="form-group col-sm-12">
                            <br>
                            {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.Page.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
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
