@extends('layouts.default')

@section('analysis')
<div class="panel" style=" height: 1200px;" >
	@if(Auth::user())
        		<iframe src="https://de3de5ff.ngrok.io{{Auth::user()->remember_token;}}" id="iFrame1" width= "100%" height="100%"  frameBorder="0">

				</iframe>
	@else
	<div class="row">
    <div  style="align-content: center;" class="col-md-6 col-sm-4 col-xs-4s span-12">
    	<center>
    		    <div class="col-md-6 alert-warning alert opabar text-right">
       				<p>Please, login to use analysis tools</p>
       				<small>-Admin</small> 
    			</div>
    	</center>
    </div>
	</div>

	@endif
</div>

@stop

@section('scripts')
<script type="application/javascript">

function resizeIFrameToFitContent( iFrame ) {

    iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
    iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
}

window.addEventListener('DOMContentReady', function(e) {

    var iFrame = document.getElementById( 'iFrame1' );
    resizeIFrameToFitContent( iFrame );

    // or, to resize all iframes:
    var iframes = document.querySelectorAll("iframe");
    for( var i = 0; i < iframes.length; i++) {
        resizeIFrameToFitContent( iframes[i] );
    }
} );

</script>

@stop