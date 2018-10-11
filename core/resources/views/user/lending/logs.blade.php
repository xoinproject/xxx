@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="panel panel-inverse" data-sortable-id="index-1">
    <div class="panel-heading">
      <h4 class="panel-title">Lending Log</h4>
    </div>
    <div class="panel-body table-responsive">
     <table class="table table-striped">
     	<tr>
     		<th>Wallet</th>
     		<th>Package</th>
            <th>Amount</th>
            <th>Return Times</th>
            <th>Returned Amount</th>
     		<th>Next Return</th>
     	</tr>
     	@foreach($logs as $log)
     	<tr>
     		<td>{{$log->address->label}} | {{$log->address->address}}</td>
     		<td>{{$log->package->name}}</td>
            <td>{{$log->amount}} {{$gnl->cur}}</td>
            <td>{{$log->rtime}} Times</td>
            <td>{{$log->returned}} {{$gnl->cur}}</td>
     		<td>{{$log->next}}</td>
     	</tr>
     	@endforeach
     </table>
     {{$logs->links()}}
   </div>
 </div>
</div>   
</div>

@endsection
