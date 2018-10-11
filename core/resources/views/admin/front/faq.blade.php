@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Custom Sections</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" href="{{route('section.create')}}">
                        <i class="icon-plus"></i> New Section
                    </a>
                </div>
            </div>
            <div class="portlet-body">
               <div class="row">
                   <form role="form" method="POST" action="{{route('update.newsection')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                         <div class="form-group col-md-6 col-md-offset-3">
                        <label>Section Visibility</label>
                        <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" value="1" name="footer2" {{ $frontend->footer2 == 1 ? 'checked' : '' }} onchange="this.form.submit()">
                        </div>
                        
                    </div>
                   
                </form>
                <hr/>
               </div> 
               
<div class="row">
@foreach($faqs as $faq) 
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                {{$faq->title}}
            </div>
            <div class="panel-body" style="background-color:#{{$faq->color}};">
                {!!$faq->details!!}
            </div>
            <div class="panel-footer">
             <a class="btn btn-md btn-warning" href="{{route('section.edit', $faq)}}">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('section.destroy', $faq)}}" method="POST" class="pull-right">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-md  btn-danger "  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Faq?">
                                    <i class="fa fa-trash"></i> Delete</button>
                                </form>
        </div>
        </div>
        
    </div>
    <hr/>
@endforeach      
</div>
@endsection