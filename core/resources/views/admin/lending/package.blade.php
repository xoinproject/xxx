@extends('admin.layout.master')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-blue"></i>
                        <span class="caption-subject bold uppercase">Lending Packages</span>
                    </div>
                    <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addPackage">
                       <i class="icon-plus"></i> New Package
                    </a>
                </div>
                </div>

                <div class="portlet-body">
                <div class="row">
                @foreach($packages as $pack)
                    <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            {{$pack->name}}
                        </div>
                        <div class="panel-body text-center">
                            <form role="form" method="POST" action="{{route('package.update',$pack)}}">
                        {{method_field('put')}}
                 {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$pack->name}}" class="form-control" />
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="min" >Minimum</label>
                        <div class="input-group">
                        <input type="text" name="min" value="{{$pack->min}}" class="form-control">
                          <span class="input-group-addon">{{$gnl->cursym}}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="max">Maximum</label>
                        <div class="input-group">
                        <input type="text" name="max" value="{{$pack->max}}" class="form-control">
                          
                          <span class="input-group-addon">{{$gnl->cursym}}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="return">Every Time Return</label>
                        <div class="input-group">
                           <input type="text" name="return" value="{{$pack->ret}}" class="form-control">
                          <span class="input-group-addon">%</span>
                        </div>
                       
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Return Times</label>
                       <div class="input-group">
                            <input type="text" name="times" value="{{$pack->times}}" class="form-control">
                            <span class="input-group-addon">Times</span>
                        </div>   
                    </div>
                    <div class="form-group">
                        <label for="period">Return Period</label>
                        <select name="period" class="form-control">
                          <option value="1" {{$pack->period == '1' ? 'selected' : ''}}>Hourly</option>
                          <option value="24" {{$pack->period == '24' ? 'selected' : ''}}>Daily (24 Hours)</option>
                          <option value="168" {{$pack->period == '168' ? 'selected' : ''}}>Weekly (168 Hours)</option>
                          <option value="720" {{$pack->period == '720' ? 'selected' : ''}}>Monthly (720 Hours)</option>
                          <option value="2880" {{$pack->period == '2880' ? 'selected' : ''}}>Quaterly (2880 Hours)</option>
                          <option value="8640" {{$pack->period == '8640' ? 'selected' : ''}}>Yearly (8640 Hours)</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1"  {{$pack->status == 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$pack->status != 1 ? 'selected' : ''}}>Deactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                    </div>
                </form>
                        </div>
                    </div>
                        
                    </div>
                @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Add addPackage -->
    <div id="addPackage" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Package</h4>
              </div>
              <div class="modal-body">
                <form role="form" method="POST" action="{{route('package.store')}}">
                 {{ csrf_field() }}
            <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control" />
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="min" >Minimum</label>
                        <div class="input-group">
                        <input type="text" name="min"  class="form-control">
                          <span class="input-group-addon">{{$gnl->cursym}}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="max">Maximum</label>
                        <div class="input-group">
                        <input type="text" name="max"  class="form-control">
                          
                          <span class="input-group-addon">{{$gnl->cursym}}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="return">Every Time Return</label>
                        <div class="input-group">
                           <input type="text" name="return"  class="form-control">
                          <span class="input-group-addon">%</span>
                        </div>
                       
                    </div>
                    <div class="form-group col-md-6">
                        <label for="times">Return Times</label>
                        <div class="input-group">
                            <input type="text" name="times" class="form-control">
                            <span class="input-group-addon">Times</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="period">Return Period</label>
                        <select name="period" class="form-control">
                          <option value="1" >Hourly</option>
                          <option value="24" >Daily (24 Hours)</option>
                          <option value="168">Weekly (168 Hours)</option>
                          <option value="720">Monthly (720 Hours)</option>
                          <option value="2880">Quaterly (2880 Hours)</option>
                          <option value="8640">Yearly (8640 Hours)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Deactive</option>
                        </select>
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