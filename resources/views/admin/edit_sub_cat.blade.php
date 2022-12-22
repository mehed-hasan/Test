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
                            <h2><strong>Edit </strong> Sub Category</h2>
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

                           @if (session()->has('error_messege'))
                           <p class="alert alert-danger">
                               {{ session('error_messege') }}
                           </p>
                          @endif

                            <form action="/admin/update_sub_cat/{{$datas->id}}/{{$datas->cover_img}}/{{$datas->cat_name.' >> '.$datas->sub_cat}}" enctype="multipart/form-data" method="POST">
                               @csrf

                               <div class="form-group ">
                                <select  class="form-control" name="cat_name" id="">
                                    @foreach ($catDatas as $catData )
                                    <option value="{{$catData->cat_name}}">{{$catData->cat_name}} </option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group form-float">
                                    <input value="{{$datas->sub_cat}}"  type="text" class="form-control" placeholder="Category Name " name="sub_cat_name" >
                                </div>

                                <br>
                                <p>Sub Category Cover photo</p>

                                <div class="row preview">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                         <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input value="{{$datas->cover_img}}"  class="img1" name="cover_img"  onchange="previewFile(this);" type="file" class="file-upload-browse btn btn-default"   id="fileToUploads" >
                                            <input value="{{$datas->cover_img}}"   type="hidden" name="old_img">
                                            </span>
                                          </div>
                                          <img style="max-width: 250px;" class="img-responsive img-thumbnail" src="{{asset('uploads/sub_cat_images/'.$datas->cover_img)}}"  id="img1"  alt="No Image Selected">
                                      </div>
                                </div>
                                <br>
                                <input name="submit" class="btn btn-primary" type="submit" value="Save Change">
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


// Deleing data

    </script>
@endsection