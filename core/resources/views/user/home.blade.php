@extends('layouts.user')

@section('content')
@if($gnl->transaction==1)
<div class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-bitcoin"></i></div>
            <div class="stats-info">
              <h4>PLN RATE</h4>
			  @php
				$rateliquid = 0.99;
				$balance = \App\Address::where('user_id', Auth::id())->sum('balance');
				$estimate = $price*$balance;
				$angka_format = number_format($estimate,2);
				$balances = number_format($balance,4);
				$prices = number_format($price,2);
				$rateliquids=$price*$rateliquid;
				@endphp
              <p>Rp {{($prices)}}</p>  
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-blue">
            <div class="stats-icon"> <img src="{{ asset('assets/images/logo/icon.png') }}" style="width: 100%; "></div>
            <div class="stats-info">
              <h4>Liquid RATE</h4>
			  
              <p>Rp {{($rateliquids)}}</p> 
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><img src="{{ asset('assets/images/coin/btc.png') }}" style="width: 100%;  "></div>
            <div class="stats-info">
              <h4>Estimate Asset</h4>				
              <p>Rp {{($angka_format)}}</p>  
            </div>
          </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-red">
            <div class="stats-icon"> <img src="{{ asset('assets/images/logo/icon.png') }}" style="width: 100%; "></div>
            <div class="stats-info">
              <h4>BALANCE</h4>
			  
				<p>{{($balances)}} PLN</p>
            </div>
          </div>
        </div>
        <!-- end col-3 -->
</div>

  <div class="row">
    <div class="col-md-4">
      <div class="col-md-12">
         <div class="panel panel-inverse" data-sortable-id="ui-buttons-3">
            <div class="panel-heading">
                <h4 class="panel-title">MAKE TRANSACTION</h4>
             </div>
             <div class="panel-body">
                <button type="button" class="btn btn-inverse btn-lg" data-toggle="modal" data-target="#sendmoney"><i class="fa fa-upload" aria-hidden="true"></i> Send </button>
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#request" id="request-button"><i class="fa fa-download" aria-hidden="true"></i> Request </button>
             </div>
         </div>
      </div>     
    </div>

<div class="col-md-8">
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
	</table>
</div>	
</div>
</div>

@endif
@if($gnl->ico==1)
<div class="row">
    <div class="col-md-12">
       <div class="panel panel-inverse">
                <div class="panel-heading">
                   <h4 class="panel-title">LIST PROJECT OFFERING</h4>
                </div>
            <div class="panel-body">
        @foreach($nexts as $next)
            <div class="col-md-4">
                <div class="panel panel-{{$next->status == 1? 'success': 'inverse'}}">
                        <div class="panel-heading">
                           <h4 class="panel-title">{{$next->status == 1? 'Runing': 'Upcoming'}} FUNDING PROJECT 
                           </h4>
                        </div>
                        <div class="panel-body text-center">
                            <ul class="list-group">
                                <li class="list-group-item">Price: <strong>{{$next->price}} IDR</strong></li>
								<li class="list-group-item">Project: <strong>{{$next->project}}</strong></li>
                                <li class="list-group-item">Start At: <strong>{{$next->start}}</strong></li>
                                <li class="list-group-item">End At: <strong>{{$next->end}}</strong></li>
                                <li class="list-group-item">Total Quantity: <strong>{{$next->quant}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Sold: <strong>{{$next->sold}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">
                                      <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{round(($next->sold/$next->quant)*100,2)}}"
                                      aria-valuemin="0" aria-valuemax="100" style="width:{{round(($next->sold/$next->quant)*100,2)}}%">
                                      </div>
                                    </div>
                                    <span style="color:#0066cc;">{{round(($next->sold/$next->quant)*100,2)}}% Sold</span>
                                </li>
                            </ul>
                        </div>
                         @if($next->status==1)
                          <div class="panel-footer text-center">
                                <a class="btn btn-success btn-lg btn-block" href="{{route('buy.ico')}}">Buy Now</a>
                            </div>
                          @else
                          <div class="panel-footer text-center">
                                <a class="btn btn-warning btn-lg btn-block disabled" href="#">Coming...</a>
                            </div>
                        @endif
                    </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>
</div>


<!-- Create Address -->
<div id="newaddress" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Wallet</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('create.address') }}">
          {{csrf_field()}}
          <div class="form-group">
            <label>Label</label>
            <input type="text" name="label" class="form-control" placeholder="Optional.Eg: My Wallet">
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-block btn-lg" type="submit">Create</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--Send Money -->
<div id="sendmoney" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Your Asset Prabulinggo (PLN)</h4>
      </div>
      <div class="modal-body text-center">
        <form action="{{route('send.money')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label>Send From</label>
            <select class="form-control" name="fromad" id="fromad">
             @foreach($adds as $add)
               <option  value="{{$add->id}}">{{$add->label}} | {{$add->address}}  |  {{round($add->balance,$gnl->decimal)}} {{$gnl->cursym}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>To</label>
            <input type="text" name="toadd" id="toadd" class="form-control input-sz" placeholder="Enter Recipient Wallet Address" required>
          </div>
          <div class="form-group">
            <label>Amount</label>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5">
                    <div class="input-group">
                  <input type="text" name="amount" class="form-control" id="amount" required>
                  <span class="input-group-addon">
                    {{$gnl->cursym}}
                  </span>
                  </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <i class="fa fa-arrows-h" aria-hidden="true"></i>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5">
                    <div class="input-group">
                     <input type="text" id="usd" class="form-control">
                      <span class="input-group-addon">IDR
					  </span>
                    </div>
                </div>
            </div>
          </div>
          
          <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block">
              Send Asset ({{$gnl->cur}})
            </button>
          </div>
        </form>

      </div>

    </div>

  </div>
</div>

<!-- Request Modal -->
<div id="request" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receive PLN</h4>
      </div>
      <div class="modal-body text-center">
        <div class="form-group">
          <div class="input-group disable">
          <input id="code" placeholder="QR CODE" class="form-control input-lg" value="{{$add->address}}">
          <span class="btn btn-success input-group-addon" id="copybtn">Copy</span>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>



<!-- change Send Value -->
<script type="text/javascript">
   $(document).ready(function()
   {
     $("#amount").keyup(function(){
       var data = $("#amount").val();
       var rate = {{$price}};
       var total = data*rate;
       $("#usd").val(total);
       });

     $("#usd").keyup(function(){
       var data = $("#usd").val();
       var rate = {{$price}};
       var total = data/rate;
       $("#amount").val(total);
       });

    });
</script>

<!-- change Receive Value -->
<script type="text/javascript">
   $(document).ready(function()
   {
     $("#coinamount").keyup(function(){
       var rdata = $("#coinamount").val();
       var rrate = {{$price}};
       var rtotal = rdata*rrate;
       $("#usdamount").val(rtotal);
       });

     $("#usdamount").keyup(function(){
       var rudata = $("#usdamount").val();
       var rurate = {{$price}};
       var rutotal = rudata/rurate;
       $("#coinamount").val(rutotal);
       });
    });
</script>

<!-- Receive Code -->
<script type="text/javascript">
  $(document).ready(function(){

    $("#toacc").change(function()
    {
        var toaccount = $( "#toacc" ).val();
        var coinamo = $("#coinamount").val();
        getQrCode(toaccount,coinamo);
    });

     $("#coinamount").keyup(function()
     {
          var toaccount = $( "#toacc" ).val();
          var coinamo = $("#coinamount").val();
          getQrCode(toaccount,coinamo);
    }); 
     
    $("#usdamount").keyup(function()
     {
          var toaccount = $( "#toacc" ).val();
          var coinamo = $("#coinamount").val();
          getQrCode(toaccount,coinamo);
    });
     
    function getQrCode(toaccount, coinamo)
      {
          $.ajax({
               type:'GET',
               url:'{{ route('receive.money') }}',
                data:
              {
                'toacc':toaccount,
                'coinamount':coinamo
              },
               success:function(data)
               {
                  console.log(data);
                  $('#qrcode').html(data.qcode);
                  $('#code').val(data.code);
               },
              error:function(res){
                $('#code').text('Enter Valid Amount and Wallet ID');
              }
          });
      }
  });
</script>

<!--Copy Address -->
<script type="text/javascript">
  document.getElementById("copybtn").onclick = function()
  {
    document.getElementById('code').select();
    document.execCommand('copy');
  }
</script>
@endif


@endsection

