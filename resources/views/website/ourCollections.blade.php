@extends('layout.siteLayout')

@section('title', __('translate.ourCollections'))


@section('css')
@endsection


@section('content')

    <div class="shop_area">
        <div class="container">
            <div class="row shop_reverse">
                <div class="col-lg-12 col-md-12">
                    <div class="shop_wrapper">
                    
                        <div class="tab-content tab_four tab_six shop_list">
                            <div class="tab-pane fade show active" id="list" role="tabpanel">
                                
                                @foreach($items as $one)
                                    <div class="product_list_item"> 
                                        <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="product_thumb">
                                                        <a href="{{ route('collectionDet', ['id' => $one->id]) }}">
                                                            <img class="primary_img" src="{{ @$one->image }}" alt="{{ @$one->name }}">
                                                        </a> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8">
                                                    <div class="product_content">
                                                        <div class="product_name">
                                                            <h2><a href="{{ route('collectionDet', ['id' => $one->id]) }}"> {{ @$one->name }} </a></h2>
                                                        </div> 
                                                           
                                                        <div class="product_desc">
                                                            <p> {{  Str::words(@$one->details, 150, '..'); }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>                                
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


   
      

@section('script')
@endsection


@section('js')
@endsection




