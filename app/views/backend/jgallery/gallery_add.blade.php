@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{HTML::style('/assets/dropzone/css/dropzone.css')}}
{{HTML::style('/assets/fancybox/source/jquery.fancybox.css')}}
{{HTML::style('/css/gallery.css')}}
@stop
@section('content')
<!-- page start-->
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jgallery')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<section class="panel">
    <header class="panel-heading">
        Gallery File Upload
    </header>
    <div class="panel-body">
        <form action="{{\URL::to('/backend/jgallery/gallery/'.\Request::segment(4).'/')}}" method="post" enctype="multipart/form-data" class="dropzone" id="mydropzone"></form>
    </div>
</section>
<section class="panel">
    <header class="panel-heading">
        Image Galley
    </header>
    <div class="panel-body">
        <ul class="grid cs-style-3">
            @foreach($page['result'] as $item)
            <li>
                <figure>
                    <a class="fancybox" rel="group" href="{{ URL::to(json_decode(trim($item->url))->{'photo'}) }}"><img src="{{ URL::to(json_decode(trim($item->url))->{'thumbs'}) }}" alt="{{$item->name}}"></a>                              
                    <figcaption>
                        <h3>{{$item->name}}</h3>
                        <button type="button" class="btn btn-danger btnDelete" value="backend/jgallery/gallery/delete/{{$item->id}}"><i class="icon-trash"></i> Delete </button>
                    </figcaption>

                </figure>
            </li>
            @endforeach
        </ul>

    </div>
</section>
<!-- page end-->
@stop
@section('script_page_only')
{{HTML::script('/assets/dropzone/dropzone.js')}}
{{HTML::script('/assets/fancybox/source/jquery.fancybox.js')}}
{{HTML::script('/js/modernizr.custom.js')}}
{{HTML::script('js/toucheffects.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        //    fancybox
        jQuery(".fancybox").fancybox();
        $('.btnDelete').click(function() {
            var data = {
                url: $(this).val(),
                title: 'Delete Gallery',
                redirect: 'backend/jgallery/gallery/{{\Request::segment(4)}}',
                type: 'general'
            };
            deleteData(data);
        });
    });
    Dropzone.options.mydropzone = {
        paramName: "photo", // The name that will be used to transfer the file
        maxFilesize: 1
    };

</script>
@stop