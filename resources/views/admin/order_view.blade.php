

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
                            <h2><strong>Order </strong> Details</h2>
                            <br>
                            <p>Ordered by {{$userName}}</p>
                            <p>Total Items ({{$totalItem }})</p>
                            <p>Total Products ({{$totalProduct}})</p>
                            <p>Invoice No : #{{$invoiceno}}</p>
                            <p>Shipping address: {{$addr == '' ? ' Did not updated address ' : $addr}}</p>
                            <p>Reciving time: {{$dlvtime}}</p>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                     
                        <div class="row clearfix">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="body">
                                        <div class="table-responsive">
                                            <table class="table table-hover c_table">
                                                <thead>
                                                    <tr>
                                                        <th>product name</th>
                                                        <th>Product Image</th>
                                                        <th>Color</th>
                                                        <th>Qty</th>
                                                        <th>Selling Price</th>
                                                        <th>Profite</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDatas as $orderData )
                                                    <tr>
                                                        <td>{{$orderData->p_name}}</td>
                                                        <td style="width:10px; height:10px;"><img src="{{asset('uploads/product_images/'.$orderData->image1)}}" alt="" srcset=""></td>
                                                        <td>{{$orderData->color}}</td>
                                                        <td>{{$orderData->qty}}</td>
                                                        <td>{{$orderData->t_selling_price}}</td>
                                                        <td>{{$orderData->t_selling_price - $orderData->t_buying_price }}</td>
                                                        <td>--</td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td>--</td>
                                                        <td>--</td>
                                                        <td>--</td>
                                                        <td>{{$totalProduct}}</td>
                                                        <td>{{$tSellingPrice }}</td>
                                                        <td>{{$profite}}</td>
                                                        
                                                        <td>
                                                            <a class="btn btn-info print" >print </a>
                                                            @if ($orderStatus == 2)
                                                                <p class="badge badge-primary"> Completed </p>
                                                            @else
                                                            <a href="/admin/inprocess/{{$invoiceno}}/{{$userid}}" class="btn btn-warning" href="">In process </a>

                                                            <a href="/admin/delivered/{{$invoiceno}}/{{$userid}}" class="btn btn-success" href="">Ensure Delivery </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
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

$(".print").click(function(){
    window.print();
})
    </script>
@endsection