@extends('admin.layout.master')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">General Settings</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" method="POST" action="{{route('general.update')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-2">
							<label>Website Title</label>
							<input type="text" class="form-control input-lg" value="{{$general->title}}" name="title" >
						</div>
						<div class="col-md-4">
							<label>Website Sub-Title</label>
							<input type="text" class="form-control input-lg" value="{{$general->subtitle}}" name="subtitle" >
						</div>
					
						<div class="col-md-2">
							<label>BASE COLOR CODE</label>
							<input type="color" class="form-control input-lg"  value="#{{$general->color}}" name="color"  >
						</div>
						<div class="col-md-2">
							<label>CURRENCY CODE</label>
							<input type="text" class="form-control input-lg" value="{{$general->cur}}" name="cur" >
						</div>
						<div class="col-md-2">
							<label>CURRENCY SYMBOL</label>
							<input type="text" class="form-control input-lg" value="{{$general->cursym}}" name="cursym" >
						</div>
					</div>
					<div class="row">
						<hr/>
						<div class="col-md-3">
							<label>DECIMAL POINT</label>
							<input type="number" value="{{$general->decimal}}" name="decimal" class="form-control input-lg" >
						</div>
						<div class="col-md-3">
							<label>{{$general->cur}} Stock</label>
							<div class="input-group">
								<input type="text" class="form-control input-lg" value="{{$general->stock}}" name="stock" >
								<span class="input-group-addon">{{$general->cursym}}</span>
							</div>
						</div>
						<div class="col-md-3">
							<label>Referal Commision</label>
							<div class="input-group">
							<input type="text" value="{{$general->refcom}}" name="refcom" class="form-control input-lg" >
								<span class="input-group-addon">%</span>
							</div>
						</div>
						
						<div class="col-md-3">
							<label>Transaction Charge</label>
							<div class="input-group">
							<input type="text" value="{{$general->trancrg}}" name="trancrg" class="form-control input-lg" >
								<span class="input-group-addon">%</span>
							</div>
						</div>	
					</div>
					<div class="row">
						<hr/>
						<div class="col-md-2">
							<label>User Registration</label>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="reg" {{ $general->reg == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-3">
							<label>EMAIL VERIFICATION</label>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="emailver" {{ $general->emailver == "0" ? 'checked' : '' }}>
						</div>
						<div class="col-md-3">
							<label>SMS VERIFICATION</label>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="smsver"  {{ $general->smsver == "0" ? 'checked' : '' }}>
						</div>
						<div class="col-md-2">
							<label>EMAIL NOTIFICATION</label>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="emailnotf"  {{ $general->emailnotf == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-2">
							<label>SMS NOTIFICATION</label>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="smsnotf" {{ $general->smsnotf == "1" ? 'checked' : '' }}>
						</div>
					</div>
					<div class="row">
						<hr/>
						<div class="col-md-3">
							<h4>Transaction</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="transaction"  {{ $general->transaction == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-3">
							<h4>ICO</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="ico"  {{ $general->ico == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-3">
							<h4>Lending</h4>
							<input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="lending" {{ $general->lending == "1" ? 'checked' : '' }}>
						</div>
						<div class="col-md-3">
							<label>Wallet Prefix</label>
							<input type="text" value="{{$general->wprefix}}" name="wprefix" class="form-control input-lg" >
						</div>
						
                	</div>
					<div class="row">
						<hr/>
						<div class="col-md-6 col-md-offset-3">
							<button class="btn blue btn-block btn-lg">Update</button>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection
