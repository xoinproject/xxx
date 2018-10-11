@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Preview of Purchase {{$gnl->cur}}</h4>
    </div>
    <div class="panel-body table-responsive text-center">
       <ul class="list-group">
       		<li class="list-group-item"><h3>{{$gnl->cur}} Amount: <strong>{{$amount}}</strong> {{$gnl->cursym}}</h3></li>
       		@if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8) 
         		<li class="list-group-item"><h3>Total Payable: <strong>{{$btc}}</strong> BTC</h3></li>
         		<li class="list-group-item"><h3>Payment Gateway: <strong>{{$gate->name}}</strong></h3></li>
          @else
         		<li class="list-group-item"><h3>Total Payable: <strong>{{$usd}}</strong> USD</h3></li>
         		<li class="list-group-item"><h3>Payment Gateway: <strong>{{$gate->name}}</strong></h3></li>
       		@endif
       </ul>
   </div>
   <div class="panel-footer">
   	<a class="btn btn-success btn-lg btn-block" href="{{route('purchase.confirm')}}">
   		Pay Now
   	</a>
   </div>
 </div>
</div> 
</div>
@endsection
