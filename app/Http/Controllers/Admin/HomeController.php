<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/auth/login');
    }


    public function admin_register(){
        return view('admin/auth/register');
    }
 
    public function admin_home(){
        $today = Carbon::today();

        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $customers = DB::table('users')->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $activeProducts = DB::table('products')->where('status','active')->count();
        $vpdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->orderBy('viewed','desc')->limit(5)->get();
        $orderDatas = DB::table('users')->join('invoices', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.user_id','desc')->get();

        $activeProducts = DB::table('products')->where('status','active')->count();
        $inactiveProducts = DB::table('products')->where('status','inactive')->count();
        $featuredProducts = DB::table('products')->where('is_featured',1)->count();
        $allProducts = DB::table('products')->count();
        


        $recentreviews = DB::table('reviews')->limit(5)->get();
        return view('admin/home')->withOrderDatas($orderDatas)->withCustomers($customers)->withTorders($torders)->withVpdatas($vpdatas)
        ->withActiveProducts($activeProducts)->withRecentreviews($recentreviews)->withTorders($torders )->withQtyalarm($qtyalarm)
        ->withInactiveProducts($inactiveProducts)->withFeaturedProducts($featuredProducts)->withAllProducts($allProducts);
        
        
    }

    public function admin_list(){

        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $adatas = DB::table('admins')->get();
        return view('admin/admin_list')->withTorders($torders )->withQtyalarm($qtyalarm)->withAdatas($adatas);
    }

    public function user_list(){

        $udatas = DB::table('users')->get();
        return view('admin/user_list')->withUdatas($udatas);
    }



    public function orders(){

        $orderDatas = DB::table('users')->join('invoices', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.user_id','desc')->get();
        return view('admin/orders')->withOrderDatas($orderDatas);
    }

    public function invoice_list(){
        $orderDatas = DB::table('users')->join('invoices', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.user_id','desc')->get();
        return view('admin/invoice_list')->withOrderDatas($orderDatas);
    }


    
    public function order_details($order_id, $user_id){
        $user_info = DB::table('users')->where('id', $user_id)->first();
        $userName = $user_info->name;
        $userid = $user_id;
        $invoiceno =$order_id;
        $addr = $user_info->addr;
        $dlvtime = $user_info->dlv_time;
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $orderDatas  = DB::table('orders')->join('products', 'orders.p_id', '=', 'products.id')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->where('invoice_no', $order_id)->get();

        $totalItem  = DB::table('orders')->where('invoice_no', $order_id)->count();
        $totalProduct  = DB::table('orders')->where('invoice_no', $order_id)->sum('qty');

        //Calculate profite
        $tSellingPrice  = DB::table('orders')->where('invoice_no', $order_id)->sum('t_selling_price');
        $tBuyingPrice  = DB::table('orders')->where('invoice_no', $order_id)->sum('t_buying_price');
        $profite = $tSellingPrice - $tBuyingPrice;

        $orderStatus = DB::table('invoices')->where('id', $order_id)->first();
        $orderStatus  = $orderStatus->is_ordered;
        

        return view('admin/order_view')->withAddr($addr)->withOrderDatas($orderDatas)->withUserName($userName)->withInvoiceno($invoiceno)->withTotalItem($totalItem)
        ->withTotalItem($totalItem)->withTotalProduct($totalProduct)->withTSellingPrice($tSellingPrice)->withProfite($profite)
        ->withOrderStatus($orderStatus)->withUserid($userid)->withDlvtime($dlvtime);
    }

    public function invoice_view($order_id, $user_id){
        $user_info = DB::table('users')->where('id', $user_id)->first();
        $userName = $user_info->name;
        $userid = $user_id;
        $invoiceno =$order_id;
        $addr = $user_info->addr;
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $orderDatas  = DB::table('orders')->join('products', 'orders.p_id', '=', 'products.id')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->where('invoice_no', $order_id)->get();

        $totalItem  = DB::table('orders')->where('invoice_no', $order_id)->count();
        $totalProduct  = DB::table('orders')->where('invoice_no', $order_id)->sum('qty');

        //Calculate profite
        $tSellingPrice  = DB::table('orders')->where('invoice_no', $order_id)->sum('t_selling_price');

        $orderStatus = DB::table('invoices')->where('id', $order_id)->first();
        $orderStatus  = $orderStatus->is_ordered;
        

        return view('admin/invoice_view')->withAddr($addr)->withOrderDatas($orderDatas)->withUserName($userName)->withInvoiceno($invoiceno)->withTotalItem($totalItem)
        ->withTotalItem($totalItem)->withTotalProduct($totalProduct)->withTSellingPrice($tSellingPrice)->withOrderStatus($orderStatus)->withUserid($userid);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function create_payment_page(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();

        return view('admin/create_payment')->withQtyalarm($qtyalarm)->withTorders($torders )  ;
    }

    public function create_payment(Request $request){

        $today = Carbon::today();

        $request->validate([
           'methods'=>'required|unique:methods,methods_name',
           'no'=>'required'

       ]);

                   
                   DB::table('methods')->insert([
                       'methods_name'=> $request->input('methods'),
                       'no'=>$request->Input('no'),
                       'created_at' => $today
                   ]);


                   session()->flash('message', 'Methdod Added Succcessfully .');
                   return redirect('/admin/create_payment_page');

    }





    public function edit_payment_page($id){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
    
        return view('admin/edit_payment')->withQtyalarm($qtyalarm)->withTorders($torders )  ;
    }
    

    public function method_list(){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('methods')->orderBy('id','desc')->get();

        return view('/admin/method_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );
    }

    public function delete_method(Request $request){
        $id = $request->input('delete_id');

        DB::table('methods')->where('id',$id)->delete();

        session()->flash('message', 'Methods deleted successfully .');
        return redirect('/admin/method_list/');


    }

    public function reloader_list(){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('users')->where('tranx','!=', '')->get();
        return view('/admin/reloader_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );

    }

    public function reloader_approve ($id, $amount){

        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('users')->where('tranx','!=', '')->get();


        $get_balance = DB::table('users')->where('id',$id)->first();
        $prev_balance = $get_balance->balance; 
        $new_bal =  $prev_balance + $amount;
        
        //Dismiss application
        DB::table('users')->where('id',$id)->update([
            "tranx" => '',
            "tranx_amount" => 0,
            "balance" =>  $new_bal
        ]);

        session()->flash('message', 'Approved successfully .');
        return redirect('/admin/reloader_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );
    }


    
    public function withdraw_approve ($id){

        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('users')->where('tranx','!=', '')->get();

        
        //Dismiss application
        DB::table('users')->where('id',$id)->update([
            "withdrawable" => 0,
            "withdraw_applied_on"=>''
        ]);

        session()->flash('message', 'Approved successfully .');
        return redirect('/admin/withdraw_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );
    }

    public function withdraw_list(){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('users')->where('withdraw_applied_on','=', 'applied')->get();
        return view('/admin/withdraw_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );

    }

    public function admin_withdraw(){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();

        return view('admin/admin_withdraw')->withQtyalarm($qtyalarm)->withTorders($torders );
    }

    public function withdraw(Request $request){

       $amount = $request->input('amount');
       $get_account =  DB::table('accounts')->first();
       $bal = $get_account->bal;
       $new_bal = $bal-$amount;

       DB::table('accounts')->update([
         "bal" => $new_bal
       ]);

       session()->flash('message', 'Balance withdrawn successfully .');
       return redirect('/admin/home');
    }


    public function toc(){
        $datas = DB::table('tocs')->first();
        $text = $datas->text;

        return view('admin/toc')->withText($text);
    }

    public function privacy_policy(){
        $datas = DB::table('privacy_policies')->first();
        $text = $datas->text;

        return view('admin/privacy_policy')->withText($text);
    }

    public function return_policy(){
        $datas = DB::table('return_policies')->first();
        $text = $datas->text;

        return view('admin/return_policy')->withText($text);
    }

    public function toc_update(Request $request){

 
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $text = $request->input('text');
        
        $datas = DB::table('tocs')->first();
        $id = $datas->id;

        $today = Carbon::today();

        $request->validate([
           'text'=>'required'
       ]);

       DB::table('tocs')->where('id',$id)->update([
            'text' => $text,
            'updated_at'=>$today
       ]);           

        session()->flash('message', 'Saved Succcessfully .');
        return redirect('admin/toc');
    
    }
    


    public function privacy_policy_update (Request $request){

 
        $text = $request->input('text');
        
        $datas = DB::table('privacy_policies')->first();
        $id = $datas->id;
    
        $today = Carbon::today();
    
        $request->validate([
           'text'=>'required'
       ]);
    
       DB::table('privacy_policies')->where('id',$id)->update([
            'text' => $text,
            'updated_at'=>$today
       ]);           
    
        session()->flash('message', 'Saved Succcessfully .');
        return redirect('admin/privacy_policy');
    
    }
    



    public function return_policy_update(Request $request){
    
     

        $text = $request->input('text');
        
        $datas = DB::table('return_policies')->first();
        $id = $datas->id;
    
        $today = Carbon::today();
    
        $request->validate([
           'text'=>'required'
       ]);
    
       DB::table('return_policies')->where('id',$id)->update([
            'text' => $text,
            'updated_at'=>$today
       ]);           
    
        session()->flash('message', 'Saved Succcessfully .');
        return redirect('admin/return_policy');
    
    }


    public function local_sell_page(){
        return view('admin/local_sell_page');
    }
    
    }
    
    
    
    
    






