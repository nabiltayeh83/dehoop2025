@extends('layout.adminLayout')


@section('title', __('translate.collections'))


@section('breadcrumb')
    <li>
        <a href="{{ route('admin.Collection.index') }}">
            {{ __('translate.collections') }}
        </a>
    </li>
@endsection



@section('css')
@endsection


@section('content')

    <div class="portlet light bordered">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="btn-group">


                            @if(has_permission('admin.Collection.create') == true)
                                <a href="{{ route('admin.Collection.create') }}" style="margin-right: 5px" class="btn btn-primary">
                                    {{ __('translate.add') }}
                                    <i class="fa fa-plus"></i>
                                </a>
                            @endif


                            @if(has_permission('admin.Collection.edit') == true)
                                {!! Form::button('<i class="fa fa-check"></i>' . __('translate.active'), ['class' => 'btn btn-success event', 'id'=>'active', 'data-action'=>'active', 'href'=>'#activation', 'role'=>'button', 'data-toggle'=>'modal']) !!}
                                {!! Form::button('<i class="fa fa-minus"></i>' . __('translate.not_active'), ['class' => 'btn btn-danger event', 'id'=>'not_active', 'data-action'=>'#not_active', 'href'=>'#not_active', 'role'=>'button', 'data-toggle'=>'modal']) !!}
                            @endif
                            
                            
                            @if(has_permission('admin.Collection.destroy') == true)
                                {!! Form::button('<i class="fa fa-times"></i>' . __('translate.delete'), ['class' => 'btn btn-warning event', 'id'=>'delete_all', 'data-action'=>'active', 'href'=>'#deleteAll', 'role'=>'button', 'data-toggle'=>'modal']) !!}
                            @endif    

                        </div>
                    </div>
                </div>
            </div>


            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
                <thead>
                    <tr>
                        <th>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" value="" id="checkboxall" name="client" class="chkBox checkboxes">
                                <span></span>
                            </label>
                        </th>
                        <th> {{ __('translate.image') }} </th>
                        <th> {{ __('translate.name') }} </th>
                        <th> {{ __('translate.status') }} </th>
                        <!--<th> Created At </th>-->
                        <th>  </th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($data->items as $one)
                    <tr class="odd gradeX" id="tr-{{$one->id}}">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes chkBox" value="{{$one->id}}" name="chkBox"/>
                                <span></span>
                            </label>
                        </td>
                        
                        <td> <img src="{{ @$one->image }}" style="max-width:60px;"> </td>
                        
                        <td> {{ @$one->name }} </td>

                        <td>
                            <span style="font-size: 12px;padding: 8px;" class="btn  {{ ($one->status == "active")? "btn-light-success" : "btn-light-danger"}}" id="label-{{$one->id}}">
                                {{ __('translate.'.$one->status) }}
                            </span>
                        </td>


                        <!--<td> {{ $one->created_at->format('D. m-Y') }} </td>-->

                        <td class="p-0">
                            <div class="btn-group btn-action">
                                @if(has_permission('admin.Collection.show') == true)
                                    <a href="{{ route('admin.Collection.show', $one->id) }}" class="btn btn-xs tooltips" data-container="body" data-placement="top" data-original-title="{{__('translate.view')}}">
                                        <i class="fa fa-eye text-success fs-2"></i>
                                    </a>
                                @endif

                                
                                @if(has_permission('admin.Collection.edit') == true)
                                    <a href="{{ route('admin.Collection.edit', $one->id) }}" class="btn btn-xs tooltips" data-container="body" data-placement="top" data-original-title="{{__('translate.edit')}}">
                                        <i class="fa fa-edit text-primary fs-2"></i>
                                    </a>
                                @endif
        

                                @if(has_permission('admin.Collection.destory') == true)
                                    <a data-id="{{$one->id}}" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="{{__('translate.delete')}}" class="btn btn-delete tooltips"> 
                                        <i class="fa fa-trash text-danger fs-2"></i>
                                    </a>
                                @endif                  
                  
                            </div>
                        </td>
                    </tr>
   
                @endforeach
                </tbody>
            </table>

            {{ $data->items->links() }}

        </div>
    </div>
@endsection


@section('js')
@endsection


@section('script')
@endsection
