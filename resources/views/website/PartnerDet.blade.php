@extends('layout.siteLayout')

@section('title',  @$item->title)


@section('breadcrumbItem')
    <li><a href="{{ route('ourPartner') }}"> {{ __('translate.partners') }} </a></li>
@endsection


@section('css')
@endsection



@section('content')

    <div class="product_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="">
                            <img id="zoom11" src="{{ @$item->image }}" alt="{{ @$item->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="product_d_right">
                        <div class="product_nav">
                            <h1> {{ @$item->name }} </h1>
                        </div>
                        <div class="product_desc">
                            <p> {{ @$item->details }} </p>
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




