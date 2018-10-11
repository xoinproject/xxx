@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="panel panel-inverse" data-sortable-id="index-1">
    <div class="panel-heading">
      <h4 class="panel-title">All Wallet Addresses</h4>
    </div>
    <div class="panel-body table-responsive">
     <table class="table table-striped">
     	<tr>
     		<th>Label</th>
     		<th>Address</th>
     		<th>Balance</th>
     	</tr>
     	@foreach($wallets as $wallet)
     	<tr>
     		<td>{{$wallet->label == '' ? 'No Label' : $wallet->label}}</td>
     		<td>{{$wallet->address}}</td>
     		<td>{{$wallet->balance}} {{$gnl->cur}}</td>
     	</tr>
     	@endforeach
     </table>
     {{$wallets->links()}}
   </div>
 </div>
</div>   
</div>

@endsection
