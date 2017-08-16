<?php $count = Auth::user()->newMessagesCount(); ?>
@if($count > 0)
 <a href="{{ URL::route('messages') }}" class="text-warning" style="padding-top: 21px;"> 
  <i class="fa fa-envelope">{{$count}}</i>                     
 </a>
 @else
 <a href="{{ URL::route('messages.create') }}" class="text-warning" style="padding-top: 21px;"> 
  <i class="fa fa-envelope"></i>                     
 </a>
@endif








              