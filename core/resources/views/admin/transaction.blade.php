@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Transaction Log</span>
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            Amount
                        </th>
                        <th>
                            Receiver Wallet
                        </th>
                        <th>
                            Sender Wallet
                        </th> 
                        <th>
                          Trx ID
                        </th>                       
                     </tr>
                </thead>
                <tbody>
      @foreach($trans as $tn)
                     <tr>
                     
                        <td>
                            {{$tn->amount}} {{$gnl->cur}}   
                        </td>
                        <td>
                            {{$tn->receiver}}
                        </td> 
                         <td>
                            {{$tn->sender}}
                        </td> 
                         <td>
                            {{$tn->trxid}}
                        </td> 
                     </tr>
      @endforeach 
      <tbody>
           </table>
           {{$trans->links()}}
        </div>
      
      </div>
      </div>
    </div>
  </div>    
</div>
@endsection