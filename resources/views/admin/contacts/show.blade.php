@extends('layout.adminLayout')


@section('title',  __('translate.contacts'))

@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Contact.index') }}">
            {{  __('translate.contacts') }}
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
                                <label class="col-sm-3 control-label"> <b> {{ __('translate.name') }} </b> </label>
                                <div class="col-md-9"> {{ @$data->item->name }} </div>
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
                                    <label class="col-sm-3 control-label"> <b> {{ __('translate.subject') }} </b> </label>
                                    <div class="col-md-9"> {{ @$data->item->subject }} </div>
                                </div>
                            </fieldset>



                    <fieldset style="padding: 10px; border-bottom: 1px dotted #ccc;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> <b> {{ __('translate.message') }} </b> </label>
                            <div class="col-md-9"> {{ @$data->item->message }} </div>
                        </div>
                    </fieldset>
                    
                    <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                
                                
                                
                                @if(@$data->item->replay == 0 && $data->item->user_id != null)
                                    {!! Form::open(['route' => 'admin.Contact.replayMessage','files' => true]) !!}
                                
                                
                                <div class="form-body">
                    
                    
                                    
                    
                                       <div class="form-group col-sm-6">
                                            {!! Form::label('replay', __('translate.replay')) !!}
                                            {!! Form::textarea('replay', old('replay'), ['class' => 'form-control', 'rows' => 5, 'required' => 'true']) !!}
                                            
                                            
                                            {!! Form::hidden('contact_id',$data->item->id, old('contact_id'), ['class' => 'form-control', 'rows' => 5 ]) !!}
                                            {!! Form::hidden('user_id', $data->item->user_id,old('user_id'), ['class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                    <div class="form-group col-sm-12">
                                        <br>
                                        {!! Form::submit(__('translate.submit'), ['class' => 'btn btn-primary']) !!}
                                        <a href="{{ route('admin.Contact.index') }}" class="btn btn-warning">{{ __('translate.cancel') }}</a>
                                    </div>
                                    
                                </div>
                                {!! Form::close() !!}
                                @endif
                                
                    
                                
                                
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    
                    


                </div>
            </div>
        </div>
    </div>

@endsection



@section('js')
@endsection



@section('script')
@endsection
