@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Edit {{$section->title}} Section</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" href="{{route('section.index')}}">
                        <i class="icon-list"></i> Section List
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                 <form role="form" method="POST" action="{{route('section.update', $section)}}">
                    {{ csrf_field() }}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{$section->title}}" name="title" class="form-control">
                    </div>
                   <div class="form-group">
                            <label for="color">Section Color</label>
                            <div class="input-group">
                                <span class="input-group-addon">#</span>
                                <input type="text" name="color" value="{{$section->color}}" class="form-control" placeholder="example: 12cd56">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="details">Section Content</label>
                            <textarea class="form-control" name="details" rows="10">
                                {!!$section->details!!}
                            </textarea>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    
    @endsection