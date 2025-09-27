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

    <div class="table-toolbar">
        
        <div class="row">
            <div class="col-sm-9">
                <div class="btn-group">

                    {!! Form::button('<i class="fa fa-times"></i>' . __('translate.delete'), ['class' => 'btn btn-warning event', 'id'=>'delete_all', 'data-action'=>'active', 'href'=>'#deleteAll', 'role'=>'button', 'data-toggle'=>'modal']) !!}

                </div>
            </div>
        </div>
    </div>

        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="toolsTable">
        <thead>
            <tr>
                <th>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" value="" id="checkboxall" name="chkBox" class="chkBox checkboxes">
                        <span></span>
                    </label>
                </th>
                <th> {{ __('translate.name') }} </th>
                <th> {{ __('translate.email') }} </th>
                <th> {{ __('translate.subject') }} </th>
                <th> {{ __('translate.status') }} </th>
                <!--<th> {{ __('translate.replayStatus') }} </th>-->
                <th> {{ __('translate.created') }} </th>
                <th>  </th>
            </tr>
        </thead>

        <tbody>
        @foreach($data->items as $item)
            <tr class="odd gradeX" id="tr-{{$item->id}}">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes chkBox" value="{{$item->id}}" name="chkBox"/>
                        <span></span>
                    </label>
                </td>
                
         
                    <td> {{ @$item->name }} </td>
                    <td> {{ @$item->email }} </td>
                    <td> {{ @$item->subject }} </td>

                
                <td class="p-0">
                        <span class="btn label-sm {{@ $item->seen == 1? "btn-light-info" : "btn-light-danger" }} " id="label-{{@$item->id}}" style="margin: 2px;">
                        @if(@$item->seen == 1)
                            {{__('translate.read')}}
                        @else
                            {{__('translate.new')}}
                        @endif
                        </span>
                </td>
                
                <!--<td class="p-0">-->
                <!--            <span class="btn label-sm {{@ $item->replay == 1? "btn-light-info" : "btn-light-danger" }} " id="label-{{@$item->id}}" style="margin: 2px;">-->
                <!--                @if(@$item->replay == 1)-->
                <!--                    {{__('translate.yes')}}-->
                <!--                @else-->
                <!--                    {{__('translate.no')}}-->
                <!--                @endif-->
                <!--            </span>-->
                <!--</td>-->
                
                
                <td class="center"> {{ substr($item->created_at, 0, 10) }} </td>

                <td class="p-0">
                    <div class="btn-group btn-action">
                        @if(has_permission('admin.Contact.show') == true)
                            <a href="{{ route('admin.Contact.show', $item->id) }}" class="btn btn-xs tooltips" data-container="body" data-placement="top" data-original-title="{{__('translate.view')}}">
                                <i class="fa fa-eye text-success fs-2"></i>
                            </a>
                        @endif

                        @if(has_permission('admin.Contact.delete') == true)
                            <a data-id="{{$item->id}}" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="{{__('translate.delete')}}" class="btn btn-delete tooltips"> 
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

@endsection

@section('js')
@endsection


@section('script')

@endsection
