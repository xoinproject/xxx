@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
          <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Social Icons</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addsocial">
                        <i class="icon-plus"></i> New Social Icon
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column">
                    <tr>
                        <th>Icon</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                    @foreach($socials as $social)
                    <tr class="text-center">
                        <td><i class="fa fa-{{$social->icon}}" style="font-size: 30px; padding: 5px;
                        "></i></td>
                        <td>{{$social->url}}</td>
                        <td>
                            <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$social->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('social.destroy', $social)}}" method="POST" style="display: inline-block;">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-circle btn-icon-only btn-danger"  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This social?">
                                    <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div id="edit{{$social->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-icon">Edit Social Link</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" action="{{route('social.update', $social)}}">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                            <div class="form-group">
                                                <label for="icon">Social Icon</label>
                                                <a class="pull-right bold uppercase" href="http://fontawesome.io/icons/" target="_blank">Fontawesome Icon </a>
                            <div class="input-group">
                                <span class="input-group-addon">fa fa-</span>
                            <input type="text" value="{{$social->icon}}" name="icon" class="form-control">
                            </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="url">Social URL</label>
                                                <input type="text" value="{{$social->url}}" name="url" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Test -->
    <div id="addsocial" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-icon">New Social Link</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('social.store')}}">
                        {{ csrf_field() }}
                         <div class="form-group">
                            <label for="icon">Social Icon</label>
                           <a class="pull-right bold uppercase" href="http://fontawesome.io/icons/" target="_blank">Fontawesome Icon </a>
                            <div class="input-group">
                                <span class="input-group-addon">fa fa-</span>
                            <input type="text" name="icon" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">Social URL</label>
                            <input type="text"  name="url" class="form-control">
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