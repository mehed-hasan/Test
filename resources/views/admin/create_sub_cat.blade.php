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
                            <h2><strong>Create </strong> Subsub_category</h2>
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

                            <form action="/admin/insert_sub_cat" enctype="multipart/form-data" method="POST">
                               @csrf

                               
                               <div class="form-group ">
                                <select  class="form-control" name="cat_name" id="">
                                    @foreach ($catDatas as $catData )
                                    <option value="{{$catData->cat_name}}">{{$catData->cat_name}} </option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group form-float">
                                    <input value=""  type="text" class="form-control" placeholder="sub_category Name " name="sub_cat_name" >
                                </div>

                                <br>
                                <p>Sub category Cover photo</p>

                                <div class="row preview">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                         <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input class="img1" name="cover_img"  onchange="previewFile(this);" type="file" class="file-upload-browse btn btn-default"   id="fileToUploads" >
                                            </span>
                                          </div>
                                          <img style="max-width: 250px;" class="img-responsive img-thumbnail" src="https://endlessicons.com/wp-content/uploads/2012/12/add-icon-614x460.png"  id="img1"  alt="No Image Selected">
                                      </div>
                                </div>
                                <br>
                                <input name="submit" class="btn btn-primary" type="submit" value="Create New Sub Category">
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