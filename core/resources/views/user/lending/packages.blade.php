@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="panel panel-inverse">
                <div class="panel-heading">
                   <h4 class="panel-title">Lending Packages</h4>
                </div>
            <div class="panel-body">
        @foreach($packages as $package)
            <div class="col-md-4">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                           <h4 class="panel-title">{{$package->name}} 
                           </h4>
                        </div>
                        <div class="panel-body text-center">
                            <ul class="list-group">
                                <li class="list-group-item">Lend Limit: <strong>{{$package->min}} ~ {{$package->max}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Every Time Return: <strong>{{$package->ret}}</strong>%</li>
                                <li class="list-group-item">Total Return: <strong>{{$package->times}}</strong> Times</li>
                                <li class="list-group-item">Return Period: 
                                  @if($package->period==1)
                                    <strong>Hourly</strong>
                                  @elseif($package->period==24)
                                    <strong>Daily</strong>
                                  @elseif($package->period==168)
                                    <strong>Weekly</strong>
                                  @elseif($package->period==720)
                                    <strong>Monthly</strong>
                                  @elseif($package->period==2880)
                                    <strong>Quaterly</strong>
                                  @else
                                    <strong>Monthly</strong>
                                  @endif
                                </li>
                                <li class="list-group-item">
                                  <button class="btn btn-lg btn-success lendButton" data-package="{{$package->id}}" data-name="{{$package->name}}" data-toggle="modal" data-target="#lendModal">Lend Now</button>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>
</div>

   <!--  Lend Modal -->
    <div id="lendModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lend on <strong id="modalPackName"></strong></h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('lending.confirm')}}">
                 {{ csrf_field() }}
                 <input type="hidden" name="package" id="packageId">
                 <div class="form-group">
                  <label>Select Wallet</label>
                   <select class="form-control" name="wallet">
                    @foreach($wallets as $wallet)
                     <option value="{{$wallet->id}}">{{$wallet->label}} | {{$wallet->address}} | {{$wallet->balance}} {{$gnl->cursym}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                    <label>Enter Amount</label>
                   <div class="input-group">
                     <input type="text" name="amount" class="form-control">
                     <span class="input-group-addon">{{$gnl->cur}}</span>
                   </div>
                 </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Confirm Lending</button>
                    </div>
                </form>
              </div>
            </div>

          </div>
        </div>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.lendButton', function()
    {
      $('#modalPackName').text($(this).data('name'));
      $('#packageId').val($(this).data('package'));
    });
  });
</script>
@endsection
