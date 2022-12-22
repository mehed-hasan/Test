<script>



function add_to_cart_once($p_id){
        $.ajax({
                url:'/add_to_cart_once',
                // datatype: "html",
                type: "get",
                data:{
                    p_id:$p_id
                },
                beforeSend: function () {
                    // $('.auto-load').show();
                    $(this).hide();
                }
            })
            .done(function (response) {
                if(response == 'redirect'){
                    window.location.href = "{{ route('login')}}";
                }else if( response == 'carted'){

                    iziToast.warning({
                        title: 'Note:',
                        message: 'This item alredy into bag.',
                        position: 'topRight'
                    });
               
                }
                else{
                    $datas = response.split("@");
                    $carted = $datas[0];
                    $total_bill = $datas[1];
                    $top_cart_dom = $datas[2];
                    $(".c_qty").text($carted );
                    $(".sub-total, .stt-price").text("Tk "+$total_bill);
                    $(".products").empty();
                    $(".products").append($top_cart_dom );
                    iziToast.success({
                        title: 'Note:',
                        message: 'Added into bag.',
                        position: 'topRight'
                    });
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }


    function add_to_cart($p_id){
        $.ajax({
                url:'/add_to_cart',
                // datatype: "html",
                type: "get",
                data:{
                    p_id:$p_id
                },
                beforeSend: function () {
                    // $('.auto-load').show();
                    $(this).hide();
                }
            })
            .done(function (response) {
                if(response == 'redirect'){
                    window.location.href = "{{ route('login')}}";
                }else{

                    $datas = response.split("@");
                    $carted = $datas[0];
                    $total_bill = $datas[1];
                    $update_dom = $datas[2];
                    $top_cart_dom = $datas[3];
                    $(".c_qty, .sub_no").text($carted );
                    $(".sub-total, .stt-price").text("Tk "+$total_bill);
                    $(".cart_data").empty();
                    $(".cart_data").append($update_dom);
                    $(".products").empty();
                    $(".products").append($top_cart_dom );

                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }


    

    function remove_from_cart($p_id){
        $.ajax({
                url:'/remove_from_cart',
                // datatype: "html",
                type: "get",
                data:{
                    p_id:$p_id
                },
                beforeSend: function () {
                    // $('.auto-load').show();
                    $(this).hide();
                }
            })
            .done(function (response) {
                if(response == 'redirect'){
                    window.location.href = "{{ route('login')}}";
                }else{
                    $datas = response.split("@");
                    $carted = $datas[0];
                    $total_bill = $datas[1];
                    $update_dom = $datas[2];
                    $top_cart_dom = $datas[3];
                    $(".c_qty, .sub_no").text($carted );
                    $(".sub-total, .stt-price").text("Tk "+$total_bill);
                    $(".cart_data").empty();
                    $(".cart_data").append($update_dom);
                    $(".products").empty();
                    $(".products").append($top_cart_dom );
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }


</script>