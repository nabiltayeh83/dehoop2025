@extends('layout.siteLayout')

@section('title', __('translate.aboutUs'))


@section('css')
@endsection


@section('content')

   <div class="about_section">
        <div class="container">   
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="about_title">
                        <h1> {{ @$settings->title }} </h1>
                    </div>
                </div>
           
                <div class="col-lg-12 col-md-12">
                    <div class="about_section_content">
                        <h3> {{ @$history->title }} </h3>
                        <p> {{ @$history->details }} </p>
                    </div>
                </div>
                        
                <div class="col-lg-12 col-md-12" style="margin-top:20px;">
                    <div class="about_section_content">
                        <h3> {{ @$mission->title }} </h3>
                        <p> {{ @$mission->details }} </p>
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




