<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceUpdation;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Item;
use App\Models\PurchaseEntry;
use App\Models\PurchaseEntryItem;
use App\Models\PurchaseEntryExpense;
use App\Models\PurchaseEntryTax;
use Illuminate\Support\Facades\Redirect;

class PriceUpdationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $updations = PriceUpdation::where('status',1)->get();
        return View('admin.price_updation.view',compact('updations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        $item = Item::all();
        $date = date('Y-m-d');

        return view('admin.price_updation.add',compact('category','brand','item','date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $count = $request->table_count;
        $date = $request->date;

        foreach ($request->item_id as $key => $value) 
        {
            $updations = PriceUpdation::where('item_id',$value)->where('status',1)->first();
            if($updations != '')
            {
                $updations->status = 0;
                $updations->save();
            }
            

            $insert = new PriceUpdation();

            $insert->date = $date;
            $insert->item_id = $request->item_id[$key];
            $insert->brand_id = $request->brand_id[$key];
            $insert->category_id = $request->category_id[$key];
            $insert->uom_id = $request->uom_id[$key];
            $insert->mark_up_rs = $request->mark_up_rs[$key];
            $insert->mark_down_rs = $request->mark_down_rs[$key];
            $insert->mark_up_percent = $request->mark_up_percent[$key];
            $insert->mark_down_percent = $request->mark_down_percent[$key];
            $insert->unit_price = $request->last_purchase_cost[$key];
            $insert->tax_rate = $request->tax[$key];
            $insert->last_selling_price = $request->updated_selling_price[$key];
            $insert->selling_price = $request->updated_selling_price[$key];

            $insert->save(); 

        }

        return Redirect::back()->with('success','Saved Successfully');

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
        $updations = PriceUpdation::find($id);

        return view('admin.price_updation.show',compact('updations'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $updations = PriceUpdation::find($id);
        $category = Category::all();
        $brand = Brand::all();
        $item = Item::all();

        return view('admin.price_updation.edit',compact('updations','category','brand','item'));
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
        $update = PriceUpdation::find($id);

        $update->date = $request->date;
        $update->item_id = $request->item_id;
        $update->brand_id = $request->brand_id;
        $update->category_id = $request->category_id;
        $update->uom_id = $request->uom_id;
        $update->mark_up_rs = $request->mark_up_rs;
        $update->mark_down_rs = $request->mark_down_rs;
        $update->mark_up_percent = $request->mark_up_percent;
        $update->mark_down_percent = $request->mark_down_percent;
        $update->unit_price = $request->last_purchase_cost;
        $update->tax_rate = $request->tax;
        $update->selling_price = $request->updated_selling_price;
        $update->selling_price = $request->updated_selling_price;

        $update->save();

        return Redirect::back()->with('success', 'Updated Successfully');
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
        $delete = PriceUpdation::find($id);

        $delete->status = '0';
        $delete->save();

    }

    function child_category($array)
   {
       $output_array=[];
       foreach($array  as $value)
       {
           $result_array=[];
           $result_array['id']=$value->id;
           $output_array[]=$result_array;
             if(count($value->childCategories)>0)
             {
                $test=$this->child_category($value->childCategories);
                array_push($output_array,$test);
             }  
        }
           return $output_array;
   }

    function get_category_id($category_id)
       {
        $category=category::with('childCategories')->where('id',$category_id)->get();
        $output_array=[];
        foreach($category as $value)
        {
            $result_array=[];
            $result_array['id']=$value->id;
            $output_array[]=$result_array;
            if(count($value->childCategories)>0)
            {
                $result=$this->child_category($value->childCategories);
                array_push($output_array,$result);
            }  
        }

    $result=[];
    foreach ($output_array as $key => $value)
    {
        if (is_array($value))
        {
            $result = array_merge($result, array_flatten($value));
        } else
        {
            $result = array_merge($result, array($key => $value));
        }
    }
    //$result=implode("','", $result);
    //$result="'".$result."'";
    return $result;
   }

    public function change_items(Request $request,$id)
    {
        $categories=$request->categories;
        $category_id=$this->get_category_id($categories);
        $brand=$request->brand;
        $result="";
        $item=array();
        if($categories !="" && $brand == "no_val"){
             $item=Item::whereIn('category_id',$category_id)->get();
        }else if($categories !="" && $brand != "" && $brand != "no_val" ){
            $item=Item::whereIn('category_id',$category_id)->where('brand_id',$brand)->get();
        }

        $table_count = count($item);
       
        foreach($item as $key=>$value){
            if($value->brand_id != 0)
            {
                $barnd_name=isset($value->brand->name) ? $value->brand->name : "";
            }
            else
            {
                $barnd_name='Not Applicable';
            }

            $item_data = PurchaseEntryItem::where('item_id',$value->id)
                                    ->orderBy('p_date','DESC')
                                    ->first();

            $last_selling_price = PriceUpdation::where('item_id',$value->id)
                                    ->where('status',1)
                                    ->orderBy('date','DESC')
                                    ->select('selling_price','last_selling_price','mark_up_percent','mark_up_rs','mark_down_percent','mark_down_rs')
                                    ->first();

                                                            

            $unit_price = @$item_data->rate_exclusive_tax;
            $tax = @$item_data->gst;

            $category_name=isset($value->category->name) ? $value->category->name : "";
            $uom_id=isset($value->uom->id) ? $value->uom->id : "";
            $uom_name=isset($value->uom->name) ? $value->uom->name : "";

            $barcode="";
            if(count($value->item_barcode_details)>0){
                $barcode_array=[];
                foreach($value->item_barcode_details as $row){
                    $barcode_array[]=$row->barcode;
                }
                $barcode=implode(",",$barcode_array);
            }
            $result .='<tr class="row_category" id="'.++$key.'"><td><font style="font-family: Times new roman;">'.$key.'</font><input type="hidden" name="table_count" value="'.$table_count.'"></td><td><input type="hidden" value="'.$value->id.'" class="append_item_id'.$key.'" name="item_id[]"><input type="hidden" value="'.$value->code.'" class="actual_item_code'.$key.'" name="item_code[]"><input type="hidden" value="'.$value->code.'" class="append_item_code'.$key.'"><font class="item_code'.$key.'" style="font-family: Times new roman;">'.$value->code.'</font></td><td><input type="hidden" value="'.$value->name.'" class="actual_item_name'.$key.'" name="item_name[]"><input type="hidden" value="'.$value->name.'" class="append_item_name'.$key.'"><font class="item_name'.$key.'" style="font-family: Times new roman;">'.$value->name.'</font></td><td><input type="hidden" value="'.$value->brand_id.'" class="actual_item_brand_name'.$key.'" name="brand_id[]"><input type="hidden" value="'.$value->brand_id.'" class="append_item_brand_name'.$key.'"><font class="item_brand_name'.$key.'" style="font-family: Times new roman;">'.$barnd_name .'</font></td><td><input type="hidden" value="'.$value->category_id.'" class="actual_item_category_name'.$key.'" name="category_id[]"><input type="hidden" value="'.$value->category_id.'" class="append_item_category_name'.$key.'"><font class="item_category_name'.$key.'" style="font-family: Times new roman;">'.$category_name .'</font></td><td><input type="hidden" value="'.$value->hsn.'" class="actual_item_hsn'.$key.'" name="hsn[]"><input type="hidden" value="'.$value->hsn.'" class="append_item_hsn'.$key.'"><font style="font-family: Times new roman;" class="item_hsn'.$key.'">'.$value->hsn.'</font></td><td><input type="hidden" value="'.$value->mrp.'" class="actual_item_mrp'.$key.'" name="mrp[]"><input type="hidden" value="'.$value->mrp.'" class="append_item_mrp'.$key.'"><font class="item_mrp'.$key.'" style="font-family: Times new roman;">'.$value->mrp.'</font></td><td><input type="hidden" value="'.$uom_id.'" class="actual_item_uom'.$key.'" name="uom_id[]"><input type="hidden" value="'.$uom_id.'" class="append_item_uom'.$key.'"><font class="item_uom'.$key.'" style="font-family: Times new roman;">'.$uom_name.'</font></td><td><input type="hidden" class="actual_last_purchase_cost'.$key.'" value="'.$unit_price.'" name="last_purchase_cost[]"><input type="hidden" class="append_last_purchase_cost'.$key.'" value="'.$unit_price.'"><font class="last_purchase_cost'.$key.'">'.$unit_price.'</font></td><td><input type="hidden" class="tax'.$key.'" value="'.$tax.'" name="tax[]"><font class="tax'.$key.'">'.$tax.'</font></td><td><input type="hidden" class="append_mark_up_percent'.$key.'" name="mark_up_percent[]" value="'.$last_selling_price->mark_up_percent.'"><font class="mark_up_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_percent.'</font></td><td><input type="hidden" class="append_mark_up_rs'.$key.'" name="mark_up_rs[]" value="'.$last_selling_price->mark_up_rs.'"><font class="mark_up_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_rs.'</font></td><td><input type="hidden" class="append_mark_down_percent'.$key.'" name="mark_down_percent[]" value="'.$last_selling_price->mark_down_percent.'"><font class="mark_down_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_percent.'</font></td><td><input type="hidden" class="append_mark_down_rs'.$key.'" name="mark_down_rs[]" value="'.$last_selling_price->mark_down_rs.'"><font class="mark_down_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_rs.'</font></td><td><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="actual_item_selling_price'.$key.'" name="last_selling_price[]"><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="append_item_selling_price'.$key.'"><font style="font-family: Times new roman;" class="item_selling_price'.$key.'">'.@$last_selling_price->last_selling_price.'</font></td><td><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="actual_updated_selling_price'.$key.'"><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="append_updated_selling_price'.$key.'" name="updated_selling_price[]"><font style="font-family: Times new roman;" class="updated_selling_price'.$key.'">'.@$last_selling_price->selling_price.'</font></td><td><i class="fa fa-level-up px-2 py-1 bg-danger text-white rounded up" id="'.$key.'" aria-hidden="true"></i>&nbsp;<i class="fa fa-level-down px-2 py-1 bg-warning  text-white rounded down" id="'.$key.'" aria-hidden="true"></i></td></tr>';

            }
         return $result;
        

    }

    public function brand_filter(Request $request,$id)
    {
        
        $brand=$request->brand;
        $categories=$request->categories;
        $category_id=$this->get_category_id($categories);
        $result="";
        $item=array();
        if($brand !="" && $categories == "no_val"){
             $item=Item::where('brand_id',$brand)->get();
        }else if($categories !="" && $brand != "" && $categories != "no_val" ){
            $item=Item::whereIn('category_id',$category_id)->where('brand_id',$brand)->get();
        }

        $table_count = count($item);

        foreach($item as $key=>$value){
            if($value->brand_id != 0)
            {
                $barnd_name=isset($value->brand->name) ? $value->brand->name : "";
            }
            else
            {
                $barnd_name='Not Applicable';
            }

            $item_data = PurchaseEntryItem::where('item_id',$value->id)
                                    ->orderBy('p_date','DESC')
                                    ->first();

            $last_selling_price = PriceUpdation::where('item_id',$value->id)
                                    ->where('status',1)
                                    ->orderBy('date','DESC')
                                    ->select('selling_price','last_selling_price','mark_up_percent','mark_up_rs','mark_down_percent','mark_down_rs')
                                    ->first();                        

            $unit_price = @$item_data->rate_exclusive_tax;
            $tax = @$item_data->gst;

            $category_name=isset($value->category->name) ? $value->category->name : "";
            $uom_id=isset($value->uom->id) ? $value->uom->id : "";
            $uom_name=isset($value->uom->name) ? $value->uom->name : "";

            $barcode="";
            if(count($value->item_barcode_details)>0){
                $barcode_array=[];
                foreach($value->item_barcode_details as $row){
                    $barcode_array[]=$row->barcode;
                }
                $barcode=implode(",",$barcode_array);
            }
            $result .='<tr class="row_category" id="'.++$key.'"><td><font style="font-family: Times new roman;">'.$key.'</font><input type="hidden" name="table_count" value="'.$table_count.'"></td><td><input type="hidden" value="'.$value->id.'" class="append_item_id'.$key.'" name="item_id[]"><input type="hidden" value="'.$value->code.'" class="actual_item_code'.$key.'" name="item_code[]"><input type="hidden" value="'.$value->code.'" class="append_item_code'.$key.'"><font class="item_code'.$key.'" style="font-family: Times new roman;">'.$value->code.'</font></td><td><input type="hidden" value="'.$value->name.'" class="actual_item_name'.$key.'" name="item_name[]"><input type="hidden" value="'.$value->name.'" class="append_item_name'.$key.'"><font class="item_name'.$key.'" style="font-family: Times new roman;">'.$value->name.'</font></td><td><input type="hidden" value="'.$value->brand_id.'" class="actual_item_brand_name'.$key.'" name="brand_id[]"><input type="hidden" value="'.$value->brand_id.'" class="append_item_brand_name'.$key.'"><font class="item_brand_name'.$key.'" style="font-family: Times new roman;">'.$barnd_name .'</font></td><td><input type="hidden" value="'.$value->category_id.'" class="actual_item_category_name'.$key.'" name="category_id[]"><input type="hidden" value="'.$value->category_id.'" class="append_item_category_name'.$key.'"><font class="item_category_name'.$key.'" style="font-family: Times new roman;">'.$category_name .'</font></td><td><input type="hidden" value="'.$value->hsn.'" class="actual_item_hsn'.$key.'" name="hsn[]"><input type="hidden" value="'.$value->hsn.'" class="append_item_hsn'.$key.'"><font style="font-family: Times new roman;" class="item_hsn'.$key.'">'.$value->hsn.'</font></td><td><input type="hidden" value="'.$value->mrp.'" class="actual_item_mrp'.$key.'" name="mrp[]"><input type="hidden" value="'.$value->mrp.'" class="append_item_mrp'.$key.'"><font class="item_mrp'.$key.'" style="font-family: Times new roman;">'.$value->mrp.'</font></td><td><input type="hidden" value="'.$uom_id.'" class="actual_item_uom'.$key.'" name="uom_id[]"><input type="hidden" value="'.$uom_id.'" class="append_item_uom'.$key.'"><font class="item_uom'.$key.'" style="font-family: Times new roman;">'.$uom_name.'</font></td><td><input type="hidden" class="actual_last_purchase_cost'.$key.'" value="'.$unit_price.'" name="last_purchase_cost[]"><input type="hidden" class="append_last_purchase_cost'.$key.'" value="'.$unit_price.'"><font class="last_purchase_cost'.$key.'">'.$unit_price.'</font></td><td><input type="hidden" class="tax'.$key.'" value="'.$tax.'" name="tax[]"><font class="tax'.$key.'">'.$tax.'</font></td><td><input type="hidden" class="append_mark_up_percent'.$key.'" name="mark_up_percent[]" value="'.$last_selling_price->mark_up_percent.'"><font class="mark_up_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_percent.'</font></td><td><input type="hidden" class="append_mark_up_rs'.$key.'" name="mark_up_rs[]" value="'.$last_selling_price->mark_up_rs.'"><font class="mark_up_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_rs.'</font></td><td><input type="hidden" class="append_mark_down_percent'.$key.'" name="mark_down_percent[]" value="'.$last_selling_price->mark_down_percent.'"><font class="mark_down_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_percent.'</font></td><td><input type="hidden" class="append_mark_down_rs'.$key.'" name="mark_down_rs[]" value="'.$last_selling_price->mark_down_rs.'"><font class="mark_down_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_rs.'</font></td><td><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="actual_item_selling_price'.$key.'" name="last_selling_price[]"><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="append_item_selling_price'.$key.'"><font style="font-family: Times new roman;" class="item_selling_price'.$key.'">'.@$last_selling_price->last_selling_price.'</font></td><td><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="actual_updated_selling_price'.$key.'"><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="append_updated_selling_price'.$key.'" name="updated_selling_price[]"><font style="font-family: Times new roman;" class="updated_selling_price'.$key.'">'.@$last_selling_price->selling_price.'</font></td><td><i class="fa fa-level-up px-2 py-1 bg-danger text-white rounded up" id="'.$key.'" aria-hidden="true"></i>&nbsp;<i class="fa fa-level-down px-2 py-1 bg-warning  text-white rounded down" id="'.$key.'" aria-hidden="true"></i></td></tr>';

            }
         return $result;
          

    }


    public function browse_item(Request $request,$id)
   {
    $browse_item = $request->browse_item;
    $brand=$request->brand;
    $categories=$request->categories;
    $category_id=$this->get_category_id($categories);
    $item = array();
    $result ="";

    if($brand == "no_val" && $categories == "no_val" && $browse_item != ""){
             $item=Item::where('id',$browse_item)->get();
        }
        else if($categories !="" && $brand != "" && $categories != "no_val" && $brand != "no_val" && $browse_item != ""){
            $item=Item::whereIn('category_id',$category_id)->where('brand_id',$brand)->where('id',$browse_item)->get();
        }
        else if($categories !="" && $categories != "no_val" && $browse_item != "" && $brand == "no_val"){
            $item=Item::whereIn('category_id',$category_id)->where('id',$browse_item)->get();
        }
        else if($brand !="" && $brand != "no_val" && $browse_item != ""){
            $item=Item::where('id',$browse_item)->where('brand_id',$brand)->get();
        }

        $table_count = count($item);
    
    foreach ($item as $key => $value) 
    {
        if($value->brand_id != 0)
            {
                $barnd_name=isset($value->brand->name) ? $value->brand->name : "";
            }
            else
            {
                $barnd_name='Not Applicable';
            }

            $item_data = PurchaseEntryItem::where('item_id',$value->id)
                                    ->orderBy('p_date','DESC')
                                    ->first();

            $last_selling_price = PriceUpdation::where('item_id',$value->id)
                                    ->where('status',1)
                                    ->orderBy('date','DESC')
                                    ->select('selling_price','last_selling_price','mark_up_percent','mark_up_rs','mark_down_percent','mark_down_rs')
                                    ->first();                        
                                    
            $unit_price = @$item_data->rate_exclusive_tax;
            $tax = @$item_data->gst;
            
            $category_name=isset($value->category->name) ? $value->category->name : "";
            $uom_id=isset($value->uom->id) ? $value->uom->id : "";
            $uom_name=isset($value->uom->name) ? $value->uom->name : "";

            $barcode="";
            if(count($value->item_barcode_details)>0){
                $barcode_array=[];
                foreach($value->item_barcode_details as $row){
                    $barcode_array[]=$row->barcode;
                }
                $barcode=implode(",",$barcode_array);
            }
            $result .='<tr class="row_category" id="'.++$key.'"><td><font style="font-family: Times new roman;">'.$key.'</font><input type="hidden" name="table_count" value="'.$table_count.'"></td><td><input type="hidden" value="'.$value->id.'" class="append_item_id'.$key.'" name="item_id[]"><input type="hidden" value="'.$value->code.'" class="actual_item_code'.$key.'" name="item_code[]"><input type="hidden" value="'.$value->code.'" class="append_item_code'.$key.'"><font class="item_code'.$key.'" style="font-family: Times new roman;">'.$value->code.'</font></td><td><input type="hidden" value="'.$value->name.'" class="actual_item_name'.$key.'" name="item_name[]"><input type="hidden" value="'.$value->name.'" class="append_item_name'.$key.'"><font class="item_name'.$key.'" style="font-family: Times new roman;">'.$value->name.'</font></td><td><input type="hidden" value="'.$value->brand_id.'" class="actual_item_brand_name'.$key.'" name="brand_id[]"><input type="hidden" value="'.$value->brand_id.'" class="append_item_brand_name'.$key.'"><font class="item_brand_name'.$key.'" style="font-family: Times new roman;">'.$barnd_name .'</font></td><td><input type="hidden" value="'.$value->category_id.'" class="actual_item_category_name'.$key.'" name="category_id[]"><input type="hidden" value="'.$value->category_id.'" class="append_item_category_name'.$key.'"><font class="item_category_name'.$key.'" style="font-family: Times new roman;">'.$category_name .'</font></td><td><input type="hidden" value="'.$value->hsn.'" class="actual_item_hsn'.$key.'" name="hsn[]"><input type="hidden" value="'.$value->hsn.'" class="append_item_hsn'.$key.'"><font style="font-family: Times new roman;" class="item_hsn'.$key.'">'.$value->hsn.'</font></td><td><input type="hidden" value="'.$value->mrp.'" class="actual_item_mrp'.$key.'" name="mrp[]"><input type="hidden" value="'.$value->mrp.'" class="append_item_mrp'.$key.'"><font class="item_mrp'.$key.'" style="font-family: Times new roman;">'.$value->mrp.'</font></td><td><input type="hidden" value="'.$uom_id.'" class="actual_item_uom'.$key.'" name="uom_id[]"><input type="hidden" value="'.$uom_id.'" class="append_item_uom'.$key.'"><font class="item_uom'.$key.'" style="font-family: Times new roman;">'.$uom_name.'</font></td><td><input type="hidden" class="actual_last_purchase_cost'.$key.'" value="'.$unit_price.'" name="last_purchase_cost[]"><input type="hidden" class="append_last_purchase_cost'.$key.'" value="'.$unit_price.'"><font class="last_purchase_cost'.$key.'">'.$unit_price.'</font></td><td><input type="hidden" class="tax'.$key.'" value="'.$tax.'" name="tax[]"><font class="tax'.$key.'">'.$tax.'</font></td><td><input type="hidden" class="append_mark_up_percent'.$key.'" name="mark_up_percent[]" value="'.$last_selling_price->mark_up_percent.'"><font class="mark_up_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_percent.'</font></td><td><input type="hidden" class="append_mark_up_rs'.$key.'" name="mark_up_rs[]" value="'.$last_selling_price->mark_up_rs.'"><font class="mark_up_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_up_rs.'</font></td><td><input type="hidden" class="append_mark_down_percent'.$key.'" name="mark_down_percent[]" value="'.$last_selling_price->mark_down_percent.'"><font class="mark_down_percent'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_percent.'</font></td><td><input type="hidden" class="append_mark_down_rs'.$key.'" name="mark_down_rs[]" value="'.$last_selling_price->mark_down_rs.'"><font class="mark_down_rs'.$key.'" style="font-family: Times new roman;">'.$last_selling_price->mark_down_rs.'</font></td><td><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="actual_item_selling_price'.$key.'" name="last_selling_price[]"><input type="hidden" value="'.@$last_selling_price->last_selling_price.'" class="append_item_selling_price'.$key.'"><font style="font-family: Times new roman;" class="item_selling_price'.$key.'">'.@$last_selling_price->last_selling_price.'</font></td><td><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="actual_updated_selling_price'.$key.'"><input type="hidden" value="'.@$last_selling_price->selling_price.'" class="append_updated_selling_price'.$key.'" name="updated_selling_price[]"><font style="font-family: Times new roman;" class="updated_selling_price'.$key.'">'.@$last_selling_price->selling_price.'</font></td><td><i class="fa fa-level-up px-2 py-1 bg-danger text-white rounded up" id="'.$key.'" aria-hidden="true"></i>&nbsp;<i class="fa fa-level-down px-2 py-1 bg-warning  text-white rounded down" id="'.$key.'" aria-hidden="true"></i></td></tr>';
        
    }
    return $result;
   }


}
