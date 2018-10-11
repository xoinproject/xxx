@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="panel panel-inverse" data-sortable-id="index-1">
    <div class="panel-heading">
      <h4 class="panel-title">Transaction Log</h4>
    </div>
    <div class="panel-body table-responsive">
     <table class="table table-striped">
     	<tr>
            <th class="text-center">Type</th>
     		<th class="text-center">Recipient</th>
     		<th class="text-center">Sender</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Transaction ID</th>
     		<th class="text-center">Transaction Time</th>
     	</tr>
     	@foreach($trans as $tran)
     	<tr>
            <td><span class="btn btn-{{$tran->rcid==Auth::id() ? 'success' : 'danger'}}" style="cursor: default;">{{$tran->rcid==Auth::id() ? 'Received' : 'Sent'}}</span></td>
     		<td>{{$tran->receiver}}</td>
            <td>{{$tran->sender}}</td>
            <td>{{$tran->amount}} {{$gnl->cur}}</td>
            <td>{{$tran->trxid}}</td>
     		<td>{{$tran->created_at}}</td>
     	</tr>
     	@endforeach
     </table>
     {{$trans->links()}}
   </div>
 </div>
</div>   
</div>

@endsection
