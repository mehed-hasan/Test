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
                            <h2><strong>Edit </strong> social</h2>
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

                            <form action="/admin/update_social/{{$socialDatas->id}}" enctype="multipart/form-data" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <label for="">Facebook Link</label>
                                    <input value="{{$socialDatas->fb}}" type="text" placeholder="Facebook Link" maxlength="500"  type="text" class="form-control" placeholder="Heading  " name="fb_link" >
                                </div>
                                <label for="">Instagram link</label>
                                <div class="form-group form-float">
                                    <input value="{{$socialDatas->insta}}" Type="text" placeholder="Instagram link"   maxlength="500"  type="text" class="form-control" placeholder="Heading  " name="insta_link" >
                                </div>

                                <label for="">Instagram link</label>
                                <div class="form-group form-float">
                                    <input value="{{$socialDatas->printer}}" Type="text" placeholder="Printerest Link "  maxlength="500"  type="text" class="form-control"  name="printer_link" >
                                </div>

                                <label for="">Twitter Link</label>
                                <div class="form-group form-float">
                                    <input value="{{$socialDatas->twitter}}" Type="text" placeholder="Twitter Link"  maxlength="500"  type="text" class="form-control"  name="twitter_link" >
                                </div>

                                <label for="">Youtube Link</label>
                                <div class="form-group form-float">
                                    <input value="{{$socialDatas->yt}}" Type="text" placeholder="Youtube Link"  maxlength="500"  type="text" class="form-control"  name="yt_link" >
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
