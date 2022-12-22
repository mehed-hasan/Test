@extends('admin.layout')
@section('styles')
<link href="{{asset('css/select2.min.css')}}" type="text/css" rel="stylesheet" />

<style>
    .preview img{
        height:150px;
        width:100%;
        object-fit: cover;
    }
    .preview input{
        width: 100%;
    }
    .box{
        height:10px;
        width:15px;
        color:white;
        font-weight: bold;
        border-radius: 3px;
        padding: 2px 5px;
    }
</style>
@endsection
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
                            <h2><strong>Upload </strong> Product</h2>

                            @if (count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li >{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif

                            @if (session()->has('message'))
                                <p class="alert alert-success">{{session('message')}}</p>                                
                            @endif

                            @if (session()->has('error_message'))
                            <p class="alert alert-danger">{{session('error_message')}}</p>                                
                        @endif
                            
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="/admin/insert_product" enctype="multipart/form-data"  method="post">
                                @csrf
                                <label for="">Product Name </label>
                                <div class="form-group form-float">
                                    <input pore maxlength="100" type="text" class="form-control" placeholder="Product Name " name="product_name" pore>
                                </div>

                                <label for="">SKU </label>
                                <div class="form-group form-float">
                                    <input pore maxlength="100" type="text" class="form-control" placeholder="SKU" name="sku" pore>
                                </div>

                                <label for="">Select Category</label>
                                <div class="form-group ">
                                    <select pore class="form-control filter_select" name="all_cat_name" id="">
                                        @foreach ($allCats as $allCat )
                                        <option value="{{$allCat->all_cat_name}}">{{$allCat->all_cat_name}} </option>
                                        @endforeach
                                    </select>
                                </div>



                                <label for="">Buying Price</label>
                                <div class="form-group form-float">
                                    <input max="10000000" value=""  type="number" class="form-control" placeholder="Buying price" name="buying_price" >
                                </div>

                                <label for="">Before price (For attraction)</label>
                                <div class="form-group form-float">
                                    <input max="10000000" value=""  type="number" class="form-control" placeholder="Before price" name="before_price" >
                                </div>

                                <label for="">Recent Price (Selling price)</label>
                                <div class="form-group form-float">
                                    <input max="10000000"   type="number" class="form-control" placeholder="Recent Price" name="recent_price" pore>
                                </div>

                                <label for="">Color</label>
                                <div class="form-group ">
                                    <select pore class="form-control" name="color_name" id="">
                                        @foreach ($colorDatas as $colorData )
                                        <option value="{{$colorData->color_name}}">{{$colorData->color_name}} </option>
                                        @endforeach
                                        <option value="null">No color</option>

                                    </select>
                                </div>

                                <label for="">Size</label>
                                <div class="form-group ">
                                    <select  pore class="form-control" name="size_name" id="">
                                        @foreach ($sizeDatas as $sizeData )
                                        <option value="{{$sizeData->size_name}}">{{$sizeData->size_name}} </option>
                                        @endforeach
                                        <option value="null">No Size</option>

                                    </select>
                                </div>

                                <label for="">Brand Name</label>
                                <div class="form-group ">
                                    <select pore class="form-control" name="brand_name" id="">
                                        @foreach ($brandDatas as $brandData )
                                        <option value="{{$brandData->brand_name}}">{{$brandData->brand_name}} </option>
                                        @endforeach
                                        <option value="null">No brand</option>

                                    </select>
                                </div>

                                <label for="">Quantity</label>
                                <div class="form-group form-float">
                                    <input value=""  min="1" max="10000"  type="number" class="form-control" placeholder="Quantity : Ex: 10" name="stock" pore>
                                </div>

                                <div class="form-group form-float">
                                    <input value="annonymus"  hidden type="text" class="form-control" placeholder="" name="uploaded_by" pore>
                                </div>

                                <label for=""> Unit</label>
                                <div class="form-group ">
                                    <select pore class="form-control" name="unit_name" id="">
                                        @foreach ($units as $unit )
                                        <option value="{{$unit->unit_name}}">{{$unit->unit_name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="">Select Tag</label>
                                <div class="form-group ">
                                    <select pore class="form-control" name="tag_name" id="">
                                        @foreach ($tags as $tag )
                                        <option value="{{$tag->tag_name}}">{{$tag->tag_name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="">Point amount</label>
                                <div class="form-group form-float">
                                    <input max="1000" value=""  type="number" class="form-control" placeholder="Pount amount" name="point" >
                                </div>

                                <label for="">Shipping max-time</label>
                                <div class="form-group form-float">
                                    <input max="1000" value=""  type="number" class="form-control" placeholder="Shipping max-time" name="shipping" >
                                </div>


                                <label for="">Short Description</label>
                                <div class="form-group form-float">
                                    <textarea maxlength="4000" name="short_desc" cols="10" rows="3" placeholder="Short Description" class="form-control no-resize" pore></textarea>
                                </div>

                                <label for="">Long Description</label>
                                <div class="form-group form-float editor">
                                   <textarea placeholder="Write prodduct description here ..." class="form-control " name="long_desc" id="" cols="15" rows="5"></textarea>
                                </div>

                                <br>
                                <div class="row preview">
                                    <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12">
                                         <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input  pore class="img1"  onchange="previewFile(this);" type="file" class="file-upload-browse btn btn-default"  name="image1" id="" >
                                            </span>
                                          </div>
                                          <img class="img-responsive img-thumbnail" src="https://endlessicons.com/wp-content/uploads/2012/12/add-icon-614x460.png"  id="img1"  alt="No Image Selected">
                                      </div>

                                     <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12">
                                        <div class="input-group col-xs-12">
                                           <span class="input-group-append">
                                           <input  class="img2"  onchange="previewFile2(this);" type="file" class="file-upload-browse btn btn-default"  name="image2" id="" >
                                           </span>
                                         </div>
                                         <img class="img-responsive img-thumbnail" src="https://endlessicons.com/wp-content/uploads/2012/12/add-icon-614x460.png" id="img2"  alt="No Image Selected">
                                      </div>

                                        <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12">
                                            <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input class="img3" onchange="previewFile3(this);" type="file" class="file-upload-browse btn btn-default"  name="image3" id="" >
                                            </span>
                                            </div>
                                            <img class="img-responsive img-thumbnail" src="https://endlessicons.com/wp-content/uploads/2012/12/add-icon-614x460.png"  id="img3"  alt="No Image Selected">
                                        </div>


                                    <div class="col-lg-3 col-md-4 col-sm-2 col-xs-12">
                                        <div class="input-group col-xs-12">
                                        <span class="input-group-append">
                                        <input class="img4"  onchange="previewFile4(this);" type="file" class="file-upload-browse btn btn-default"  name="image4" id="fileToUploads" >
                                        </span>
                                        </div>
                                        <img class="img-responsive img-thumbnail" src="https://endlessicons.com/wp-content/uploads/2012/12/add-icon-614x460.png"  id="img4"  alt="No Image Selected">
                                    </div>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" type="submit">Upload </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('scripts')
<script src="{{asset('plugins/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('long_desc')
</script>
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

function previewFile2(input){
    var file = $(".img2").get(0).files[0];


    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#img2").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


function previewFile3(input){
    var file = $(".img3").get(0).files[0];


    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#img3").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


function previewFile4(input){
    var file = $(".img4").get(0).files[0];


    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#img4").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}


</script>
@endsection