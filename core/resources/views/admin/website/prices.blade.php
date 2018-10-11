@extends('admin.layout.master')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-red-sunglo">
<i class="icon-settings font-red-sunglo"></i>
<span class="caption-subject bold uppercase">{{$gnl->cur}} Price List</span>
</div>
                     <div class="actions">
                        <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addico">
                           <i class="icon-plus"></i> New Price
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                  <h4>Current Stock: <strong>{{$stock}}</strong> {{$gnl->cur}}</h4>
                      <table class="table table-striped table-bordered table-hover order-column">
                      	<tr>
                          <th>{{$gnl->cur}} Price (IDR)</th>
                      		<th>Start Date</th>
                      	</tr>
                      	@foreach($prices as $price)
              						<tr>
                            <td>{{$price->price}} IDR</td>           
                            <td>{{$price->created_at}}</td>           
              						</tr>
                      	@endforeach
                      </table>
                </div>
            </div>
        </div>
    </div>
      <!-- Add Test -->
    <div id="addico" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Price</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('price.store')}}">
                 {{ csrf_field() }}
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                          <input type="text" name="price" class="form-control">
                          <span class="input-group-addon">IDR</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Save</button>
                    </div>
                </form>
              </div>
            </div>

          </div>
        </div>
@endsection