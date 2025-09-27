
    @if($errors->count() >0)
        <div class="alert alert-warning alert-dismissible center-block" role="alert" style="margin: auto; margin-top: 15px; margin-bottom: 10px; width: 60%;">
            @foreach($errors->all() as $error)
                - {{$error}} <br>
            @endforeach
        </div>
    @endif
    
    

    @if(Session::get("msg")!=NULL)
    
        @php
            $msgClass="alert-info";
            if(strstr(Session::get("msg"),"s:")){ $msgClass="alert-success"; }
            else if(strstr(Session::get("msg"),"e:")){ $msgClass="alert-danger"; }
            else if(strstr(Session::get("msg"),"i:")){ $msgClass="alert-info"; }
            else if(strstr(Session::get("msg"),"w:")){ $msgClass="alert-warning"; }
        @endphp
    
        <div class="alert {{$msgClass}} alert-dismissible" role="alert" style="margin: auto; margin-top: 15px; margin-bottom: 10px; width: 60%;">
            {{substr(Session::get("msg"),2)}}
        </div>  
    @endif

