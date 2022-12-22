<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class productViewController extends Controller
{
    public function category($id, $requiredCat){

        
        // Cart datas 
        $allProducts= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('cat_name',$requiredCat)->orderBy('products.id','desc')->paginate(8);       
        $allProductsSubCcat= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('sub_cat',$requiredCat)->orderBy('products.id','desc')->get();
        $subCatDatas= DB::table('subcats')->where('id', $id)->orderBy('id','desc')->get();
        $allCats = DB::table('subcats')->where('cat_name', $requiredCat)->get();
        $fColors= DB::table('products')->select('color')->where('cat_name',$requiredCat)->distinct()->get();
        $fBrands= DB::table('products')->select('brand')->where('cat_name',$requiredCat)->distinct()->get();
        $fSizes= DB::table('products')->select('size')->where('cat_name',$requiredCat)->distinct()->get();


        return view ('category_view')->withSubCatDatas($subCatDatas)->withFColors($fColors)->withFSizes($fSizes)
        ->withAllProducts($allProducts)->withAllCats($allCats)->withRequiredCat($requiredCat)->withCatName($requiredCat)->withFBrands($fBrands);
        
    }


    public function sub_category($id, $requiredCat){

        $allProducts= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('sub_cat',$requiredCat)->orderBy('products.id','desc')->paginate(8); 
        $subSubCatDatas= DB::table('subsubcats')->where('id', $id)->orderBy('id','desc')->get();
        $filters= DB::table('products')->where('sub_cat',$requiredCat)->distinct('color')->get();
        $subCatDatas= DB::table('subcats')->where('id', $id)->orderBy('id','desc')->first();
        $allCats = DB::table('subsubcats')->where('sub_cat', $requiredCat)->get();

        $fColors= DB::table('products')->select('color')->where('sub_cat',$requiredCat)->distinct()->get();
        $fBrands= DB::table('products')->select('brand')->where('sub_cat',$requiredCat)->distinct()->get();
        $fSizes= DB::table('products')->select('size')->where('sub_cat',$requiredCat)->distinct()->get();


        return view ('sub_category_view')->withSubSubCatDatas($subSubCatDatas)->withSubCatDatas($subCatDatas)
        ->withAllProducts($allProducts)->withFilters($filters)->withAllCats($allCats)->withFColors($fColors)->withFBrands($fBrands)->withFSizes($fSizes);
    }

    public function sub_sub_category($id, $requiredCat){


        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $allProducts= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('sub_sub_cat',$requiredCat)->orderBy('products.id','desc')->paginate(8);
        $allCats = DB::table('subsubcats')->where('cat_name', $requiredCat)->get();
        $subsubCatDatas= DB::table('subsubcats')->where('id', $id)->orderBy('id','desc')->first();

        $fColors= DB::table('products')->select('color')->where('sub_sub_cat',$requiredCat)->distinct()->get();
        $fBrands= DB::table('products')->select('brand')->where('sub_sub_cat',$requiredCat)->distinct()->get();
        $fSizes= DB::table('products')->select('size')->where('sub_sub_cat',$requiredCat)->distinct()->get();


        return view ('sub_sub_category_view')->withCatDatas($catDatas)->withSubsubCatDatas($subsubCatDatas) 
        ->withAllProducts($allProducts)->withAllCats($allCats)->withFColors($fColors)
        ->withFBrands($fBrands)->withFSizes($fSizes);
    }


    public function single_product_view($id){
    
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }
        // Cart datas 
        $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
        $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');

        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();
        }else {
            $totalWishlist =0;
        }
        

        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $pDetails= DB::table('products')->where('id',$id)->orderBy('id','desc')->first();

                //Inserting data to count how much view it has ----------------
                $past_viewed = $pDetails->viewed;
                $p_id = $pDetails->id;
                $updated_view = $past_viewed + 1;
                DB::table('products')->where('id',$p_id)->update([
                    'viewed'=> $updated_view
                ]);
        
                //Inserting data to count how much view it has ended  ----------------

                
                

        $pImage= DB::table('products_img')->where('p_code',$id)->orderBy('id','desc')->first();
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first(); 
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        $get_sub_sub_cat = $pDetails->sub_sub_cat;

        $image1 = $pImage->image1;
        $image2 = $pImage->image2;
        $image3 = $pImage->image3;
        $image4 = $pImage->image4;

        
        $is_any_ordered = DB::table('orders')->where('user_id',$user_id)->count();
        if($is_any_ordered > 0){
            $reviewd = DB::table('orders')->where('p_id', $id)->where('user_id',$user_id)->where('is_reviewed',1)->count();
        }else{
            
            $reviewd =0;
        }

        $all_reviewed = DB::table('orders')->where('p_id', $id)->where('is_reviewed',2)->count();
        if($all_reviewed > 0){
            $treview = DB::table('orders')->where('p_id', $id)->where('is_reviewed',2)->count();
        }else {
            $treview = 0;
        }
        

        $tstar = DB::table('reviews')->where('p_id',$p_id)->sum('star');

        if($treview == 0){
            $avgreview = 0;
        }
        else {
            $avgreview = $tstar/$treview;
        }

        $fivestars=0;
        $fourestars=0;
        $threestars=0;
        $twostars = 0;
        $onestars = 0;

        if($treview > 0 ){
                    // specific stars 
        $fivestars = DB::table('reviews')->where('p_id', $id)->where('star', 5)->count();
        $fivestars = $fivestars/$treview * 100;
        $fourestars = DB::table('reviews')->where('p_id', $id)->where('star', 4)->count();
        $fourestars = $fourestars/$treview * 100;
        $threestars = DB::table('reviews')->where('p_id', $id)->where('star', 3)->count();
        $threestars= $threestars/$treview *100;
        $twostars = DB::table('reviews')->where('p_id', $id)->where('star', 2)->count();
        $twostars = $twostars / $treview *100;
        $onestars = DB::table('reviews')->where('p_id', $id)->where('star', 1)->count();
        $onestars = $onestars / $treview * 100;
        }

        $reviews= DB::table('reviews')->paginate(5);

        $relatedProducts = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('sub_sub_cat',$get_sub_sub_cat)->where('products.id', '!=', $id)->orderBy('products.id','desc')->get();
        return view ('single_product')->withPDetails($pDetails)->withImage1($image1)->withImage2($image2)->withImage3($image3)->withImage4($image4)->withInfoDatas($infoDatas)->withCatDatas($catDatas)
        ->withRelatedProducts($relatedProducts)->withSocialDatas($socialDatas)->withLinkDatas($linkDatas)->withTotalWishlist($totalWishlist)->withReviewd($reviewd)
        ->withReviews($reviews)->withTreview($treview)->withAvgreview($avgreview)->withFivestars($fivestars)->withFourestars($fourestars)->withThreestars($threestars)
        ->withTwostars($twostars)->withOnestars($onestars)->withCarteds($carteds)->withCartedbill($cartedbill);

    }


    
}
