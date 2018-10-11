@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Lending Log</span>
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover order-column">
                <thead>
                    <tr>
                        <th>
                            Username 
                        </th>
                      <th>Wallet</th>
                      <th>Package</th>
                      <th>Amount</th>
                      <th>Return Times</th>
                      <th>Returned Amount</th>
                      <th>Next Return</th>      
                     </tr>
                </thead>
                <tbody>
     @foreach($logs as $log)
                     <tr>
                      <td>
                          <a href="{{route('user.single', $log->user->id)}}">
                            {{$log->user->username}}
                          </a>
                        </td>
                     <td>{{$log->address->address}}</td>
        <td>{{$log->package->name}}</td>
            <td>{{$log->amount}} {{$gnl->cur}}</td>
            <td>{{$log->rtime}} Times</td>
            <td>{{$log->returned}} {{$gnl->cur}}</td>
        <td>{{$log->next}}</td>
                     </tr>
      @endforeach 
      <tbody>
           </table>
            {{$logs->links()}}
        </div>
      
      </div><!-- row -->
      </div>
    </div>
  </div>    
</div>
@endsection