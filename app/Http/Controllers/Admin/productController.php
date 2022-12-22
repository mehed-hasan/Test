<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;

class productController extends Controller
{

    public function upload_product(){
        $allCats= DB::table('all_cats')->orderBy('id','Asc')->get();
        $colorDatas= DB::table('colors')->orderBy('id','desc')->get();
        $sizeDatas= DB::table('sizes')->orderBy('id','desc')->get();
        $brandDatas = DB::table('brands')->orderBy('id','desc')->get();
        $units = DB::table('units')->orderBy('id','desc')->get();
        $tags = DB::table('tags')->orderBy('id','desc')->get();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();

        return view('admin/upload_product')->withAllCats($allCats)->withColorDatas($colorDatas)->withSizeDatas($sizeDatas)->withBrandDatas($brandDatas)
        ->withUnits($units)->withTags($tags)->withTorders($torders)->withQtyalarm($qtyalarm);
    }


    public function insert_product(Request $request){

        $today = Carbon::today();

        $request->validate([
           'product_name' => 'required|max:100',
           'sku' => 'required',
           'all_cat_name' => 'required',
           'buying_price'=>'max:10000000',
           'before_price'=>'max:10000000',
           'recent_price' => 'required|max:10000000',
           'quantity' => 'max:10000',
           'unit_name'=>'required',
           'shipping'=>'required',
           'tag_name'=>'required',
           'point'=>'required',
           'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'short_desc' => 'required|max:4000'
       ]);


               
               //path upload

               $combine_cat_name = $request->input('all_cat_name');
               $combine_cat_name = explode(" >> ", $combine_cat_name);
               $cat_number = count($combine_cat_name );

               $cat_name = '';
               $sub_cat = '';
               $sub_sub_cat = '';

               if($cat_number == 1){
                $cat_name = $combine_cat_name[0];
               }

               if($cat_number == 2){
                $cat_name = $combine_cat_name[0];
                $sub_cat = $combine_cat_name[1];
               }
               
               if($cat_number == 3){
                $cat_name = $combine_cat_name[0];
                $sub_cat = $combine_cat_name[1];
                $sub_sub_cat = $combine_cat_name[2];
               }


                  $is_inserted =  DB::table('products')->insert([
                       'p_name'=>$request->input('product_name'),
                       'sku' => $request->input('sku'),
                       'cat_name' => $cat_name,
                       'sub_cat' => $sub_cat,
                       'sub_sub_cat' => $sub_sub_cat,
                       'buying_price'=>$request->input('buying_price'),
                       'before_price'=> $request->input('before_price'),
                       'recent_price'=>$request->input('recent_price'),
                       'unit' => $request->input('unit_name'),
                       'point'=>$request->input('point'),
                       'tag'=>$request->input('tag_name'),  
                       'shiping_day'=>$request->input('shipping'),            
                       'color'=>$request->input('color_name'),
                       'size'=>$request->input('size_name'),
                       'brand'=>$request->input('brand_name'),
                       'stock'=>$request->input('stock'),
                       'uploaded_by'=>$request->input('uploaded_by'),
                       'short_desc'=>$request->input('short_desc'),
                       'long_desc'=>$request->input('long_desc'),
                       'created_at'=> $today
                   ]);


                   if($is_inserted){    

                    // Store images data and upload image files 
                                    
                            $image1= $request->file('image1');
                            $image2= $request->file('image2');
                            $image3= $request->file('image3');
                            $image4= $request->file('image4');

                            if($image1){
                                $imageName1 = $image1->getClientOriginalName(); 
                            }else{
                                $imageName1 = 'null';
                            }
                
                            if($image2){
                                $imageName2 = $image2->getClientOriginalName();                                    
                            }else{
                                $imageName2 = 'null';
                            }
                
                            if($image3){
                                $imageName3 = $image3->getClientOriginalName();  
                            }else{
                                $imageName3 = 'null';
                            }
                
                            if($image4){
                                $imageName4 = $image4->getClientOriginalName(); 
                            }else{
                                $imageName4 = 'null';
                            }


                            $last_row = DB::table('products')->orderBy('id','desc')->first();
                            $get_id = $last_row->id;
                            $insert_img =  DB::table('products_img')->insert([

                                'p_code'=>$get_id,
                                'image1'=>$imageName1,
                                'image2'=>$imageName2,
                                'image3'=>$imageName3,
                                'image4'=>$imageName4,
                            ]);

                            if($insert_img){

                                    if($image1){$image1->move('uploads/product_images',$imageName1);}
                                    if($image2){$image2->move('uploads/product_images',$imageName2);}
                                    if($image3){$image3->move('uploads/product_images',$imageName3);}
                                    if($image4){$image4->move('uploads/product_images',$imageName4);}                  
                            }

                              else{

                                session()->flash('error_message', 'Problem happens to upload images  !');
                                return redirect('/admin/upload_product');
            
                               }
                            

                   }else{

                    session()->flash('error_message', 'Problem happens to update product data !');
                    return redirect('/admin/upload');

                   }


    session()->flash('message', 'New product uploaded successfully !');
    return redirect('/admin/upload');

    }



    public function product_list(){
        $datas= DB::table('products')->orderBy('id','desc')->get();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $imageDatas = DB::table('products_img')->orderBy('id','desc')->get();
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();

        return view('/admin/product_list')->withDatas($datas)->withImageDatas($imageDatas)->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    public function product_view($id){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $datas= DB::table('products')->where('id',$id)->first();
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();

        return view('/admin/product_view')->withDatas($datas)->withTorders($torders);
    }


    public function product_edit($id){
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $allCats= DB::table('all_cats')->orderBy('id','Asc')->get();
        $colorDatas= DB::table('colors')->orderBy('id','desc')->get();
        $sizeDatas= DB::table('sizes')->orderBy('id','desc')->get();
        $units= DB::table('units')->orderBy('id','desc')->get();
        $tags= DB::table('tags')->orderBy('id','desc')->get();
        $brandDatas = DB::table('brands')->orderBy('id','desc')->get();
        $data= DB::table('products')->where('id',$id)->first();
        $images= DB::table('products_img')->where('p_code',$id)->first();
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();


        $combineCat = $data->cat_name;
        $sub_cat = $data->sub_cat;
        $sub_sub_cat = $data->sub_sub_cat;
        if($sub_sub_cat == '' && $sub_cat !== ''){
            $combineCat = $data->cat_name.' >> '.$data->sub_cat;
        }else {
            $combineCat = $data->cat_name.' >> '.$data->sub_cat.' >> '.$data->sub_sub_cat;
        }

        //Fetching product images 
            $image1 = $images->image1;
            $image2 = $images->image2;
            $image3 = $images->image3;
            $image4 = $images->image4;
        
        return view('/admin/product_edit')->withCombineCat($combineCat)->withData($data)->withAllCats($allCats)->withColorDatas($colorDatas)->withSizeDatas($sizeDatas)->withBrandDatas($brandDatas)
        ->withImage1($image1)->withImage2($image2)->withImage3($image3)->withImage4($image4)->withUnits($units)->withTags($tags)->withTorders($torders)->withQtyalarm($qtyalarm);
    }



    public function product_update(Request $request,$id,$prev_image1,$prev_image2,$prev_image3,$prev_image4){
        $today = Carbon::today();

        $request->validate([
            'product_name' => 'required|max:100',
            'sku' => 'required',
            'all_cat_name' => 'required',
            'before_price'=>'max:10000000',
            'recent_price' => 'required|max:10000000',
            'quantity' => 'max:10000',
            'unit_name'=>'required',
            'shipping'=>'required',
            'tag_name'=>'required',
            'point'=>'required',
            'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_desc' => 'required|max:4000'
       ]);


               
               //path upload

               $combine_cat_name = $request->input('all_cat_name');
               $combine_cat_name = explode(" >> ", $combine_cat_name);
               $cat_number = count($combine_cat_name );

               $cat_name = '';
               $sub_cat = '';
               $sub_sub_cat = '';

               if($cat_number == 1){
                $cat_name = $combine_cat_name[0];
               }

               if($cat_number == 2){
                $cat_name = $combine_cat_name[0];
                $sub_cat = $combine_cat_name[1];
               }
               
               if($cat_number == 3){
                $cat_name = $combine_cat_name[0];
                $sub_cat = $combine_cat_name[1];
                $sub_sub_cat = $combine_cat_name[2];
               }


                   DB::table('products')->where('id',$id)->update([
                    'p_name'=>$request->input('product_name'),
                    'sku' => $request->input('sku'),
                    'cat_name' => $cat_name,
                    'sub_cat' => $sub_cat,
                    'sub_sub_cat' => $sub_sub_cat,
                    'before_price'=> $request->input('before_price'),
                    'recent_price'=>$request->input('recent_price'),
                    'unit' => $request->input('unit_name'),
                    'point'=>$request->input('point'),
                    'tag'=>$request->input('tag_name'),  
                    'shiping_day'=>$request->input('shipping'),            
                    'color'=>$request->input('color_name'),
                    'size'=>$request->input('size_name'),
                    'brand'=>$request->input('brand_name'),
                    'stock'=>$request->input('stock'),
                    'uploaded_by'=>$request->input('uploaded_by'),
                    'short_desc'=>$request->input('short_desc'),
                    'long_desc'=>$request->input('long_desc'),
                       'updated_at'=> $today
                   ]);



                    // Store images data and upload image files 
                                    
                            $image1= $request->file('image1');
                            $image2= $request->file('image2');
                            $image3= $request->file('image3');
                            $image4= $request->file('image4');

                            if($image1){
                                $imageName1 =uniqid().$image1->getClientOriginalName(); 
                                    if(file_exists('uploads/product_images/'.$prev_image1)){
                                        @unlink('uploads/product_images/'.$prev_image1);
                                        $image1->move('uploads/product_images/',$imageName1);  
                                    }else{
                                        $image1->move('uploads/product_images/',$imageName1); 

                                    }

                            }else{
                                $imageName1 = $prev_image1;
                            }
                
                            if($image2){
                                    $imageName2 = $image2->getClientOriginalName(); 
                                    if(file_exists('uploads/product_images/'.$prev_image2)){
                                        @unlink('uploads/product_images/'.$prev_image2);
                                        $image2->move('uploads/product_images/',$imageName2);  
                                    }else{
                                        $image2->move('uploads/product_images/',$imageName2);  
                                    }                                   
                            }else{
                                $imageName2 = $prev_image2;
                            }
                
                            if($image3){
                                $imageName3 = $image3->getClientOriginalName();  
                                if(file_exists('uploads/product_images/'.$prev_image3)){
                                    @unlink('uploads/product_images/'.$prev_image3);
                                    $image3->move('uploads/product_images/',$imageName3);  
                                    
                                }else{
                                    $image3->move('uploads/product_images/',$imageName3);  
                                }  
                            }else{
                                $imageName3 = $prev_image3;
                            }
                
                            if($image4){
                                $imageName4 = $image4->getClientOriginalName(); 
                                if(file_exists('uploads/product_images/'.$prev_image4)){
                                    @unlink('uploads/product_images/'.$prev_image4);
                                    $image4->move('uploads/product_images/',$imageName4);  

                                }else{
                                    $image4->move('uploads/product_images/',$imageName4);  
                                }  
                            }else{
                                $imageName4 = $prev_image4;
                            }


                             DB::table('products_img')->where('p_code', $id)->update([
                                'image1'=>$imageName1,
                                'image2'=>$imageName2,
                                'image3'=>$imageName3,
                                'image4'=>$imageName4,
                            ]);


                            



    session()->flash('message', 'Product updated successfully !');
    return redirect('/admin/product_edit/'.$id);
    }
    


    public function product_delete(Request $request){
        $id = $request->input('delete_id');
        DB::table('products')->where('id',$id)->delete();


        $datas= DB::table('products_img')->where('p_code',$id)->first();
        $image1 = $datas->image1;
        $image2 = $datas->image2;
        $image3 = $datas->image3;
        $image4 = $datas->image4;

        if(file_exists('uploads/product_images/'.$image1 )){
            @unlink('uploads/product_images/'.$image1 );
        }else{
        }

        if(file_exists('uploads/product_images/'.$image2 )){
            @unlink('uploads/product_images/'.$image2 );
        }else{
        }

        if(file_exists('uploads/product_images/'.$image3 )){
            @unlink('uploads/product_images/'.$image3 );
        }else{
        }

        if(file_exists('uploads/product_images/'.$image4 )){
            @unlink('uploads/product_images/'.$image4 );
        }else{
        }


        DB::table('products_img')->where('p_code',$id )->delete();

        session()->flash('message', 'Product deleted successfully .');
        return redirect('/admin/product_list/');


    }

    public function make_featured(Request $request){
        $p_id = $request->input('p_id');
        $is_featured= DB::table('products')->where('id',$p_id)->first();
        $is_featured = $is_featured->is_featured;
        
        if($is_featured == 1){
            DB::table('products')->where('id',$p_id)->update([
                'is_featured'=> 0
            ]);

            session()->flash('message', 'Product re-marked as unfeatured !');
            return redirect('/admin/product_list');
        }
        
        else{
            DB::table('products')->where('id',$p_id)->update([
                'is_featured'=> 1
            ]);

            session()->flash('message', 'Product marked as featured !');
            return redirect('/admin/product_list');
        }

    }

    public function add_product_page($id){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $pid = $id;
        return view('admin/add_product')->withPid($pid)->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    public function add_product(Request $request){
        $id = $request->input('id');
        $qty = $request->input('qty');

        $pInfo = DB::table('products')->where('id',$id)->first();
        $pQty = $pInfo->stock;
        $newQty = $pQty + $qty;

        DB::table('products')->where('id',$id)->update([
            "stock" =>$newQty
        ]);

        session()->flash('message', 'Product added successfully !');
        return redirect('/admin/product_list');
    }




}
