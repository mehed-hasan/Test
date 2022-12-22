@extends('admin.layout')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Edit </strong>Sub Banner (Discont)</h2>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                     
                            @if (count($errors) > 0)
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li >{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            @endif

                            @if (session()->has('message'))
                            
                                <p class="alert alert-success">
                                    {{ session('message') }}
                                </p>
                             @endif
                             @if (session()->has('error_message'))
                            
                             <p class="alert alert-danger">
                                 {{ session('error_message') }}
                             </p>
                          @endif

                            <form action="/admin/update_sub_banner/{{$datas->id}}/{{$datas->cover_img}}" enctype="multipart/form-data" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <input value="{{$datas->heading}}" placeholder="Write sub banner heading "  minlength="5" maxlength="34"  type="text" class="form-control" placeholder="Category Name " name="heading_name" >
                                </div>
                                <div class="form-group form-float">
                                    <input value="{{$datas->short_desc}}" placeholder="Write short text for sub banner"  minlength="15" maxlength="100"  class="form-control" name="short_desc" type="text">
                                </div>

                                <br>
                                <p>Upload Banner  (.png) photo (185 X 185)px</p>

                                <div class="row preview">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                         <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input class="img1" name="cover_img"  onchange="previewFile(this);" type="file" class="file-upload-browse btn btn-default"   id="fileToUploads" >
                                            </span>
                                          </div>
                                          <img style="max-width: 250px;" class="img-responsive img-thumbnail" src="{{asset('')}}uploads/sub_banner_images/{{$datas->cover_img}}"  id="img1"  alt="No Image Selected">
                                      </div>
                                </div>
                                <br>
                                <div class="form-group form-float">
                                    <input value="{{$datas->link}}" placeholder="link "  minlength="5" maxlength="225"  type="text" class="form-control" placeholder="Heading  " name="link" >
                                </div>
                                <input name="submit" class="btn btn-primary" type="submit" value="Save Changes">
                            </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection
@section('scripts')

    <script>
    function previewFile(input){
    var file = $(".img1").get(0).files[0];


    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#img1").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
    </script>
@endsection