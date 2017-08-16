


</div>
        <div class="col-md-4 col-sm-4">
        <a href="#"><img class="img-responsive" src="{{profileAdPath() ."" }}" alt="downloadfast-desktop" style=" "></a>

</div>









 @extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/ui.dynatree.css') }}" />

@stop

@section('content') 


    
    
        
       
    

    

<div class=content>

</div>
 
    <div id="wizard" class="span-23 table left" style="float:left; margin-left:0px; padding:5px 0px 0px 10px;
    background-color: #fff;
    border: 1px solid #DEDEDE;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    margin-bottom: 10px ;
    box-shadow: 0 0 10px rgba(189, 189, 189, 0.4);
    -webkit-box-shadow: 0 0 10px rgba(189, 189, 189, 0.4);
    -moz-box-shadow: 0 0 10px rgba(189, 189, 189, 0.4);">

    <div class="row" style="height:50px"></div>
    <div class="row">
      <div class="col-md-2 col-sm-2"></div> 
        <div class="col-md-4 col-sm-4 wizard" style="margin-bottom:50px" >
       
             <img src="{{profileAdPath() ."under-maintenance.jpg" }}" alt="under maintenance">

       
        </div>

    </div>
    </div>
    <center><div id="tabel-loader" style="display: none;"></div></center>
    <div id="tabel-hasil" style="display: none;"></div> 

@stop

@section('scripts')

<script src="{{ URL::asset('assets/js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery-ui.custom.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.dynatree.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabel.js')}}" type="text/javascript"></script> 
@stop 