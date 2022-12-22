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
                            <h2><strong>Edit </strong> Info</h2>
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

                            <form action="/admin/update_info/{{$datas->id}}/{{$datas->logo}}" enctype="multipart/form-data" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <input value="{{$datas->contact_no}}" type="text" placeholder="Contact No "  minlength="11" maxlength="34"  type="text" class="form-control" placeholder="Heading  " name="contact_no" >
                                </div>
                                <div class="form-group form-float">
                                    <input value="{{$datas->email}}" Type="email" placeholder="Email "  minlength="5" maxlength="34"  type="text" class="form-control" placeholder="Heading  " name="email" >
                                </div>

                                <div class="form-group form-float">
                                    <input value="{{$datas->address}}" Type="text" placeholder="Address "  maxlength="200"  type="text" class="form-control"  name="address" >
                                </div>
                                <div class="form-group form-float">
                                    <input value="{{$datas->open_hour}}" Type="text" placeholder="Office Hour"  maxlength="200"  type="text" class="form-control"  name="open_hour" >
                                </div>
                                <br>
                                <p>Upload logo </p>
                                <div class="row preview">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                         <div class="input-group col-xs-12">
                                            <span class="input-group-append">
                                            <input class="img1" name="logo"  onchange="previewFile(this);" type="file" class="file-upload-browse btn btn-default"   id="fileToUploads" >
                                            </span>
                                          </div>
                                          <img style="max-width: 250px;" class="img-responsive img-thumbnail" src=" {{$datas->logo == 'null' ? asset('uploads/logo/default_logo/add_logo.png')  : asset('uploads/logo/'.$datas->logo)  }} "  id="img1"  alt="No Image Selected">
                                      </div>
                                </div>
                                <br>
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