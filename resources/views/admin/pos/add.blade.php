@extends('admin.layout.app1')
@section('content')
<main class="page-content">
<style type="text/css">
  tbody#team-list {
    counter-reset: rowNumber;
}

tbody#team-list tr:nth-child(n+1) {
    counter-increment: rowNumber;
}

tbody#team-list tr:nth-child(n+1) td:first-child::before {
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
}

.netvalue{background: #a3d072;
    font-size: 17px;
    padding: -20px;
    margin: 0px;}
    .spantextwidth{width:200px;}
</style>
<div class="col-12 body-sec">
  <div class="card container-fluid px-0">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>POS</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="{{ url('/') }}">Back</a></button></li>
          </ul>
        </div>
      </div>
    </div>
    <style>
    .table{
      font-size: 13px;
    }
    </style>
    <!-- card header end@ -->
    <div class="card-body">
    


<style type="text/css">
  #middlecol {
   
    width: 45%;
  }

  #middlecol table {
    max-width: 99%;
    width: 100% !important;
  }
</style>


<form  method="post" class="form-horizontal" action="{{ route('pos.store') }}" id="dataInput" enctype="multipart/form-data">
      {{csrf_field()}}
<input type="hidden" id="hold_trans_id" name="hold_trans_id" value=""/>
      
         <div class="row col-md-12">

                  <div class="col-md-2">
                    <label style="font-family: Times new roman;">Voucher No</label><br>
                    <div class="">
                      <font size="2">{{ $voucher_no }}</font>
                    </div>
                  
                   
                  </div>

                  <div class="col-md-2">
                    <label style="font-family: Times new roman;">Voucher Date</label><br>
                  <input type="date" class="form-control voucher_date  required_for_proof_valid" id="voucher_date" placeholder="Voucher Date" name="voucher_date" value="{{ $date }}" autofocus="">
                   
                  </div>

                  <div class="col-md-3">
                  <label style="font-family: Times new roman;">Customer Name</label><br>
                  <div class="form-group row">
                     <div class="col-sm-8">
                      <select class="js-example-basic-multiple col-12 form-control custom-select customer_id" onchange="customer_data()" name="customer_id" id="customer_id">
                           <option value="">Choose Customer Name</option>
                           @foreach($customer as $customers)
                           <option value="{{ $customers->id }}">{{ $customers->name }}({{$customers->phone_no}})</option>
                           @endforeach
                        </select>
                     </div>
                     
                     <!-- <a href="{{ url('master/customer/create')}}" target="_blank">
                     <button type="button"  class="px-2 btn btn-success ml-2" title="Add Supplier"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
                     <button type="button"  class="px-2 btn btn-success mx-2 refresh_customer_id" title="Add Brand"><i class="fa fa-refresh" aria-hidden="true"></i></button>
  -->
                  </div>
                  
                  
               </div>
               
               <div class="col-md-3" id="cust_data1" style="margin-left: -106px;">
                  <label style="font-family: Times new roman;">Customer Name</label><br>
                  <div class="form-group row">
                     <div class="col-sm-8">
                     <input type="text" class="form-control required_for_proof_valid" placeholder="Customer Name" id="customer_name" name="customer_name" value="">

                     </div>
                 </div>
                  
                  
               </div>
               <div class="col-md-3" id="cust_data2" style="margin-left: -107px;">
                  <label style="font-family: Times new roman;">Mobile No</label><br>
                  <div class="form-group row">
                     <div class="col-sm-8">
                     <input type="text" class="form-control required_for_proof_valid" placeholder="Customer Mobile No" id="phone_no" name="phone_no" value="">

                     </div>
                 </div>
                  
                  
               </div>
                  <!-- <div class="col-md-2">
                    <label style="font-family: Times new roman;">Sale Estimation No</label><br>
                  <select class="js-example-basic-multiple col-12 form-control custom-select estimation_no" onchange="estimation_details()" name="estimation_no" id="estimation_no">
                           <option value="">Choose Sale Estimation No</option>
                           @foreach($estimation as $estimations)
                           <option value="{{ $estimations->sale_estimation_no }}">{{ $estimations->sale_estimation_no }}</option>
                           @endforeach
                        </select>
                   
                  </div>

                  <div class="col-md-2">
                    <label style="font-family: Times new roman;">Estimation Date</label><br>
                  <input type="date" class="form-control estimation_date  required_for_proof_valid" readonly="" id="estimation_date" placeholder="Estimation Date" name="estimation_date" value="">
                   
                  </div> 


                
                  
                  </div>

                  <div class="row col-md-12">

                    <div class="col-md-4">
                    <label style="font-family: Times new roman;">Customer Address</label><br>
                    <input type="hidden" name="address_line_1" id="address_line_1">
                    <div class="address">
                      
                    </div>
                  
                   
                  </div>

                  <div class="col-md-3">
                  <label style="font-family: Times new roman;">Sales Men Name</label><br>
                  <div class="form-group row">
                     <div class="col-sm-8">
                      <select class="js-example-basic-multiple col-12 form-control custom-select salesmen_id" name="salesmen_id" id="salesmen_id">
                           <option value="">Choose Sales Men Name</option>
                           @foreach($sales_man as $value)
                           <option value="{{ $value->id }}">{{ $value->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <a href="{{ route('sales_man.create')}}" target="_blank">
                     <button type="button"  class="px-2 btn btn-success ml-2" title="Add Sales Men"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
                     <button type="button"  class="px-2 btn btn-success mx-2 refresh_salesmen_id" title="Add Sales Men"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                  </div>
               </div>

                  <div class="col-md-3">
                    <label style="font-family: Times new roman;">Sale type</label><br>
                    <input type="radio" name="sale_type" value="1" checked="">
                    <label style="font-family: Times new roman;">Cash Sale</label>
                    <input type="radio" name="sale_type" value="0">
                    <label style="font-family: Times new roman;">Credit Sale</label>
                  </div>

                  <div class="col-md-2">
                    <label style="font-family: Times new roman;">Company Location</label><br>
                  <select class="js-example-basic-multiple col-12 form-control custom-select location" name="location" id="location" required="">
                           <option value="">Choose Location</option>
                           @foreach($location as $value)
                           <option value="{{ $value->id }}">{{ $value->name }}</option>
                           @endforeach
                        </select>
                   
                  </div>

                </div>-->
                <br>
    
      <div class="col-md-8">
                       <div class="form-group row">
                       <div class="col-md-4">
                       <label for="validationCustom01" class=" col-form-label"><h4>Item Details:</h4> </label><br>
                       
                           
                       </div>
                         </div>
              </div>

      <div class="row col-md-12">
        <!-- <div class="col-md-2">
          <label style="font-family: Times new roman;">Item Bill S.No</label>
        <input type="text" class="form-control item_sno " placeholder="Item S.no" id="item_sno" name="item_sno" value="">
         
        </div> -->

        <div class="col-md-2">
          <label style="font-family: Times new roman;">Item Code</label>
          <input type="text" class="form-control item_code  required_for_proof_valid" placeholder="Item Code" id="item_code" name="item_code" value="" oninput="get_details()">

          <input type="hidden" class="form-control items_codes  required_for_proof_valid" placeholder="Item Code" id="items_codes" name="items_codes" value="">
               
              </div>
              
                      <div class="cat" id="cat" style="display: none;" title="Search Here">
                        <div class="row col-md-8">

                          <div class="col-md-4">
                            <input list="browsers" class="form-control" placeholder="Item Name" name="browse_item" id="browse_item" onchange="browse_item()">
                            <datalist id="browsers">
                              @foreach($item as $key => $value)
                              <option value="{{$value->name}}">
                              @endforeach
                            </datalist>
                          </div>

                          <div class="col-md-4">
                            <select class="js-example-basic-multiple form-control brand" id="brand" name="brand" style="width: 100%;" style="margin-left: 50%;" data-placeholder="Choose Brand Name" onchange="brand_check()">
                          <option></option>
                          <option value="0">Not Applicable</option>
                          @foreach($brand as $brands)
                          <option value="{{ $brands->id }}">{{ $brands->name }}</option>
                          @endforeach
                        </select>

                          </div>
                          <div class="col-md-4">
                            <select class="js-example-basic-multiple form-control categories" id="categories" name="category" style="width: 100%;" style="margin-left: 50%;" data-placeholder="Choose Category" onchange="categories_check()">
                          <option value=""></option>
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                          </div>
                          
                        </div><br>
                        
                        <div class="form-row">
                            <div class="col-md-12">
                              <table class="item_code_table" style="width: 100%;">
                                  <thead>
                                  <th style="font-family: Times New Roman;">Select One</th>
                                  <th style="font-family: Times New Roman;">Item Code</th>
                                  <th style="font-family: Times New Roman;">Item Name</th>
                                  <th style="font-family: Times New Roman;">MRP</th>
                                  <th style="font-family: Times New Roman;">UOM</th>
                                  <th style="font-family: Times New Roman;">Brand</th>
                                  <th style="font-family: Times New Roman;">Category</th>
                                  <!-- <th style="font-family: Times New Roman;">PTC Code</th> -->
                                  <th style="font-family: Times New Roman;">Barcode</th>
                                  
                                </thead>
                                <tbody class="append_item">
                                </tbody>
                                <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <!-- <th></th> -->
                                </tfoot>
                              </table>
                            </div>
                          </div>
    
                            
                      </div>


                      <div class="item_display" id="item_display" style="display: none;" title="Choose Item">
                        
                        <div class="form-row">
                            <div class="col-md-12">
                              <table class="item_code_table" style="width: 100%;">
                                  <thead>
                                  <th style="font-family: Times New Roman;">Select One</th>
                                  <th style="font-family: Times New Roman;">Item Code</th>
                                  <th style="font-family: Times New Roman;">Item Name</th>
                                  <th style="font-family: Times New Roman;">MRP</th>
                                  <th style="font-family: Times New Roman;">UOM</th>
                                  <th style="font-family: Times New Roman;">Brand</th>
                                  <th style="font-family: Times New Roman;">Category</th>
                                  <!-- <th style="font-family: Times New Roman;">PTC Code</th> -->
                                  <th style="font-family: Times New Roman;">Barcode</th>
                                  
                                </thead>
                                <tbody class="append_item_display">
                                </tbody>
                                <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <!-- <th></th> -->
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        
                            
                      </div>

                      <div class="hold_data" id="hold_data" style="display: none;" title="Search Here">
                        
                        <div class="form-row">
                            <div class="col-md-12">
                              <table class="hold_table" style="width: 100%;">
                                  <thead>
                                  <th style="font-family: Times New Roman;">Select One</th>
                                  <th style="font-family: Times New Roman;">Voucher No</th>
                                  <th style="font-family: Times New Roman;">Date</th>
                                  <th style="font-family: Times New Roman;">Customer</th>
                                  <th style="font-family: Times New Roman;">Total Net Amt</th>
                                 
                                  
                                </thead>
                                <tbody class="append_hold_data">
                                </tbody>
                                <tfoot>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  
                                </tfoot>
                              </table>
                            </div>
                          </div>
    
                            
                      </div>


                      <div class="col-md-2">
                        <label><font color="white" style="font-family: Times new roman;">Find</font></label><br>
                      <input type="button" onclick="find_cat()" class="btn btn-info" value="Find" name="" id="find">
                    </div>
                    <div class="col-md-2">
                      <label style="font-family: Times new roman;">Item Name</label>
                      <input type="text" class="form-control item_name  required_for_proof_valid" id="item_name" placeholder="Item Name" name="item_name" readonly="" id="item_name" value="">
                    </div>
                    <div class="col-md-2">
                      <label style="font-family: Times new roman;">MRP</label>
                      <input type="number" class="form-control mrp required_for_proof_valid" placeholder="MRP" id="mrp" name="mrp" value="">
                       
                      </div>

                      <input type="hidden" class="form-control hsn  required_for_proof_valid"  placeholder="HSN" id="hsn" name="hsn" value="">

                      <input type="hidden" class="form-control uom  required_for_proof_valid"  placeholder="UOM" id="uom" name="uom" value="">

                      <input type="hidden" class="form-control uom_name  required_for_proof_valid"  placeholder="UOM" id="uom_name" name="uom_name" value="">

                    <div class="col-md-2">
                        <label style="font-family: Times new roman;">Quantity</label>
                      <input type="number" class="form-control quantity" id="quantity"  placeholder="Quantity" name="quantity" oninput="qty()" pattern="[0-9]{0,100}" title="Numbers Only" value="">
                      </div>
                      </div>
                      


                      <div class="row col-md-12">
                        <div class="col-md-2">
                        <label style="font-family: Times new roman;">Tax Rate%</label>
                      <input type="number" class="form-control tax_rate  required_for_proof_valid"  placeholder="Tax Rate%" oninput="gst_calc()" name="tax_rate" value="" id="tax_rate">
                      </div>
                      <input type="hidden" class="form-control gst  required_for_proof_valid" readonly="" placeholder="Tax Rate" name="gst" value="" id="gst">

                      <div class="col-md-2">
                        <label style="font-family: Times new roman;">Rate Exclusive Tax</label>
                        <div class="form-group row">
                          
                          <div class="col-sm-12">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <select class="form-control uom_exclusive" name="uom_exclusive" onchange="uom_details_exclusive()">
                                </select>
                              </div>
                              <input type="number" class="form-control exclusive_rate" id="exclusive" placeholder="Exclusive Tax" oninput="calc_exclusive()" name="exclusive" pattern="[0-9][0-9 . 0-9]{0,100}" title="Numbers Only" aria-label="Text input with dropdown button" value="">

                            </div>
                            
                          </div>
                        </div>

                      </div>

                      <div class="col-md-2">
                        <label style="font-family: Times new roman;">Rate Inclusive Tax</label>
                        <div class="form-group row">
                          
                          <div class="col-sm-12">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <select class="form-control  uom_inclusive" name="uom_inclusive" onchange="uom_details_inclusive()">
                                </select>
                              </div>
                              <input type="number" class="form-control inclusive_rate" id="inclusive" placeholder="Inclusive Tax" oninput="calc_inclusive()" name="inclusive" pattern="[0-9][0-9 . 0-9]{0,100}" aria-label="Text input with dropdown button" title="Numbers Only" value="">

                            </div>
                            
                          </div>
                        </div>

                      </div>

                      <div class="col-md-2">
                        <label style="font-family: Times new roman;">Discount %</label>
                      <input type="number" class="form-control discount_percentage" oninput="discount_calc1()" id="discount_percentage"  placeholder="Discount %" name="discount_percentage" pattern="[0-9]{0,100}" title="Numbers Only" value="">
                      </div>

                      <input type="hidden" class="form-control amount  required_for_proof_valid" placeholder="Amount" id="amount" pattern="[0-9][0-9 . 0-9]{0,100}" title="Numbers Only" name="amount" value="" >
                        
                      
                      <div class="col-md-2">
                          <label style="font-family: Times new roman;">Discount Rs</label>
                        <input type="number" class="form-control discount_rs  required_for_proof_valid" placeholder="Discount Rs" id="discount" pattern="[0-9][0-9 . 0-9]{0,100}" title="Numbers Only" oninput="discount_calc()" name="discount" value="" >
                        </div>

                        <div class="col-md-2">
                          <label style="font-family: Times new roman;">Batch No</label>
                        <input type="number" class="form-control batch_no required_for_proof_valid" placeholder="Batch No" id="batch_no" pattern="[0-9][0-9 . 0-9]{0,100}" title="Numbers Only" name="batch_no" value="" >
                        </div>

                        <input type="hidden" name="discounts" id="discounts" value="0">
                        <input type="hidden" name="disc_total" id="disc_total" value="0">

                        <input type="hidden" class="form-control net_price  required_for_proof_valid" id="net_price" placeholder="Net Price" pattern="[0-9][0-9 . 0-9]{0,100}" title="Numbers Only" name="net_price" value="">

                    </div>
                    <div class="col-md-12 row" id="b_w">
                        <div class="col-md-2">
                          <label style="font-family: Times new roman;">Quantity OR Rating</label>
                        <select class="form-control" id="b_or_w">
                          <option value="1">W</option>
                          <option value="0">B</option>
                       </select>
                        </div>
                      </div>


                      <!-- itemwise offer hidden values -->

                     <input type="hidden" class="form-control" value="0" name="" id="itemwiseoffer">
                     <input type="hidden" class="form-control" value="" name="" id="item_code_offer">
                     <input type="hidden" class="form-control" value="" name="" id="items_codes_offer">
                     <input type="hidden" class="form-control" value="" name="" id="item_name_offer">
                     <input type="hidden" class="form-control" value="" name="" id="item_name1_offer">
                     <input type="hidden" class="form-control" value="" name="" id="mrp_offer">
                     <input type="hidden" class="form-control" value="" name="" id="hsn_offer">
                     <input type="hidden" class="form-control" value="" name="" id="uom_offer">
                     <input type="hidden" class="form-control" value="" name="" id="uom_name_offer">
                     <input type="hidden" class="form-control" value="" name="" id="tax_rate_offer">
                     <input type="hidden" class="form-control" value="" name="" id="exclusive_offer">
                     <input type="hidden" class="form-control" value="" name="" id="inclusive_offer">
                     <input type="hidden" class="form-control" value="" name="" id="selling_price_type_offer">
                     <input type="hidden" class="form-control" value="" name="" id="quantity_offer">
                     <input type="hidden" class="form-control" value="" name="" id="buy_quantity_offer">

                     <input type="hidden" class="form-control" value="" name="" id="amount_offer">
                     <input type="hidden" class="form-control" value="" name="" id="net_price_offer">
                     <input type="hidden" class="form-control" value="" name="" id="gst_offer">
                     <input type="hidden" class="form-control" value="" name="" id="discount_offer">
                     <input type="hidden" class="form-control" value="" name="" id="uom_name_offer">
                     <input type="hidden" class="form-control" value="" name="" id="uom_offer">

                    <!-- itemwise offer hidden values -->


                      <br>
                                                          
					<div class="col-lg-12" align="center">
                                   
                    <input type="button" class="btn btn-success add_items" value="Add More" name="" id="add_items0">  

                    <input type="button" style="display: none" class="btn btn-success update_items" value="Update" name="" id="update_items"> 

                    <input type="button" style="display: none" class="btn btn-success update_items_one_key" value="Update" name="" id="update_items_one_key">
                    
                    <input type="hidden" name="" id="dummy_table_id"> 
                     </div> 
					 
					 <br>  <br>              
                   
<style>
table, th, td {
  border: 1px solid #E1E1E1;
}
</style>
<div class="form-row">
             
              <div class="col-md-12" id="middlecol">
                
                <table class="table" id="team-list">
                  <thead>
                    <th> S.no </th>
                    <th> Item Code</th>
                    <th> Item Name</th>
                    <th> HSN</th>
                    <th> MRP</th>
                    <th> Unit Price</th>
                    <th> Quantity</th>
                    <th> UOM</th>
                    <th> Amount</th>
                    <th> Item Discount</th>
                    <th> Overall Discount</th>
                    <th> Expense</th>
                    <th> Tax Rs</th>
                    <th> Net Value</th>
                    <th style="background-color: #FAF860;"> Last Purchase Rate(LPR)</th>
                    <th>Action </th>
                  </thead>
                  <tbody class="append_proof_details" id="mytable">
                    
                  <input type="hidden" name="counts" value="" id="counts">
                  <input type="hidden" name="expense_count" value="1" id="expense_count">
                  <input type="hidden" name="total_amount" value="0" id="total_amount">
                  <input type="hidden" name="total_gst" value="0" id="total_gst">
                  <input type="hidden" name="total_price" value="0" id="total_price">
                  <input type="hidden" name="last_purchase_rate" value="0" id="last_purchase_rate">

                  <div class="item_show" id="item_show" style="display: none;" title="Item Details">
                    <div class="row col-md-12">
                    <div class="col-md-3">
                      <label style="font-family: Times New Roman;">Item Code: <font class="show_item_code" style="font-weight: bold;"></font></label>
                    </div>
                    <div class="col-md-3">
                      <label style="font-family: Times New Roman;">Item Name: <font class="show_item_name" style="font-weight: bold;"></font></label>
                    </div>
                    <div class="col-md-3">
                      <label style="font-family: Times New Roman;">HSN: <font class="show_hsn" style="font-weight: bold;"></font></label>
                    </div>
                    <div class="col-md-3">
                      <label style="font-family: Times New Roman;">MRP: <font class="show_mrp" style="font-weight: bold;"></font></label>
                    </div>
                    </div>
                    <div class="row col-md-12">
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Unit Price: <font class="show_unit_price" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Quantity: <font class="show_quantity" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">UOM: <font class="show_uom" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Amount: <font class="show_amount" style="font-weight: bold;"></font></label>
                      </div>
                  </div>
                  <div class="row col-md-12">
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Discount: <font class="show_discount" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">GST Rs: <font class="show_gst_rs" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Net Value: <font class="show_net_value" style="font-weight: bold;"></font></label>
                      </div>
                      <div class="col-md-3">
                        <label style="font-family: Times New Roman;">Last Purchase Rate: <font class="show_last_purchase" style="font-weight: bold;"></font></label>
                      </div>
                      
                  </div>
                  </div>

                  </tbody>
                  <tfoot>
                    <tr>
                      
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><label class="total_amount">0</label></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th><label class="total_net_price">0</label></th>
                      <th style="background-color: #FAF860;"></th>
                      <th></th>
                    </tr>
                  </tfoot>

                </table>
                
                       </div>
                       <!-- <div class="row col-md-12">

                        <div class="col-md-2">
                        <label style="font-family: Times new roman;">Discount(-)</label>
                      <input type="number" readonly="" class="form-control total_discount" id="total_discount" name="total_discount" pattern="[0-9]{0,100}" title="Numbers Only" value="0">
                      </div>
                      <div class="col-md-2">
                        <label style="font-family: Times new roman;">Overall Discount</label>
                      <input type="number" class="form-control overall_discount" id="overall_discount" name="overall_discount" oninput="overall_discounts()" pattern="[0-9]{0,100}" title="Numbers Only" value="0">
                      </div>
                    </div> 


                        <div class="row col-md-12 append_expense">

                          <div class="row col-md-12 expense">
                            <div class="col-md-3">
                    <label style="font-family: Times new roman;">Expense Type</label><br>
                  <div class="form-group row">
                     <div class="col-sm-8">
                      <select class="js-example-basic-multiple col-12 form-control custom-select expense_type" name="expense_type[]" id="expense_type" >
                         <option value="">Choose Expense Type</option>
                         @foreach($account_head as $expense_types)
                        <option value="{{ $expense_types->id}}">{{ $expense_types->name}}</option>
                        @endforeach
                        </select>
                     </div>
                     <a href="{{ route('account_head.create')}}" target="_blank">
                     <button type="button"  class="px-2 btn btn-success ml-2" title="Add Expense"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
                     <button type="button"  class="px-2 btn btn-success mx-2 refresh_expense_type_id" title="Add Expense Type"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                  </div>
               </div>
                        
                      <div class="col-md-2">
                        <label style="font-family: Times new roman;">Expense Amount</label>
                      <input type="number" class="form-control expense_amount" id="expense_amount"  placeholder="Expense Amount" name="expense_amount[]" step="any" title="Numbers Only" value="">

                      <input type="hidden" name="expense_total" id="expense_total" value="0" class="expense_total">

                      </div>
                      <div class="col-md-2">
                        <label style="font-family: Times new roman; color: white;">Add Expense</label><br>
                      <input type="button" class="btn btn-success" value="+" onclick="expense_add()" name="" id="add_expense">&nbsp;<input type="button" class="btn btn-danger remove_expense" value="-" name="" id="remove_expense">
                    </div>
                  </div>
                    
                       </div>-->


                    <!-- net value -->
                  

                      <div class="row col-md-12" id="middlecol">

<div class="col-md-8">
<table >
                      <tr>
                      <th>Payment Type</th>
                      <th>Amount</th>
                      <th>Remarks</th>
                      <th>Date</th>
                      </tr>
                      <tbody>
                      <tr>
                      <td>Cash</td>
                      <td><input type="number" name="cash_amount"/></td>
                      <td><input type="text" name="cash_remark"/></td>
                      <td></td>
                      </tr>
                      <tr>
                      <td>Card</td>
                      <td><input type="number" name="card_amount"/></td>
                      <td><input type="text" name="card_remark"/></td>
                      <td></td>
                      </tr>
                      <tr>
                      <td>Cheque</td>
                      <td><input type="number" name="cheque_amount"/></td>
                      <td><input type="text" name="cheque_remark"/></td>
                      <td><input type="date" name="cheque_date"/></td>
                      </tr>
                      <tr>
                      <td>Voucher</td>
                      <td><input type="number" name="voucher_no" id="voucher_no"/></td>
                      <td><input type="text" name="voucher_code" placeholder="VOUCHER CODE" oninput="get_voucher_amt($(this).val())"/></td>
                      <td></td>
                      </tr>
                      </tbody>
                      </table>
</div>


<div class="col-md-4">
<div class="row mx-auto d-flex">
   <div class="netvalue" style="margin:20px; padding:15px;">
   <div class="row mx-auto d-flex">
    <!--Table-->
    <table id="tablePreview" class="" style="width:100%; border: 1px solid #a3d072 !important;">

  <!--Table body-->
  <tbody>
    <tr>
      <td> No of Item</td>
      <td align="right"> <input type="text" class="form-control" readonly="" id="no_item" name="no_item" value="0"  style="text-align: right;
    background: none;
    border: #a3d072 solid 1px !important;"> </td>
     
    </tr>
    <tr>
    <td> No of Qty</td>
      <td align="right"><input type="text" class="form-control" readonly="" id="no_qty" name="no_qty" value="0" style="text-align: right;
    background: none;
    border: #a3d072 solid 1px !important;"></td>
     
    </tr>
    <tr>
    <td> NET Value</td>
      <td align="right"><font class="total_net_value" style="font-size: 150%; font-weight: 900;">00.00</font> </td>
     
    </tr>

    <tr>
    <td>Amt Tendered</td>
      <td align="right"></td>
     
    </tr>

    <tr>
    <td>Change</td>
      <td align="right"></td>
     
    </tr>
  </tbody>
  <!--Table body-->
</table><!--Table-->
  </div>
  
    </div>
</div>
</div>

                      




                       <div class="row col-md-12">

                        <div class="col-md-2">
                        <label style="font-family: Times new roman;">Round Off(+/-)</label>
                      <input type="text" class="form-control round_off" readonly="" value="0" id="round_off" name="round_off" >
                      </div>
                        



                      


                       
                       <div class="row col-md-12 taxes mb-3">
                        @foreach($tax as $value)
                         <div class="col-md-2">
                           <label style="font-family: Times new roman;">{{ $value->name }}</label>
                      <input type="text" class="form-control {{ $value->id }}" readonly="" id="{{ $value->id }}" name="{{ $value->name }}" value="0">

                      <input type="hidden" name="{{ $value->name }}_id" value="{{ $value->id }}">
                      
                         </div>
                         @endforeach
                          

                       </div>

                       <div class="row col-md-12 taxes mb-3">
                         <div class="col-md-2">
                           <!-- <label style="font-family: Times new roman;">No of Item</label> -->
                     
                         </div>
                         <div class="col-md-2">
                           <!-- <label style="font-family: Times new roman;">No of Qty</label> -->
                     
                         </div>
                          
                         <div class="col-md-2">
                           <!-- <label style="font-family: Times new roman;">Grand Total</label> -->
                      <!-- <input type="text" class="form-control" readonly="" id="grand_total" name="" value="0">
                         </div>
                          
                         <div class="col-md-2">
                           <label style="font-family: Times new roman;">Amt Tendered</label>
                      <input type="text" class="form-control"  id="amt_tend" name="" value="0">
                         </div>                         <div class="col-md-2">
                           <label style="font-family: Times new roman;">Change</label>
                      <input type="text" class="form-control" readonly="" id="change" name="" value="0"> -->
                         </div>
                          
                       <div class="row col-md-12 text-center">
                          <div class="col-md-12">
                            <br>
                          <p>
                             <button class="btn btn-success save" name="save" value="0" type="submit">Save</button>
                             <button class="btn btn-warning print" name="save" value="1" type="submit">Save & Print</button>
                             <button class="btn btn-primary"  type="button" onclick="find_cat()">Find Item F2</button>
                             <button class="btn btn-dark"  type="button" id="scan_item">Scan ItemsF4</button>
                             <button class="btn btn-info"  type="submit" name="hold_trans" id="hold_trans">Hold Trans F8</button>
                             <button class="btn btn-dark"  type="button" id="load_trans">Load Trans F9</button>
                             <button class="btn btn-primary"  type="button" id="change_qty">Change Qty Cntrl+F1 </button>

                          </p>
                          
                        </div>

                      </div>
      
      
      </form>
                       
        <script type="text/javascript">
    $('#customer_id').removeAttr('required');

function customer_data()
{
  var customer_id= $('#customer_id').val();
  if(customer_id!="")
  {
    $('#customer_name').removeAttr('required');
    $('#phone_no').removeAttr('required');
    $('#customer_id').attr('required','required');
    
    $('#cust_data1').hide();
    $('#cust_data2').hide();

    
  }
  else
  {
    $('#cust_data1').show();
    $('#cust_data2').show();

    $('#customer_name').attr('required','required');
    $('#phone_no').attr('required','required');
    $('#customer_id').removeAttr('required');
  }

}

$("#load_trans").click(function() {
  $(".row_category").remove();

  $.ajax({
           type: "POST",
            url: "{{ url('pos/get_pos_hold_data/') }}",
            data: {},
           success: function(data) {
             $('.hold_data').show();
             $('.hold_data').dialog({width:900},{height:250}).prev(".ui-dialog-titlebar").css("background","#28a745").prev(".ui-dialog.ui-widget-content");

            $('.append_hold_data').append(data);
             
           }
           
        });

  });

function append_pos_holded_data(val)
{
  // alert(val);
  // return false;

  $.ajax({
           type: "POST",
            url: "{{ url('pos/get_pos_load_data/') }}",
            data: {so_no : val},
           success: function(data) {
            //  console.log(data);
            $('.hold_data').hide();
            $('.tables').remove();
            $('.append_proof_details').append(data);
           }
           
        });
}

  $("#hold_trans").click(function() {

$('#hold_trans_id').val("1");
form.submit();
});

  $("#scan_item").click(function() {

      $('#item_code').focus();
   
   });

   $("#change_qty").click(function() {

    $('.add_items').hide();
      $('.update_items').hide();
      $('.update_items_one_key').show();

      var id=$('#mytable tr:last').attr('class').split(' ')[0];
        //alert(length);
        var invoice_no = $('.invoice_no'+id).val(); 
  var item_code_id = $('.item_code'+id).val();
  var item_code_name = $('.items'+id).text(); 
  var item_name = $('.item_name'+id).val();
  var hsn = $('.hsn'+id).val(); 
  var mrp = $('.mrp'+id).val();
  var discount_val = $('.discount_val'+id).val(); 
  var exclusive = $('.exclusive'+id).val();
  var inclusive = $('.inclusive'+id).val(); 
  var quantity = $('.quantity'+id).val();
  var uom = $('.uom'+id).val(); 
  var uom_name = $('.font_uom'+id).text();
  var amnt = $('#amnt'+id).val();
  var tax = $('#tax'+id).val(); 
  var tax_gst = $('.tax_gst'+id).val();
  var net_price = $('#net_price'+id).val(); 
  var last_purchase_rate = $('.last_purchase'+id).text();

  $('.quantity').focus();

  $('.exclusive_rate').val(exclusive);
  $('.inclusive_rate').val(inclusive);
  $('.item_sno').val(invoice_no);
  $('.items_codes').val(item_code_id);
  $('.item_name').val(item_name);
  $('.item_code').val(item_code_name);
  $('.mrp').val(mrp);
  $('.hsn').val(hsn);
  $('.quantity').val(quantity);
  $('.tax_rate').val(tax_gst);
  $('.amount').val(amnt);
  $('.net_price').val(net_price);
  $('.gst').val(tax);
  $('.uom').val(uom);
  $('.uom_name').val(uom_name);
  $('#last_purchase_rate').val(last_purchase_rate);
  var disc_value = parseFloat(discount_val)/parseFloat(quantity);
  $('.discount_rs').val(disc_value.toFixed(2));
  discount_calc();
   
  if(discount_val == 0)
  {
    $('.discount_percentage').val('');
  $('.discount_rs').val('');
  }


});
function get_voucher_amt(val)
{
  
$.ajax({
           type: "POST",
            url: "{{ url('pos/check_voucher_code/') }}",
            data: { id: val },
           success: function(data) {
            //  console.log(data.value);
              //alert(data);
              if(data!="")
              {
              $('#voucher_no').val(data);
            }
            else
            {
              $('#voucher_no').val("");
              alert("Pls Check Voucher Code");

            }

           }

           
        });

}

$(document).ready(function(){

	$('body').keyup(function(e) {
    var key=e.keyCode;
    var code =e.which;
// alert(key);
var quantity =$("#quantity").val();
// alert(quantity);
if(key==13 || code==13 )
{
  add_items();
  item_details_sno();
}


    // alert(code);
    if(key==119 || code==119)
    {
      var length = $('.tables').length;
      // alert(length);
      // return false;
      if(length!=0)
      {
      $('#hold_trans_id').val("1");
      $('#dataInput').submit();
      }
      else
      {
        alert("Pls Add Items Details");
      }


    }
    if(key==113 || code==113)
    {
      find_cat();
    }
    if(key==115 || code==115)
    {
      // alert('ddd');
       $('#item_code').focus();
    }
    if(key==120 || code==120)
    { 
      $(".row_category").remove();
      
      $("#load_trans").click();
    }
    if(key==17 || code==17 && key==112 || code==112 )
    {
      
      
      $('.add_items').hide();
      $('.update_items').hide();
      $('.update_items_one_key').show();

      var id=$('#mytable tr:last').attr('class').split(' ')[0];
        //alert(length);
        var invoice_no = $('.invoice_no'+id).val(); 
  var item_code_id = $('.item_code'+id).val();
  var item_code_name = $('.items'+id).text(); 
  var item_name = $('.item_name'+id).val();
  var hsn = $('.hsn'+id).val(); 
  var mrp = $('.mrp'+id).val();
  var discount_val = $('.discount_val'+id).val(); 
  var exclusive = $('.exclusive'+id).val();
  var inclusive = $('.inclusive'+id).val(); 
  var quantity = $('.quantity'+id).val();
  var uom = $('.uom'+id).val(); 
  var uom_name = $('.font_uom'+id).text();
  var amnt = $('#amnt'+id).val();
  var tax = $('#tax'+id).val(); 
  var tax_gst = $('.tax_gst'+id).val();
  var net_price = $('#net_price'+id).val(); 
  var last_purchase_rate = $('.last_purchase'+id).text();

  $('.exclusive_rate').val(exclusive);
  $('.inclusive_rate').val(inclusive);
  $('.item_sno').val(invoice_no);
  $('.items_codes').val(item_code_id);
  $('.item_name').val(item_name);
  $('.item_code').val(item_code_name);
  $('.mrp').val(mrp);
  $('.hsn').val(hsn);
  $('.quantity').val(quantity);
  $('.tax_rate').val(tax_gst);
  $('.amount').val(amnt);
  $('.net_price').val(net_price);
  $('.gst').val(tax);
  $('.uom').val(uom);
  $('.uom_name').val(uom_name);
  $('#last_purchase_rate').val(last_purchase_rate);
  var disc_value = parseFloat(discount_val)/parseFloat(quantity);
  $('.discount_rs').val(disc_value.toFixed(2));
  discount_calc();
   
  if(discount_val == 0)
  {
    $('.discount_percentage').val('');
  $('.discount_rs').val('');
  }
   // item_codes(item_code_id);
    }

  });
});

$(document).on('click','.update_items_one_key',function(){

  var td_id=$('#mytable tr:last').attr('class').split(' ')[0];

  $('.invoice_no'+td_id).val($('.item_sno').val());
  $('.item_no'+td_id).text($('.item_sno').val());
  $('.item_code'+td_id).val($('.items_codes').val());
  $('.items'+td_id).text($('.item_code').val());
  $('.item_name'+td_id).val($('.item_name').val());
  $('.font_item_name'+td_id).text($('.item_name').val());
  $('.hsn'+td_id).val($('.hsn').val());
  $('.font_hsn'+td_id).text($('.hsn').val());
  $('.mrp'+td_id).val($('.mrp').val());
  $('.font_mrp'+td_id).text($('.mrp').val());
  $('.exclusive'+td_id).val($('.exclusive_rate').val());
  $('.font_exclusive'+td_id).text($('.exclusive_rate').val());
  $('.inclusive'+td_id).val($('.inclusive_rate').val());
  $('.quantity'+td_id).val($('.quantity').val());
  $('#qty'+td_id).val($('.quantity').val());
  $('.font_quantity'+td_id).text($('.quantity').val());
  $('.uom'+td_id).val($('.uom').val());
  $('.font_uom'+td_id).text($('.uom_name').val());
  $('#amnt'+td_id).val($('.amount').val());
  $('.font_amount'+td_id).text($('.amount').val());
  $('.black_or_white'+td_id).val($('#b_or_w').val());
  $('#tax'+td_id).val($('.gst').val());
  $('.tax_gst'+td_id).val($('.tax_rate').val());
  $('.font_gst'+td_id).text($('.gst').val());
  $('.last_purchase'+td_id).text($('#last_purchase_rate').val());


   if($('.discount_percentage').val() == '' && $('.discount_rs').val() == '')
   {
    var discount=0;
    $('.discount_val'+td_id).val(discount);
    $('#font_discount'+td_id).text(discount);
    $('#input_discount'+td_id).val(discount);
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));

   }
   else
   {
    $('.discount_val'+td_id).val($('#discounts').val());
    $('#font_discount'+td_id).text($('#discounts').val());
    $('#input_discount'+td_id).val($('#discounts').val());
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));
   }

  $('#net_price'+td_id).val($('.net_price').val());
  $('.font_net_price'+td_id).text($('.net_price').val());

  var total_net_price=calculate_total_net_price();
  var total_amount=calculate_total_amount();
  var total_gst=calculate_total_gst();
  $("#total_price").val(total_net_price.toFixed(2));
  $(".total_net_value").text(total_net_price.toFixed(2));
  $("#grand_total").val(total_net_price.toFixed(2));
  $("#total_amount").val(total_amount.toFixed(2));
  $("#total_gst").val(total_gst.toFixed(2));
  $("#igst").val(total_gst.toFixed(2));
  var half_gst = parseFloat(total_gst)/2;
  $("#cgst").val(half_gst.toFixed(2));
  $("#sgst").val(half_gst.toFixed(2));
  var to_html_total_net = total_net_price.toFixed(2);
  var to_html_total_amount = total_amount.toFixed(2);
  $(".total_net_price").html(parseFloat(to_html_total_net));
  $(".total_amount").html(parseFloat(to_html_total_amount));
  total_expense_cal();
  individual_expense();
  //overall_discounts();
  roundoff_cal();

var total_qty = 0;
$('.qty').each(function(){

total_qty = parseInt(total_qty) + parseInt($(this).val());
$('#no_qty').val(parseInt(total_qty));
});

  

  
  $('.item_sno').val('');
  $('.items_codes').val('');
  $('.item_name').val('');
  $('.mrp').val('');
  $('.hsn').val('');
  $('.quantity').val('');
  $('.tax_rate').val('');
  $('#exclusive').val('');
  $('#inclusive').val('');
  $('.amount').val('');
  $('#discount').val('');
  $('.discount_percentage').val('');
  $('.net_price').val('');
  $('.gst').val('');
  $('.item_code').val('');
  $('#discounts').val('');
  $('#last_purchase_rate').val(0);
  $('.uom_inclusive').children('option').remove();
  $('.uom_exclusive').children('option').remove();
  $("select").select2();
  $("#b_w").load(" #b_w > *");

  $('.add_items').show();
      $('.update_items').hide();
      $('.update_items_one_key').hide();

});

          var i=1;
          var discount_total = 0;

function calculate_total_net_price(){
  var total_net_price=0;
  $(".table_net_price").each(function(){
    total_net_price=parseFloat(total_net_price)+parseFloat($(this).val());
  });
  return total_net_price;
}
function calculate_total_amount(){
  var total_amount=0;
  $(".table_amount").each(function(){
    total_amount=parseFloat(total_amount)+parseFloat($(this).val());
  });
  return total_amount;
}
function calculate_total_gst(){
  var total_gst=0;
  $(".table_gst").each(function(){
    total_gst=parseFloat(total_gst)+parseFloat($(this).val());
  });
  return total_gst;
}

function calculate_total_discount()
{
  var q=0;
  var r=0;
    $(".input_discounts").each(function(){
    q = parseFloat(q)+parseFloat($(this).val());
    });
    $(".overall_disc").each(function(){
    r = parseFloat(r)+parseFloat($(this).val());
    });
    var total = parseFloat(q)+parseFloat(r);
    return total;
  
  

}
$(document).on("keyup","#amt_tend",function(){

  var amt_tend = $(this).val();
  var tot = $('#grand_total').val();
  var change = parseInt(amt_tend)-parseInt(tot);
  if(parseInt(tot) <= parseInt(amt_tend))
  {
  $('#change').val(change);
  }
  else{$('#change').val("");}
});

$(document).on("keyup",".expense_amount",function()
{
  var total = $('#total_price').val();
  var e_amount = $('.expense_amount').val();
  if(total == 0)
  {
    alert('You Cannot Add Expense Without Adding Item Details!!');
    $('.expense_amount').val('');
    $('.expense_type').val('');
    $('Select').select2();
  }
  else
  {
    if(e_amount == '' || e_amount == 0)
    {
      $(".expense_type").each(function(){
      if($(this).val() == '')
    {
      $(this).removeAttr('required');
      //$('.expense_amount').val('');
    }
    });
    }
    else
    {
      $(".expense_type").each(function(){
      if($(this).val() == '')
    {
      $(this).attr('required','required');
      //$('.expense_amount').val('');
    }
    });
    }
    
    total_expense_cal();
    individual_expense();
    roundoff_cal();
  }
  
});

function individual_expense()
{
$('.expenses').each(function(){

  var count = $(this).attr('class').split(' ')[1];
  var itemwiseoffer = $('#itemwiseoffer'+count).val();
      if(itemwiseoffer == 0)
      {
        var total_amount =calculate_total_amount();
        var total_expense = total_expense_cal();
        var amount = $('#amnt'+count).val();
        var gst_rs = $('#tax'+count).val();
        var discount = $('.discount_val'+count).val();
        var overall_disc = $('#overall_disc'+count).val();
        var sum_of_total_discount = parseFloat(discount)+parseFloat(overall_disc);
        var exp_distribution = parseFloat(total_expense)/parseFloat(total_amount)*parseFloat(amount);
        var total_exp = parseFloat(0)+parseFloat(exp_distribution);


        var net_value = parseFloat(amount)+parseFloat(gst_rs)-parseFloat(sum_of_total_discount)+parseFloat(total_exp);
      $('#net_price'+count).val(net_value.toFixed(2));
        $('.font_net_price'+count).text(net_value.toFixed(2));
        $('.font_expenses'+count).text(total_exp.toFixed(2));

        $(this).val(total_exp);
      } 
      else
      {

      }
    

});

var total_net_price=calculate_total_net_price();

$(".total_net_price").html(parseFloat(total_net_price));
$('.total_net_value').text(total_net_price.toFixed(2));
$('#total_price').val(total_net_price.toFixed(2));
  
}

function total_expense_cal(){

  var total_amount=calculate_total_net_price();
  var total_expense_amount=0;
  $(".expense_amount").each(function(){
 if($(this).val() !=""){
total_expense_amount=parseFloat(total_expense_amount)+parseFloat($(this).val());
 }
  });

  var total_net_amount=parseFloat(total_amount)+parseFloat(total_expense_amount);
   // $('.total_net_value').text(total_net_amount.toFixed(2));
   // $('#total_price').val(total_net_amount.toFixed(2));
   return total_expense_amount;
}

function roundoff_cal()
{
  var substr = $("#total_price").val().split('.');
if(substr[1] >= 50)
{
  var round_off = 100-substr[1];
  var symbol ='+'+'0.'+round_off;
  $("#round_off").val(symbol);
}
else if(substr[1] == 5 || substr[1] == 6 || substr[1] == 7 || substr[1] == 8 || substr[1] == 9)
{
  var sub = substr[1]+'0';
  var round_off = 100-sub;
  var symbol ='+'+'0.'+round_off;
  $("#round_off").val(symbol);
}
else if(substr[1] == '01' || substr[1] == '02' || substr[1] == '03' || substr[1] == '04' || substr[1] =='05' || substr[1] == '06' || substr[1] == '07' || substr[1] == '08' || substr[1] == '09')
{
  var symbol ='-'+'0.'+substr[1];
  $("#round_off").val(symbol);
}
else if(typeof substr[1] == 'undefined')
{
  var symbol = 0;
  $("#round_off").val(symbol);
}
else if(substr[1] == '00')
{
  var symbol = 0;
  $("#round_off").val(symbol);
}
else if(substr[1] < 50)
{
  var symbol ='-'+'0.'+substr[1];
  $("#round_off").val(symbol);
}
}
function add_items()
{

  /*for table Net Value Calculation*/

  var rate_exclusive = $('#exclusive').val();
  
  var rate_inclusive = $('#inclusive').val();
  
  var quantity = $('#quantity').val();
  
  var tax_rate = $('.tax_rate').val();
  
  var total = parseInt(quantity)*parseFloat(rate_exclusive);
  
  $('#amount').val(total.toFixed(2));
  
  if(tax_rate == '')
  {
    $('#net_price').val(total.toFixed(2));
  }
  
  
  var rate = parseFloat(tax_rate)/100;
  
  var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
  
  var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
  
  var net_val = parseFloat(total)*parseFloat(rate);
  

  $('.gst').val(net_val.toFixed(2));
  

  var total_net_val = parseFloat(total)+parseFloat(net_val);
  // var total_net_val_offer = parseFloat(total_offer)+parseFloat(net_val_offer);
  $('#net_price').val(total_net_val.toFixed(2)); 
  

  /*for table Net Value Calculation*/

  var j=$('#mytable tr:last').attr('class');
 var l=parseInt(i)+1;
 var voucher_date=$('.voucher_date').val();
 var invoice_no=$('.item_sno').val();
 var uom_name = $('.uom_name').val();
 var uom_id = $('.uom').val();
 var black_or_white = $('#b_or_w').val();
 // var item_code=$("#items_codes option:selected");
 // var item_code=item_code.text();
 var itemwiseoffer=$("#itemwiseoffer").val();
 var item_code=$("#item_code").val();
 var items_codes=$('#items_codes').val();
 var item_name=$('.item_name').val();
 var item_name1=$('#item_name1').val();
 var mrp=$('.mrp').val();
 var hsn=$('.hsn').val();
 var gst=$('.gst').val();
 var quantity=$('.quantity').val();
 var tax_rate=$('.tax_rate').val();
 var exclusive=$('#exclusive').val();
 var inclusive=$('#inclusive').val();
 var amount=$('.amount').val();
 var discounts=$('#discounts').val();
 var discount=$('#discount').val();
 var discount_percentage=$('.discount_percentage').val();
 var discount_rs=$('.discount_rs').val();
 var net_price=$('.net_price').val();
 var buy_quantity_offer=$('#buy_quantity_offer').val();

 

 if($('.discount_percentage').val() == '' && $('.discount_rs').val() == '')
  {
    discounts = 0;
  }
   
 if(amount == '')
 {
  var amount=0;
 }
 if(net_price == '')
 {
  var net_price=0;
 }

 if(item_code == '' || quantity == '' || exclusive == '' && inclusive == '')
 {
  alert('Please Fill All The Input Fields');
 }
 else if(item_name == '')
 {
  alert('Sorry There Is No  Such Item Code!!');
  $("#item_code").val('');
  $("#item_code").focus();
 }

 // else if(parseFloat(net_price)>parseFloat(mrp) && parseFloat(mrp) != 0)
 // {
 //  alert('The Total Net Value Exceeds The MRP!!');
 //    $('#discount').val('');
 //    $('.discount_percentage').val('');
 //    $('#exclusive').val('');
 //    $('#inclusive').val('');
 //    $('.amount').val('');
 //    $('.net_price').val('');
 //    $('.gst').val('');
 // }
 else
 {


  var last_purchase_rate = $('#last_purchase_rate').val();
 
  if(itemwiseoffer == 1 && parseInt(quantity) >= parseInt(buy_quantity_offer))
  {  

    var free_quantity = parseInt(quantity)/parseInt(buy_quantity_offer);

    var no_of_free_qty = parseInt(free_quantity);

    var rate_exclusive_offer = $('#exclusive_offer').val();
    var rate_inclusive_offer = $('#inclusive_offer').val();
    // var quantity_offer = $('#quantity_offer').val();
    var tax_rate_offer = $('#tax_rate_offer').val();
    var total_offer = parseInt(no_of_free_qty)*parseFloat(rate_exclusive_offer);
    $('#amount_offer').val(total_offer.toFixed(2));
      $('#discount_offer').val(total_offer.toFixed(2));
    if(tax_rate_offer == '')
    {
      $('#net_price_offer').val(0.00);
    }
    var rate_offer = parseFloat(tax_rate_offer)/100;
    var gst_rate_offer = parseFloat(rate_exclusive_offer)*parseFloat(rate_offer);
    var gst_rate_inclusive_offer = parseFloat(rate_exclusive_offer)+parseFloat(gst_rate_offer);
    var net_val_offer = parseFloat(total_offer)*parseFloat(rate_offer);
    $('#gst_offer').val(net_val_offer.toFixed(2));
    $('#net_price_offer').val(net_val_offer.toFixed(2));

    // itemwise offer values starts

     var itemwiseoffer=$("#itemwiseoffer").val();
     var uom_name_offer = $('#uom_name_offer').val();
     var uom_id_offer = $('#uom_offer').val();
     var item_code_offer=$("#item_code_offer").val();
     var items_codes_offer=$('#items_codes_offer').val();
     var item_name_offer=$('#item_name_offer').val();
     var item_name1_offer=$('#item_name1_offer').val();
     var mrp_offer=$('#mrp_offer').val();
     var hsn_offer=$('#hsn_offer').val();
     var gst_offer=$('#gst_offer').val();
     var quantity_offer=$('#quantity_offer').val();
     
     var tax_rate_offer=$('#tax_rate_offer').val();
     var exclusive_offer=$('#exclusive_offer').val();
     var inclusive_offer=$('#inclusive_offer').val();
     var amount_offer=$('#amount_offer').val();
     var discounts_offer=$('#discount_offer').val();
     var net_price_offer=$('#net_price_offer').val();

    // itemwise offer values ends

    var item_value_count = i++;

    var items='<tr id="row'+i+'" class="'+i+' tables"><input class="itemwiseoffer'+i+'" type="hidden" id="itemwiseoffer'+i+'" value="0" name="itemwiseoffer[]"><td><span class="item_s_no"> 1 </span></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="items_id" value="'+items_codes+'"><input type="hidden" class="item_code'+i+'" value="'+items_codes+'" name="item_code[]"><font class="items'+i+'">'+item_code+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="item_name'+i+'" type="hidden" value="'+item_name+'" name="item_name[]"><input type="hidden" value="'+item_name1+'" name="item_name1[]"><font class="font_item_name'+i+'">'+item_name+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="hsn'+i+'" type="hidden" value="'+hsn+'" name="hsn[]"><font class="font_hsn'+i+'">'+hsn+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="mrp'+i+'" value="'+mrp+'" name="mrp[]"><font class="font_mrp'+i+'">'+mrp+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12" id="unit_price"><input type="hidden" class="exclusive'+i+'" value="'+exclusive+'" name="exclusive[]"><font class="font_exclusive'+i+'">'+exclusive+'</font><input type="hidden" class="inclusive'+i+'" value="'+inclusive+'" name="inclusive[]"></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="quantity'+i+'" value="'+quantity+'" name="quantity[]"><font class="font_quantity'+i+'">'+quantity+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="uom'+i+'" value="'+uom_id+'" name="uom[]"><font class="font_uom'+i+'">'+uom_name+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_amount" id="amnt'+i+'" value="'+amount+'" name="amount[]"><font class="font_amount'+i+'">'+amount+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="input_discounts '+i+'" value="'+discounts+'" id="input_discount'+i+'" ><input class="discount_val'+i+'" type="hidden" value="'+discounts+'" name="discount[]"><font class="font_discount" id="font_discount'+i+'">'+discounts+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="overall_disc" id="overall_disc'+i+'" value="0" name="overall_disc[]"><font class="font_overall_disc'+i+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="expenses '+i+'" id="expenses'+i+'" value="0" name="expenses[]"><font class="font_expenses'+i+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_gst" id="tax'+i+'" value="'+gst+'" name="gst[]"><input type="hidden" class="tax_gst'+i+'"  value="'+tax_rate+'" name="tax_rate[]"><font class="font_gst'+i+'">'+gst+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_net_price" id="net_price'+i+'" value="'+net_price+'" name="net_price[]"><input type="hidden" class="black_or_white'+i+'"  value="'+black_or_white+'" name="black_or_white[]"><font class="font_net_price'+i+'">'+net_price+'</font></div></div></td><td style="background-color: #FAF860;"><div class="form-group row"><div class="col-sm-12"><center><font class="last_purchase'+i+'">'+last_purchase_rate+'</font></center></div></div></td><td><i class="fa fa-eye px-2 py-1 bg-info  rounded show_items" id="'+i+'" aria-hidden="true"></i><i class="fa fa-pencil px-2 py-1 bg-success  rounded edit_items" id="'+i+'" aria-hidden="true"></i><i class="fa fa-trash px-2 py-1 bg-danger  rounded remove_items" id="'+i+'" aria-hidden="true"></i></td></tr>\
\
\
    <tr id="row'+item_value_count+'" class="'+item_value_count+' tables"><input class="itemwiseoffer'+item_value_count+'" type="hidden" id="itemwiseoffer'+item_value_count+'" value="1" name="itemwiseoffer[]"><td><span class="item_s_no"> 1 </span></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="items_id" value="'+items_codes_offer+'"><input type="hidden" class="item_code'+item_value_count+'" value="'+items_codes_offer+'" name="item_code[]"><font class="items'+item_value_count+'">'+item_code_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="item_name'+item_value_count+'" type="hidden" value="'+item_name_offer+'" name="item_name[]"><input type="hidden" value="'+item_name1_offer+'" name="item_name1[]"><font class="font_item_name'+item_value_count+'">'+item_name_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="hsn'+item_value_count+'" type="hidden" value="'+hsn+'" name="hsn[]"><font class="font_hsn'+item_value_count+'">'+hsn_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="mrp'+item_value_count+'" value="'+mrp_offer+'" name="mrp[]"><font class="font_mrp'+item_value_count+'">'+mrp_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12" id="unit_price"><input type="hidden" class="exclusive'+item_value_count+'" value="'+exclusive_offer+'" name="exclusive[]"><font class="font_exclusive'+item_value_count+'">'+exclusive_offer+'</font><input type="hidden" class="inclusive'+item_value_count+'" value="'+inclusive_offer+'" name="inclusive[]"></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="quantity'+item_value_count+'" value="'+no_of_free_qty+'" name="quantity[]"><font class="font_quantity'+item_value_count+'">'+no_of_free_qty+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="uom'+item_value_count+'" value="'+uom_id_offer+'" name="uom[]"><font class="font_uom'+item_value_count+'">'+uom_name_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_amount_offer" id="amnt_offer'+item_value_count+'" value="'+amount_offer+'" name="amount[]"><font class="font_amount'+item_value_count+'">'+amount_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="input_discounts '+item_value_count+'" value="'+discounts_offer+'" id="input_discount'+item_value_count+'" ><input class="discount_val_offer'+item_value_count+'" type="hidden" value="'+discounts_offer+'" name="discount[]"><font class="font_discount" id="font_discount'+item_value_count+'">'+discounts_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="overall_disc" id="overall_disc'+item_value_count+'" value="0" name="overall_disc[]"><font class="font_overall_disc'+item_value_count+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="expenses '+item_value_count+'" id="expenses'+item_value_count+'" value="0" name="expenses[]"><font class="font_expenses'+item_value_count+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_gst" id="tax_offer'+item_value_count+'" value="'+gst_offer+'" name="gst[]"><input type="hidden" class="tax_gst'+item_value_count+'"  value="'+tax_rate_offer+'" name="tax_rate[]"><font class="font_gst'+item_value_count+'">'+gst_offer+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_net_price" id="net_price'+item_value_count+'" value="'+net_price_offer+'" name="net_price[]"><input type="hidden" class="black_or_white'+item_value_count+'"  value="'+black_or_white+'" name="black_or_white[]"><font class="font_net_price'+item_value_count+'">'+net_price_offer+'</font></div></div></td><td style="background-color: #FAF860;"><div class="form-group row"><div class="col-sm-12"><center><font class="last_purchase'+item_value_count+'">'+last_purchase_rate+'</font></center></div></div></td><td></td></tr>';

  }

  else
  {  

    var items='<tr id="row'+i+'" class="'+i+' tables"><input class="itemwiseoffer'+i+'" type="hidden" id="itemwiseoffer'+i+'" value="0" name="itemwiseoffer[]"><td><span class="item_s_no"> 1 </span></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="items_id" value="'+items_codes+'"><input type="hidden" class="item_code'+i+'" value="'+items_codes+'" name="item_code[]"><font class="items'+i+'">'+item_code+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="item_name'+i+'" type="hidden" value="'+item_name+'" name="item_name[]"><input type="hidden" value="'+item_name1+'" name="item_name1[]"><font class="font_item_name'+i+'">'+item_name+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input class="hsn'+i+'" type="hidden" value="'+hsn+'" name="hsn[]"><font class="font_hsn'+i+'">'+hsn+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="mrp'+i+'" value="'+mrp+'" name="mrp[]"><font class="font_mrp'+i+'">'+mrp+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12" id="unit_price"><input type="hidden" class="exclusive'+i+'" value="'+exclusive+'" name="exclusive[]"><font class="font_exclusive'+i+'">'+exclusive+'</font><input type="hidden" class="inclusive'+i+'" value="'+inclusive+'" name="inclusive[]"></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="quantity'+i+'" value="'+quantity+'" name="quantity[]"><font class="font_quantity'+i+'">'+quantity+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="uom'+i+'" value="'+uom_id+'" name="uom[]"><font class="font_uom'+i+'">'+uom_name+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_amount" id="amnt'+i+'" value="'+amount+'" name="amount[]"><font class="font_amount'+i+'">'+amount+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="input_discounts '+i+'" value="'+discounts+'" id="input_discount'+i+'" ><input class="discount_val'+i+'" type="hidden" value="'+discounts+'" name="discount[]"><font class="font_discount" id="font_discount'+i+'">'+discounts+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="overall_disc" id="overall_disc'+i+'" value="0" name="overall_disc[]"><font class="font_overall_disc'+i+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="expenses '+i+'" id="expenses'+i+'" value="0" name="expenses[]"><font class="font_expenses'+i+'">0</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_gst" id="tax'+i+'" value="'+gst+'" name="gst[]"><input type="hidden" class="tax_gst'+i+'"  value="'+tax_rate+'" name="tax_rate[]"><font class="font_gst'+i+'">'+gst+'</font></div></div></td><td><div class="form-group row"><div class="col-sm-12"><input type="hidden" class="table_net_price" id="net_price'+i+'" value="'+net_price+'" name="net_price[]"><input type="hidden" class="black_or_white'+i+'"  value="'+black_or_white+'" name="black_or_white[]"><font class="font_net_price'+i+'">'+net_price+'</font></div></div></td><td style="background-color: #FAF860;"><div class="form-group row"><div class="col-sm-12"><center><font class="last_purchase'+i+'">'+last_purchase_rate+'</font></center></div></div></td><td><i class="fa fa-eye px-2 py-1 bg-info  rounded show_items" id="'+i+'" aria-hidden="true"></i><i class="fa fa-pencil px-2 py-1 bg-success  rounded edit_items" id="'+i+'" aria-hidden="true"></i><i class="fa fa-trash px-2 py-1 bg-danger  rounded remove_items" id="'+i+'" aria-hidden="true"></i></td></tr>';

  }

  var result_val;

if($('.tables').length == 0)
{
  $('.append_proof_details').append(items);
}
else
{
  $('.items_id').each(function(){

    if($(this).val() == items_codes)
    {
      result_val = 1;
      return false;
    }
    else
    {
      result_val = 0;
    }

  });

  if(result_val == 1)
  {
    alert('Item Alredy Taken');
  }
  else
  {
    $('.append_proof_details').append(items);
  }
}

// for(var m=0;m<length+1;m++)
// {

//   var invoice_num = $('#invoice'+m).val();
  
//   for(var n=m+1;n<=length+1;n++)
//   {
    
//     if(typeof $('#invoice'+n).val() == 'undefined')
//     {

//     }
//     else
//     {
//       var invoice_num1 = $('#invoice'+n).val();

//       if(invoice_num == invoice_num1)
//       {
//         alert('Item S.No is Alredy Taken!');
//         $('#row'+i).remove();
//       }
//       else
//       {
        
//       }
//     }
//   }
// }

// for(var m=0;m<length+1;m++)
// {

//   var item_code_id_first = $('.item_code'+m).val();
  
//   for(var n=m+1;n<=length+1;n++)
//   {
    
//     if(typeof $('.item_code'+n).val() == 'undefined')
//     {

//     }
//     else
//     {
//       var item_code_id_second = $('.item_code'+n).val();

//       if(item_code_id_first == item_code_id_second)
//       {
//         alert('Item is Alredy Taken!');
//         $('#row'+i).remove();
//       }
//       else
//       {
        
//       }
//     }
//   }
// }
var total_qty = 0;
$('.qty').each(function(){

total_qty = parseInt(total_qty) + parseInt($(this).val());
$('#no_qty').val(parseInt(total_qty));
});

var total_net_price=calculate_total_net_price();
var total_amount=calculate_total_amount();
var total_gst=calculate_total_gst();

$("#total_price").val(total_net_price.toFixed(2));
$(".total_net_value").text(total_net_price.toFixed(2));
$("#grand_total").val(total_net_price.toFixed(2));
$("#total_amount").val(total_amount.toFixed(2));
$("#total_gst").val(total_gst.toFixed(2));
$("#igst").val(total_gst.toFixed(2));
var half_gst = parseFloat(total_gst)/2;
$("#cgst").val(half_gst.toFixed(2));
$("#sgst").val(half_gst.toFixed(2));

var to_html_total_net = total_net_price.toFixed(2);
var to_html_total_amount = total_amount.toFixed(2);
$(".total_net_price").html(parseFloat(to_html_total_net));
$(".total_amount").html(parseFloat(to_html_total_amount));


var q=calculate_total_discount();
$('#total_discount').val(q.toFixed(2));
$('#disc_total').val(q.toFixed(2));
// //overall_discounts();
individual_expense();
roundoff_cal();
total_expense_cal();

var len=$('.tables').length;
$('#counts').val(len);
i++;

// var array=[invoice_no,voucher_date,items_codes,item_code,item_name,mrp,hsn,quantity,tax_rate,gst,exclusive,uom_id,uom_name,inclusive,amount,discount,discount_percentage,net_price];

// var array_new=[voucher_date,receipt_note_no,supplier_invoice_no,supplier_invoice_date,
//               supplier_details,order_details,transport_details,remarks,supplier_invoice_value];

// $.ajax({
//            type: "GET",
//             url: "{{ url('purchase/get_items/{id}') }}",
//             data: { id: len },
//            success: function(data) {
//              // console.log(data);
//              $('#items_codes').children('option:not(:first)').remove();
//              for (var k=0; k < data.length; k++)
//             {
//              name =data[k].name;
//              code =data[k].code;
//              id =data[k].id;
//               names = name.replace('','');
//               codes = code.replace('','');
              
//               var div_data="<option value="+id+">"+codes+"</option>";
                
//                 $(div_data).appendTo('#items_codes');

//             }
//            }
           
//         });



$('#cat').hide();
$('.item_sno').val('');
$('.items_codes').val('');
$('.item_name').val('');
$('.mrp').val('');
$('.hsn').val('');
$('.quantity').val('');
$('.tax_rate').val('');
$('#exclusive').val('');
$('#inclusive').val('');
$('.amount').val('');
$('#discount').val('');
$('#discounts').val('');
$('.discount_percentage').val('');
$('.net_price').val('');
$('.gst').val('');
$('.item_code').val('');
$('#last_purchase_rate').val(0);
$('.uom_inclusive').children('option').remove();
$('.uom_exclusive').children('option').remove();
$("select").select2();
}
} 
$(document).on("click",".add_items",function(){
    add_items();
    item_details_sno();

  });

$(document).on("click",".remove_items",function(){
  

     var button_id = $(this).attr("id");
     var free_item = parseInt(button_id)-1;

     var data_val = $('.item_code'+button_id).val();
     var invoice_no=$('.invoice_no'+button_id).val();
     if($('#itemwiseoffer'+free_item).val() == 1)
     {
      $('#row'+button_id).remove();
      $('#row'+free_item).remove();
     }
     else
     {
      $('#row'+button_id).remove();
     }
     var q=calculate_total_discount();
     $('#total_discount').val(q.toFixed(2));
     $('#disc_total').val(q.toFixed(2));
     var counts = $('#counts').val();
     $('#counts').val(counts-1); 
     item_details_sno();

       
        
        

    var total_net_price=calculate_total_net_price();
    var to_html_total_net = total_net_price.toFixed(2);

    $(".total_net_price").html(parseFloat(to_html_total_net));

    var total_amount=calculate_total_amount();
    var to_html_total_amount = total_amount.toFixed(2);
    $(".total_amount").html(parseFloat(to_html_total_amount));
    $(".total_net_value").text(to_html_total_net);
    $("#grand_total").val(total_net_price.toFixed(2));
    var total_gst=calculate_total_gst();

    $("#total_price").val(total_net_price.toFixed(2));
    $("#total_amount").val(total_amount.toFixed(2));
    $("#total_gst").val(total_gst.toFixed(2));
    $("#igst").val(total_gst.toFixed(2));
    var half_gst = parseFloat(total_gst)/2;
    $("#cgst").val(half_gst.toFixed(2));
    $("#sgst").val(half_gst.toFixed(2));
    total_expense_cal();
    individual_expense();
    // //overall_discounts();
    roundoff_cal();

    $.ajax({
           type: "GET",
            url: "{{ url('sale_order/remove_data/{id}') }}",
            data: { data_val: data_val },
           success: function(data) {
             console.log(data);

             for(var new_val = 0; new_val < data[1].cnt; new_val++)
             {
              var tax_master_id = data[1].tax_master[new_val];

              var tax_master_input_val = $('#'+tax_master_id).attr('class').split(' ')[1];

              if(tax_master_id == tax_master_input_val)
              {
                var sub = parseFloat($('#'+tax_master_id).val()) - parseFloat(data[1].tax_val[new_val]);

                $('#'+tax_master_id).val(sub);
              }
              else
              {

              }

             }


             
           }
        });
    
    $('#cat').hide();
    $('.item_sno').val('');
    $('.items_codes').val('');
    $('.item_name').val('');
    $('.mrp').val('');
    $('.hsn').val('');
    $('.quantity').val('');
    $('.tax_rate').val('');
    $('#exclusive').val('');
    $('#inclusive').val('');
    $('.amount').val('');
    $('#discount').val('');
    $('#discounts').val('');
    $('.discount_percentage').val('');
    $('.net_price').val('');
    $('.gst').val('');
    $('.item_code').val('');
    $('#last_purchase_rate').val(0);
    $('.uom_inclusive').children('option').remove();
    $('.uom_exclusive').children('option').remove();
    $("select").select2();
    $('.add_items').show();
    $('.update_items').hide();
    

    $.ajax({
           type: "POST",
            url: "{{ url('purchase/remove_data/') }}",
            data: { invoice_no: invoice_no, gatepass_no: gatepass_no },
           success: function(data) {
             // console.log(data);
             
           }
        });


  
});

$(document).on("click",".edit_items",function(){
  // alert($('#mytable tr:last').attr('class').);return false;
  $('.update_items').show();
  $('.add_items').hide();

  var id = $(this).attr("id");
  $('#dummy_table_id').val(id);
  var invoice_no = $('.invoice_no'+id).val(); 
  var item_code_id = $('.item_code'+id).val();
  var item_code_name = $('.items'+id).text(); 
  var item_name = $('.item_name'+id).val();
  var hsn = $('.hsn'+id).val(); 
  var mrp = $('.mrp'+id).val();
  var discount_val = $('.discount_val'+id).val(); 
  var exclusive = $('.exclusive'+id).val();
  var inclusive = $('.inclusive'+id).val(); 
  var quantity = $('.quantity'+id).val();
  var uom = $('.uom'+id).val(); 
  var uom_name = $('.font_uom'+id).text();
  var amnt = $('#amnt'+id).val();
  var tax = $('#tax'+id).val(); 
  var tax_gst = $('.tax_gst'+id).val();
  var net_price = $('#net_price'+id).val(); 
  var last_purchase_rate = $('.last_purchase'+id).text();

  $('.exclusive_rate').val(exclusive);
  $('.inclusive_rate').val(inclusive);
  $('.item_sno').val(invoice_no);
  $('.items_codes').val(item_code_id);
  $('.item_name').val(item_name);
  $('.item_code').val(item_code_name);
  $('.mrp').val(mrp);
  $('.hsn').val(hsn);
  $('.quantity').val(quantity);
  $('.tax_rate').val(tax_gst);
  $('.amount').val(amnt);
  $('.net_price').val(net_price);
  $('.gst').val(tax);
  $('.uom').val(uom);
  $('.uom_name').val(uom_name);
  $('#last_purchase_rate').val(last_purchase_rate);
  var disc_value = parseFloat(discount_val)/parseFloat(quantity);
  $('.discount_rs').val(disc_value.toFixed(2));
  discount_calc();
   
  if(discount_val == 0)
  {
    $('.discount_percentage').val('');
  $('.discount_rs').val('');
  }
   // item_codes(item_code_id);

});

$(document).on("click",".refresh_supplier_id",function(){
      var supplier_dets=refresh_supplier_master_details();
      $(".supplier_id").html(supplier_dets);
   });

$(document).on("click",".refresh_customer_id",function(){
      var customer_dets=refresh_customer_master_details();
      $(".customer_id").html(customer_dets);
   });

$(document).on("click",".refresh_agent_id",function(){
      var agent_dets=refresh_agent_master_details();
      $(".agent_id").html(agent_dets);
   });

$(document).on("click",".refresh_expense_type_id",function(){
      var expense_type_dets=refresh_expense_type_master_details();
      $(".expense_type").html(expense_type_dets);
   });

$(document).on("click",".update_items",function(){
  var discount_total = 0;

  var td_id = $('#dummy_table_id').val();
  var free_td_id = td_id-1;

 var invoice_no=$('.item_sno').val();
 var item_code=$("#item_code").val();
 var item_name=$('.item_name').val();
 var mrp=$('.mrp').val();
 var quantity=$('.quantity').val();
 var exclusive=$('#exclusive').val();
 var inclusive=$('#inclusive').val();
 var net_price=$('.net_price').val();
 var itemwiseoffer=$("#itemwiseoffer").val();
 var buy_quantity_offer=$('#buy_quantity_offer').val();
  
  if(item_code == '' || quantity == '' || exclusive == '' && inclusive == '')
 {
  alert('Please Fill All The Input Fields');
 }
 else if(item_name == '')
 {
  alert('Sorry There Is No  Such Item Code!!');
  $("#item_code").val('');
  $("#item_code").focus();
 }
 // else if(parseFloat(inclusive)>parseFloat(mrp))
 // {
 //  alert('Rate Exceeds The MRP!!');
 //  $('#exclusive').val('');
 //  $('#inclusive').val('');
 // }

 else if(itemwiseoffer == 1 && parseInt(quantity) >= parseInt(buy_quantity_offer))
 {

    var free_quantity = parseInt(quantity)/parseInt(buy_quantity_offer);

    var no_of_free_qty = parseInt(free_quantity);

    var rate_exclusive_offer = $('#exclusive_offer').val();
    var rate_inclusive_offer = $('#inclusive_offer').val();
    // var quantity_offer = $('#quantity_offer').val();
    var tax_rate_offer = $('#tax_rate_offer').val();
    var total_offer = parseInt(no_of_free_qty)*parseFloat(rate_exclusive_offer);
    $('#amount_offer').val(total_offer.toFixed(2));
    $('#discount_offer').val(total_offer.toFixed(2));
    if(tax_rate_offer == '')
      {
        $('#net_price_offer').val(0.00);
      }
    var rate_offer = parseFloat(tax_rate_offer)/100;
    var gst_rate_offer = parseFloat(rate_exclusive_offer)*parseFloat(rate_offer);
    var gst_rate_inclusive_offer = parseFloat(rate_exclusive_offer)+parseFloat(gst_rate_offer);
    var net_val_offer = parseFloat(total_offer)*parseFloat(rate_offer);
    $('#gst_offer').val(net_val_offer.toFixed(2));
    $('#net_price_offer').val(net_val_offer.toFixed(2));


  $('.invoice_no'+td_id).val($('.item_sno').val());
  $('.item_no'+td_id).text($('.item_sno').val());
  $('.item_code'+td_id).val($('.items_codes').val());
  $('.items'+td_id).text($('.item_code').val());
  $('.item_name'+td_id).val($('.item_name').val());
  $('.font_item_name'+td_id).text($('.item_name').val());
  $('.hsn'+td_id).val($('.hsn').val());
  $('.font_hsn'+td_id).text($('.hsn').val());
  $('.mrp'+td_id).val($('.mrp').val());
  $('.font_mrp'+td_id).text($('.mrp').val());
  $('.exclusive'+td_id).val($('.exclusive_rate').val());
  $('.font_exclusive'+td_id).text($('.exclusive_rate').val());
  $('.inclusive'+td_id).val($('.inclusive_rate').val());
  $('.quantity'+td_id).val($('.quantity').val());
  $('.font_quantity'+td_id).text($('.quantity').val());
  $('.uom'+td_id).val($('.uom').val());
  $('.font_uom'+td_id).text($('.uom_name').val());
  $('#amnt'+td_id).val($('.amount').val());
  $('.font_amount'+td_id).text($('.amount').val());
  $('.black_or_white'+td_id).val($('#b_or_w').val());
  $('#tax'+td_id).val($('.gst').val());
  $('.tax_gst'+td_id).val($('.tax_rate').val());
  $('.font_gst'+td_id).text($('.gst').val());
  $('.last_purchase'+td_id).text($('#last_purchase_rate').val());


   if($('.discount_percentage').val() == '' && $('.discount_rs').val() == '')
   {
    var discount=0;
    $('.discount_val'+td_id).val(discount);
    $('#font_discount'+td_id).text(discount);
    $('#input_discount'+td_id).val(discount);
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));

   }
   else
   {
    $('.discount_val'+td_id).val($('#discounts').val());
    $('#font_discount'+td_id).text($('#discounts').val());
    $('#input_discount'+td_id).val($('#discounts').val());
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));
   }

  $('#net_price'+td_id).val($('.net_price').val());
  $('.font_net_price'+td_id).text($('.net_price').val());  


  $('.item_code'+free_td_id).val($('#items_codes_offer').val());
  $('.items'+free_td_id).text($("#item_code_offer").val());
  $('.item_name'+free_td_id).val($('#item_name_offer').val());
  $('.font_item_name'+free_td_id).text($('#item_name_offer').val());
  $('.hsn'+free_td_id).val($('#hsn_offer').val());
  $('.font_hsn'+free_td_id).text($('#hsn_offer').val());
  $('.mrp'+free_td_id).val($('#mrp_offer').val());
  $('.font_mrp'+free_td_id).text($('#mrp_offer').val());
  $('.exclusive'+free_td_id).val($('#exclusive_offer').val());
  $('.font_exclusive'+free_td_id).text($('#exclusive_offer').val());
  $('.inclusive'+free_td_id).val($('#inclusive_offer').val());
  $('.quantity'+free_td_id).val(no_of_free_qty);
  $('.font_quantity'+free_td_id).text(no_of_free_qty);
  $('.uom'+free_td_id).val($('#uom_offer').val());
  $('.font_uom'+free_td_id).text($('#uom_name_offer').val());
  $('#amnt'+free_td_id).val($('#amount_offer').val());
  $('.font_amount'+free_td_id).text($('#amount_offer').val());
  $('.black_or_white'+free_td_id).val($('#b_or_w').val());
  $('#tax'+free_td_id).val($('#gst_offer').val());
  $('.tax_gst'+free_td_id).val($('#tax_rate_offer').val());
  $('.font_gst'+free_td_id).text($('#gst_offer').val());
  $('.last_purchase'+free_td_id).text($('#last_purchase_rate').val());


   if($('.discount_percentage').val() == '' && $('.discount_rs').val() == '')
   {
    var discount=0;
    $('.discount_val'+free_td_id).val($('#discount_offer').val());
    $('#font_discount'+free_td_id).text($('#discount_offer').val());
    $('#input_discount'+free_td_id).val($('#discount_offer').val());
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));

   }
   else
   {
    $('.discount_val'+free_td_id).val($('#discount_offer').val());
    $('#font_discount'+free_td_id).text($('#discount_offer').val());
    $('#input_discount'+free_td_id).val($('#discount_offer').val());
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));
   }

  $('#net_price'+free_td_id).val($('#net_price_offer').val());
  $('.font_net_price'+free_td_id).text($('#net_price_offer').val());

  var total_net_price=calculate_total_net_price();
  var total_amount=calculate_total_amount();
  var total_gst=calculate_total_gst();
  $("#total_price").val(total_net_price.toFixed(2));
  $(".total_net_value").text(total_net_price.toFixed(2));
  $("#total_amount").val(total_amount.toFixed(2));
  $("#total_gst").val(total_gst.toFixed(2));
  $("#igst").val(total_gst.toFixed(2));
  var half_gst = parseFloat(total_gst)/2;
  $("#cgst").val(half_gst.toFixed(2));
  $("#sgst").val(half_gst.toFixed(2));
  var to_html_total_net = total_net_price.toFixed(2);
  var to_html_total_amount = total_amount.toFixed(2);
  $(".total_net_price").html(parseFloat(to_html_total_net));
  $(".total_amount").html(parseFloat(to_html_total_amount));
  total_expense_cal();
  // overall_discounts();
  individual_expense();
  roundoff_cal();

  

  
  $('.item_sno').val('');
  $('.items_codes').val('');
  $('.item_name').val('');
  $('.mrp').val('');
  $('.hsn').val('');
  $('.quantity').val('');
  $('#actual_qty').val('');
  $('.tax_rate').val('');
  $('#exclusive').val('');
  $('#inclusive').val('');
  $('.amount').val('');
  $('#discount').val('');
  $('.discount_percentage').val('');
  $('.net_price').val('');
  $('.gst').val('');
  $('.item_code').val('');
  $('#discounts').val('');
  $('#last_purchase_rate').val(0);
  $('.uom_inclusive').children('option').remove();
  $('.uom_exclusive').children('option').remove();
  $("select").select2();
  $('.update_items').hide();
  $('.add_items').show();
  $("#b_w").load(" #b_w > *");
  
  }

  else
 {
  
  $('.invoice_no'+td_id).val($('.item_sno').val());
  $('.item_no'+td_id).text($('.item_sno').val());
  $('.item_code'+td_id).val($('.items_codes').val());
  $('.items'+td_id).text($('.item_code').val());
  $('.item_name'+td_id).val($('.item_name').val());
  $('.font_item_name'+td_id).text($('.item_name').val());
  $('.hsn'+td_id).val($('.hsn').val());
  $('.font_hsn'+td_id).text($('.hsn').val());
  $('.mrp'+td_id).val($('.mrp').val());
  $('.font_mrp'+td_id).text($('.mrp').val());
  $('.exclusive'+td_id).val($('.exclusive_rate').val());
  $('.font_exclusive'+td_id).text($('.exclusive_rate').val());
  $('.inclusive'+td_id).val($('.inclusive_rate').val());
  $('.quantity'+td_id).val($('.quantity').val());
  $('.font_quantity'+td_id).text($('.quantity').val());
  $('.uom'+td_id).val($('.uom').val());
  $('.font_uom'+td_id).text($('.uom_name').val());
  $('#amnt'+td_id).val($('.amount').val());
  $('.font_amount'+td_id).text($('.amount').val());
  $('.black_or_white'+td_id).val($('#b_or_w').val());
  $('#tax'+td_id).val($('.gst').val());
  $('.tax_gst'+td_id).val($('.tax_rate').val());
  $('.font_gst'+td_id).text($('.gst').val());
  $('.last_purchase'+td_id).text($('#last_purchase_rate').val());


   if($('.discount_percentage').val() == '' && $('.discount_rs').val() == '')
   {
    var discount=0;
    $('.discount_val'+td_id).val(discount);
    $('#font_discount'+td_id).text(discount);
    $('#input_discount'+td_id).val(discount);
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));

   }
   else
   {
    $('.discount_val'+td_id).val($('#discounts').val());
    $('#font_discount'+td_id).text($('#discounts').val());
    $('#input_discount'+td_id).val($('#discounts').val());
    var q=calculate_total_discount();
    $('#total_discount').val(q.toFixed(2));
    $('#disc_total').val(q.toFixed(2));
   }

  $('#net_price'+td_id).val($('.net_price').val());
  $('.font_net_price'+td_id).text($('.net_price').val());

  var total_net_price=calculate_total_net_price();
  var total_amount=calculate_total_amount();
  var total_gst=calculate_total_gst();
  $("#total_price").val(total_net_price.toFixed(2));
  $(".total_net_value").text(total_net_price.toFixed(2));
  $("#total_amount").val(total_amount.toFixed(2));
  $("#total_gst").val(total_gst.toFixed(2));
  $("#igst").val(total_gst.toFixed(2));
  var half_gst = parseFloat(total_gst)/2;
  $("#cgst").val(half_gst.toFixed(2));
  $("#sgst").val(half_gst.toFixed(2));
  var to_html_total_net = total_net_price.toFixed(2);
  var to_html_total_amount = total_amount.toFixed(2);
  $(".total_net_price").html(parseFloat(to_html_total_net));
  $(".total_amount").html(parseFloat(to_html_total_amount));
  total_expense_cal();
  // overall_discounts();
  individual_expense();
  roundoff_cal();

  

  
  $('.item_sno').val('');
  $('.items_codes').val('');
  $('.item_name').val('');
  $('.mrp').val('');
  $('.hsn').val('');
  $('.quantity').val('');
  $('#actual_qty').val('');
  $('.tax_rate').val('');
  $('#exclusive').val('');
  $('#inclusive').val('');
  $('.amount').val('');
  $('#discount').val('');
  $('.discount_percentage').val('');
  $('.net_price').val('');
  $('.gst').val('');
  $('.item_code').val('');
  $('#discounts').val('');
  $('#last_purchase_rate').val(0);
  $('.uom_inclusive').children('option').remove();
  $('.uom_exclusive').children('option').remove();
  $("select").select2();
  $('.update_items').hide();
  $('.add_items').show();
  $("#b_w").load(" #b_w > *");
  
  }
  
  });

$(document).on("click",".show_items",function(){
    var id = $(this).attr("id");
  $('.item_show').dialog({width : 1000}).prev(".ui-dialog-titlebar").css("background","#28a745");
  $('.show_item_code').text($('.items'+id).text());
  $('.show_item_name').text($('.item_name'+id).val());
  $('.show_hsn').text($('.hsn'+id).val());
  $('.show_mrp').text($('.mrp'+id).val());
  $('.show_unit_price').text($('.exclusive'+id).val());
  $('.show_quantity').text($('.quantity'+id).val());
  $('.show_uom').text($('.font_uom'+id).text());
  $('.show_amount').text($('#amnt'+id).val());
  $('.show_discount').text($('.discount_val'+id).val());
  $('.show_gst_rs').text($('#tax'+id).val());
  $('.show_net_value').text($('#net_price'+id).val());
  $('.show_last_purchase').text($('.last_purchase'+id).text());

});

function expense_add()
{
  
  if($("#total_price").val() == 0 || $("#total_price").val() == '')
  {
    alert('You Cannot Add Expense Without Adding Item Details!!');
  }
  else
  {

  var expense_details='<div class="row col-md-12 expense"><div class="col-md-3"><label style="font-family: Times new roman;">Expense Type</label><br><div class="form-group row"><div class="col-sm-8"><select class="js-example-basic-multiple col-12 form-control custom-select expense_type" name="expense_type[]"><option value="">Choose Expense Type</option>@foreach($expense_type as $expense_types)<option value="{{ $expense_types->id}}">{{ $expense_types->type}}</option>@endforeach</select></div><a href="{{ url("master/expense-type/create")}}" target="_blank"><button type="button"  class="px-2 btn btn-success ml-2" title="Add Expense type"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a><button type="button"  class="px-2 btn btn-success mx-2 refresh_expense_type_id" title="Add Expense Type"><i class="fa fa-refresh" aria-hidden="true"></i></button></div></div><div class="col-md-2"><label style="font-family: Times new roman;">Expense Amount</label><input type="number" class="form-control expense_amount"  placeholder="Expense Amount" name="expense_amount[]" pattern="[0-9]{0,100}" title="Numbers Only" value=""></div><div class="col-md-2"><label><font color="white" style="font-family: Times new roman;">Add Expense</font></label><br><input type="button" class="btn btn-success" value="+" onclick="expense_add()" name="" id="add_expense">&nbsp;<input type="button" class="btn btn-danger remove_expense" value="-" name="" id="remove_expense"></div></div>'

  $('.append_expense').append(expense_details);
  $("select").select2();
  total_expense_cal();
  roundoff_cal();
  var length=$('.expense').length;
  $('#expense_count').val(length);

  }

}

$(document).on("click",".remove_expense",function(){

  if($(".remove_expense").length > 1){

    $(this).closest('.expense').remove();
    var length = $('#expense_count').val();

    $('#expense_count').val(length-1);
  }
  else{
    alert("Atleast One row present");

  }
  total_expense_cal();
  //overall_discounts();
  individual_expense();
  roundoff_cal();

  });

function item_details_sno(){
  $(".item_s_no").each(function(key,index){
      $(this).html((key+1));
      $('#no_item').val(++key);
    });
}


  $("form").submit(function(e){
  if($('#total_price').val() == 0 || $('#total_price').val() == '')
  {
    alert('There Is No Row To Submit');
    e.preventDefault();
  }
  else
  {

  }    
    });

  
function qty()
{
  var rate_exclusive = $('#exclusive').val();
  var rate_inclusive = $('#inclusive').val();
  var quantity = $('#quantity').val();
  var tax_rate = $('.tax_rate').val();
  var total = parseInt(quantity)*parseFloat(rate_exclusive);
  $('#amount').val(total.toFixed(2));
  if(tax_rate == '')
  {
    $('#net_price').val(total.toFixed(2));
  }
  var rate = parseFloat(tax_rate)/100;
  var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
  var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
  var net_val = parseFloat(total)*parseFloat(rate);

  $('.gst').val(net_val.toFixed(2));

  var total_net_val = parseFloat(total)+parseFloat(net_val);
  $('#net_price').val(total_net_val.toFixed(2));
}

function gst_calc()
{
  var quantity = $('#quantity').val();
  var rate_exclusive = $('#exclusive').val();
  var rate_inclusive = $('#inclusive').val();
  var tax_rate = $('.tax_rate').val();

  if(rate_exclusive != '' && rate_inclusive != '' && quantity != '')
  {
    calc_exclusive();
  }
  else
  {

  }
}


function calc_exclusive()
{
  var quantity = $('#quantity').val();
  var rate_exclusive = $('#exclusive').val();
  var rate_inclusive = $('#inclusive').val();
  var tax_rate = $('.tax_rate').val();
  var mrp = $('.mrp').val();



  if (quantity == '') 
  {
    alert('Please Enter Quantity First');
    $('#exclusive').val('');
    $('#inclusive').val('');
    $('#quantity').focus();
  }

  // else if(mrp == '')
  // {
  //   alert('Please Select Any Item');
  //   $('#exclusive').val('');
  //   $('#inclusive').val('');
  // }
  // else if(parseFloat(rate_inclusive)>parseFloat(mrp))
  // {
  //   alert('Rate Exceeds The MRP!!');
  //   $('#exclusive').val('');
  //   $('#inclusive').val('');
  // }
  
  else
  {
    // if(quantity == 0)
    // {
    //   quantity =1;
    //   $('#quantity').val(1);
    // }
  
      var total = parseInt(quantity)*parseFloat(rate_exclusive);
    
    $('#amount').val(total.toFixed(2));

    if(tax_rate == '')
    {
      $('#net_price').val(total.toFixed(2));
    }
    else
    {

      var rate = parseFloat(tax_rate)/100;
      var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
      var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
      $('#inclusive').val(gst_rate_inclusive.toFixed(2));
      if($('#inclusive').val()>parseFloat(mrp))
      {
        if(mrp == 0 || mrp == '')
        {
          var net_val = parseFloat(total)*parseFloat(rate);
      //alert(net_val);
          $('.gst').val(net_val.toFixed(2));

          var total_net_val = parseFloat(total)+parseFloat(net_val);
          $('#net_price').val(total_net_val.toFixed(2));
        }
        else
        {
          alert('Rate Exceeds The MRP!!');
        $('#exclusive').val('');
        $('#inclusive').val('');
        }
        
      }
      else
      {
        //alert(rate);
      var net_val = parseFloat(total)*parseFloat(rate);
      //alert(net_val);
      $('.gst').val(net_val.toFixed(2));

      var total_net_val = parseFloat(total)+parseFloat(net_val);
      $('#net_price').val(total_net_val.toFixed(2));
      }
      

    }

   } 
  
}

function calc_inclusive()
{
  
  var quantity = $('#quantity').val();
  var rate_exclusive = $('#exclusive').val();
  var rate_inclusive = $('#inclusive').val();
  var mrp = $('.mrp').val();
  var tax_rate = $('.tax_rate').val();
  

  if (quantity == '') 
  {
    alert('Please Enter Quantity First');
    $('#exclusive').val('');
    $('#inclusive').val('');
    $('#quantity').focus();
  }
  // else if(mrp == '')
  // {
  //   alert('Please Select Any Item');
  //   $('#exclusive').val('');
  //   $('#inclusive').val('');
  // }
  
  // else if(parseFloat(rate_inclusive)>parseFloat(mrp))
  // {
  //   if(mrp == 0 || mrp == '')
  //       {

  //       }
  //       else
  //       {
  //         alert('Rate Exceeds The MRP!!');
  //       $('#exclusive').val('');
  //       $('#inclusive').val('');
  //       }
  // }
    else
    {
    if(tax_rate == '')
    {
      $('#net_price').val(total.toFixed(2));
    }
    else
    {
      // if(quantity == 0)
      // {
      //   quantity =1;
      //   $('#quantity').val(1);
      // }

      var rate=parseFloat(tax_rate)/100+1;
      var actual_tax = parseFloat(tax_rate)/100;
      var gst_rate = parseFloat(rate_inclusive)/parseFloat(rate);
      var total = parseInt(quantity)*parseFloat(gst_rate.toFixed(2));
      $('#amount').val(total.toFixed(2));
      $('#exclusive').val(gst_rate.toFixed(2));
      if(parseFloat(rate_inclusive)>parseFloat(mrp))
      {
        if(mrp == 0 || mrp == '')
            {

            }
            else
            {
              alert('Rate Exceeds The MRP!!');
            $('#exclusive').val('');
            $('#inclusive').val('');
            }
      }
      var net_val = parseFloat(total)*parseFloat(actual_tax);
      $('.gst').val(net_val.toFixed(2));
      var total_net_val = parseFloat(total)+parseFloat(net_val);
      $('#net_price').val(total_net_val.toFixed(2));

    }

  }
    
  
}

function calc_tax()
{
  
  $("#exclusive").attr('readonly','readonly');
  $("#inclusive").removeAttr('readonly');
  $("#inclusive").focus();
  $("#exclusive").val('');
  $("#amount").val('');
  $("#net_price").val('');
  $("#discount").val('');
  
}

function calc_tax1()
{
  
  
  $("#exclusive").removeAttr('readonly');
  $("#inclusive").attr('readonly','readonly');
  $("#exclusive").focus();
  $("#inclusive").val('');
  $("#amount").val('');
  $("#net_price").val('');
  $("#discount").val('');
}

function discount_calc()
{
  var discount = $(".discount_rs").val();
  var discount_percentage = $(".discount_percentage").val();
  //alert(discount_percentage);
  var amount = $("#amount").val();
  var quantity = $("#quantity").val();
  var exclusive = $("#exclusive").val();
  var inclusive = $("#inclusive").val();
  var tax_rate = $("#tax_rate").val();
 
  if(amount == '' || quantity == '' || exclusive == '' && inclusive == '')
  {
    alert('There is no amount to Discount');
    $("#quantity").val('');
    $("#exclusive").val('');
    $("#inclusive").val('');
    $("#amount").val('');
    $(".discount_percentage").val('');
    $(".discount_rs").val('');
    $(".gst").val('');

  }

  else if(discount == '' && discount_percentage == '')
  {
    
  }

  else
  {

  // var rate_exclusive_disc_val = parseFloat(exclusive) - parseFloat(discount);
  // var rate_inclusive_disc_val = parseFloat(inclusive) - parseFloat(discount);

  // $('#rate_exclusive_disc_val').val(rate_exclusive_disc_val.toFixed(2));
  // $('#rate_inclusive_disc_val').val(rate_inclusive_disc_val.toFixed(2));
  var disc_amount_exclusive = parseFloat(discount)*100/parseFloat(exclusive);

   $(".discount_percentage").val(disc_amount_exclusive.toFixed(2));

  qty();
  var amount = $(".amount").val();
  var discounts = parseInt(quantity)*parseFloat(discount);
  $('#discounts').val(discounts.toFixed(2));
  var rate=parseFloat(tax_rate)/100;
  var net_val = parseFloat(amount)*parseFloat(rate);
  $('.gst').val(net_val.toFixed(2));

  var total_net_val = parseFloat(amount)+parseFloat(net_val);
  total_net_val = parseFloat(total_net_val)-parseFloat(discounts);
  $('#net_price').val(total_net_val.toFixed(2));

  }
  
}

function discount_calc1()
{
  var discount = $(".discount_rs").val();
  var discount_percentage = $(".discount_percentage").val();
  var amount = $("#amount").val();
  var quantity = $("#quantity").val();
  var exclusive = $("#exclusive").val();
  var inclusive = $("#inclusive").val();
  var tax_rate = $("#tax_rate").val();
 
  if(amount == '' || quantity == '' || exclusive == '' && inclusive == '')
  {
    alert('There is no amount to Discount');
    $("#quantity").val('');
    $("#exclusive").val('');
    $("#inclusive").val('');
    $("#amount").val('');
    $(".discount_percentage").val('');
    $(".discount_rs").val('');
    $(".gst").val('');
  }
  else if(discount == '' && discount_percentage == '')
  {

  }
  
  else
  {

  var disc_rate = parseFloat(discount_percentage)/100;
  var disc_val_exclusive = parseFloat(exclusive)*parseFloat(disc_rate);
  var disc_val_inclusive = parseFloat(inclusive)*parseFloat(disc_rate);
  
  var disc_amount_exclusive = parseFloat(exclusive)-parseFloat(disc_val_exclusive);
  var disc_amount_inclusive = parseFloat(inclusive)-parseFloat(disc_val_inclusive);

  $(".discount_rs").val(disc_val_exclusive.toFixed(2));
  qty();
  var amount = $(".amount").val();
  var discounts = parseInt(quantity)*parseFloat(disc_val_exclusive.toFixed(2));
  $('#discounts').val(discounts.toFixed(2));
  var rate=parseFloat(tax_rate)/100;
  var net_val = parseFloat(amount)*parseFloat(rate);
  $('.gst').val(net_val.toFixed(2));

  var total_net_val = parseFloat(amount)+parseFloat(net_val);
  total_net_val = parseFloat(total_net_val)-parseFloat(discounts);
  $('#net_price').val(total_net_val.toFixed(2));

  }
  
  
  
}

function item_codes(item_code,append_value)
{

if(append_value == 1)
{
  var row_id=$('#last').val();

      $.ajax({  
        
        type: "GET",
        url: "{{ url('pos/getdata/{id}') }}",
        data: { id: item_code },             
                        
        success: function(data){ 

             // $('.uom_exclusive').children('option:(:first)').remove();
             // $('.uom_inclusive').children('option:(:first)').remove();
             $('.uom_exclusive').children('option').remove();
             $('.uom_inclusive').children('option').remove();

             id = data[0].item_id;
             name =data[0].item_name;
             code =data[0].code;
             mrp =data[0].mrp;
             hsn =data[0].hsn;
             uom_id =data[0].uom_id;
             ptc_code =data[0].ptc;
             uom_name =data[0].uom_name;
             igst =data[1].igst;
             barcode = data[2].barcode;
             selling_price = data.selling_price;
             selling_price_type = data.selling_price_type;

             variable = data['variable'];
             discount_value = data['discount'];

             itemwise_offer = data['itemwise_offer'];
             itemwise_offer_item_id = data['itemwise_offer_item_id'];
             get_item_qty = data['get_item_qty'];
             buy_item_qty = data['buy_item_qty'];

             if(itemwise_offer == '1')
             {
              $('#itemwiseoffer').val(1);
              itemwise_offers(itemwise_offer_item_id,get_item_qty,buy_item_qty);

             }
             else
             {
              $('#itemwiseoffer').val(0);
             }

             for(var new_val = 0; new_val < data[1].cnt; new_val++)
             {
              var tax_master_id = data[1].tax_master[new_val];

              var tax_master_input_val = $('#'+tax_master_id).attr('class').split(' ')[1];

              if(tax_master_id == tax_master_input_val)
              {
                var sum = parseFloat($('#'+tax_master_id).val()) + parseFloat(data[1].tax_val[new_val]);

                $('#'+tax_master_id).val(sum);
              }
              else
              {

              }

             }

              var first_data='<option value="'+id+'">'+uom_name+'</option>';
              $('.uom_exclusive').append(first_data);
              $('.uom_inclusive').append(first_data);
              for(var i=0;i<data[3].length;i++)
             {
              var item_uom_id=data[3][i].id;
              var item_uom_name=data[3][i].name;
              var item_id=data[3][i].item_id;
              if(item_uom_name == uom_name)
              {

              }
              else
              {
                var div_data='<option value="'+item_id+'">'+item_uom_name+'</option>';
                $('.uom_exclusive').append(div_data);
                $('.uom_inclusive').append(div_data);
              }
              
             }

             var rate=parseFloat(igst)/100+1;
             var actual_tax = parseFloat(igst)/100;
             var inclusive_rate = parseFloat(selling_price)/parseFloat(rate);
                       
             //$('#item_code').val(code);
             $('#item_code').val(code);
             $('#items_codes').val(id);
             $('#item_name').val(name);
             $('#mrp').val(mrp);
             $('#hsn').val(hsn);
             $('#uom').val(uom_id);
             $('#uom_name').val(uom_name);
             $('#tax_rate').val(igst);
             $('#exclusive').val(inclusive_rate.toFixed(2));
             $('#inclusive').val(selling_price);
             $('#selling_price_type').val(selling_price_type);
             $('#quantity').val(1);

             
             $('.item_display').dialog('close');
             $('#exclusive').focus();

            //  if($('#quantity').val() != '')
            //  {
              
            //   var rate_exclusive = $('#exclusive').val();
            //   var rate_inclusive = $('#inclusive').val();
            //   var quantity = $('#quantity').val();
            //   var tax_rate = $('.tax_rate').val();
            //   var total = parseInt(quantity)*parseFloat(rate_exclusive);
            //   $('#amount').val(total.toFixed(2));
            //   if(tax_rate == '')
            //   {
            //     $('#net_price').val(total.toFixed(2));
            //   }
              
            //   var rate = parseFloat(tax_rate)/100;
            //   var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
            //   var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
            //   $('#inclusive').val(gst_rate_inclusive.toFixed(2));
            //   var net_val = parseFloat(total)*parseFloat(rate);
      
            //   $('.gst').val(net_val.toFixed(2));

            //   var total_net_val = parseFloat(total)+parseFloat(net_val);
            //   $('#net_price').val(total_net_val.toFixed(2));
            //  }
            // else
            // {

            // }
        }

    });

      $.ajax({
           type: "POST",
            url: "{{ url('sale_order/last_purchase_rate/') }}",
            data: { id: item_code },
           success: function(data) {
             $('#last_purchase_rate').val(data);
             
           }
        });
}
else
{
  var row_id=$('#last').val();

      $.ajax({  
        
        type: "GET",
        url: "{{ url('pos/getdata/{id}') }}",
        data: { id: item_code },             
                        
        success: function(data){ 
          //console.log(data);
              $('.uom_exclusive').children('option').remove();
              $('.uom_inclusive').children('option').remove();
             // $('.uom_inclusive').children('option:not(:first)').remove();
             id = data[0].item_id;
             name =data[0].item_name;
             code =data[0].code;
             mrp =data[0].mrp;
             hsn =data[0].hsn;
             uom_id =data[0].uom_id;
             ptc_code =data[0].ptc;
             uom_name =data[0].uom_name;
             igst =data[1].igst;
             barcode = data[2].barcode;
             selling_price = data.selling_price;
             selling_price_type = data.selling_price_type;

             variable = data['variable'];
             discount_value = data['discount'];

             itemwise_offer = data['itemwise_offer'];
             itemwise_offer_item_id = data['itemwise_offer_item_id'];
             get_item_qty = data['get_item_qty'];
             buy_item_qty = data['buy_item_qty'];

             if(itemwise_offer == '1')
             {
              $('#itemwiseoffer').val(1);
              itemwise_offers(itemwise_offer_item_id,get_item_qty,buy_item_qty);

             }
             else
             {
              $('#itemwiseoffer').val(0);
             }
             

             for(var new_val = 0; new_val < data[1].cnt; new_val++)
             {
              var tax_master_id = data[1].tax_master[new_val];

              var tax_master_input_val = $('#'+tax_master_id).attr('class').split(' ')[1];

              if(tax_master_id == tax_master_input_val)
              {
                var sum = parseFloat($('#'+tax_master_id).val()) + parseFloat(data[1].tax_val[new_val]);

                $('#'+tax_master_id).val(sum);
              }
              else
              {

              }

             }
              
              var first_data='<option value="'+id+'">'+uom_name+'</option>';
              //console.log(first_data);
              $('.uom_exclusive').append(first_data);
              $('.uom_inclusive').append(first_data);
              for(var i=0;i<data[3].length;i++)
             {
              var item_uom_id=data[3][i].id;
              var item_uom_name=data[3][i].name;
              var item_id=data[3][i].item_id;
              if(item_uom_name == uom_name)
              {

              }
              else
              {
                var div_data='<option value="'+item_id+'">'+item_uom_name+'</option>';
                $('.uom_exclusive').append(div_data);
                $('.uom_inclusive').append(div_data);
              }
              
             }

             var rate=parseFloat(igst)/100+1;
             var actual_tax = parseFloat(igst)/100;
             var inclusive_rate = parseFloat(selling_price)/parseFloat(rate);
                       
             $('#item_code').val(code);
             $('#items_codes').val(id);
             $('#item_name').val(name);
             $('#mrp').val(mrp);
             $('#hsn').val(hsn);
             $('#uom').val(uom_id);
             $('#uom_name').val(uom_name);
             $('#tax_rate').val(igst);
             $('#exclusive').val(inclusive_rate.toFixed(2));
             $('#inclusive').val(selling_price);
             $('#selling_price_type').val(selling_price_type);
             $('#quantity').val(1);
             $('#quantity').focus();
             

             
             $('#cat').dialog('close');
             $('#exclusive').focus();
              
              // var rate_exclusive = $('#exclusive').val();
              // var rate_inclusive = $('#inclusive').val();
              // var quantity = $('#quantity').val();
              // var tax_rate = $('.tax_rate').val();
              // var total = parseInt(quantity)*parseFloat(rate_exclusive);
              // $('#amount').val(total.toFixed(2));
              // if(tax_rate == '')
              // {
              //   $('#net_price').val(total.toFixed(2));
              // }
              // var rate = parseFloat(tax_rate)/100;
              // var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
              // var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
              // $('#inclusive').val(gst_rate_inclusive.toFixed(2));
              // var net_val = parseFloat(total)*parseFloat(rate);
      
              // $('.gst').val(net_val.toFixed(2));

              // var total_net_val = parseFloat(total)+parseFloat(net_val);
              // $('#net_price').val(total_net_val.toFixed(2));
             
        }

    });

      $.ajax({
           type: "POST",
            url: "{{ url('sale_order/last_purchase_rate/') }}",
            data: { id: item_code },
           success: function(data) {
             // console.log(data);
             $('#last_purchase_rate').val(data);
             
           }
        });
}


}

function itemwise_offers(id,get_item_qty,buy_item_qty)
{
  
        $.ajax({
           type: "POST",
            url: "{{ url('pos/getdata_offer/') }}",
            data: { id: id, get_item_qty : get_item_qty, buy_item_qty : buy_item_qty },
           success: function(data) {


             id = data[0].item_id;
             name =data[0].item_name;
             code =data[0].code;
             mrp =data[0].mrp;
             hsn =data[0].hsn;
             uom_id =data[0].uom_id;
             ptc_code =data[0].ptc;
             uom_name =data[0].uom_name;
             igst =data[1].igst;
             barcode = data[2].barcode;
             selling_price = data.selling_price;
             selling_price_type = data.selling_price_type;
             get_qty = data['get_qty'];
             buy_qty = data['buy_qty'];

             var rate=parseFloat(igst)/100+1;
             var actual_tax = parseFloat(igst)/100;
             var inclusive_rate = parseFloat(selling_price)/parseFloat(rate);
                       
             $('#item_code_offer').val(code);
             $('#items_codes_offer').val(id);
             $('#item_name_offer').val(name);
             $('#item_name1_offer').val(id);
             $('#mrp_offer').val(mrp);
             $('#hsn_offer').val(hsn);
             $('#uom_offer').val(uom_id);
             $('#uom_name_offer').val(uom_name);
             $('#tax_rate_offer').val(igst);
             $('#exclusive_offer').val(inclusive_rate.toFixed(2));
             $('#inclusive_offer').val(selling_price);
             $('#selling_price_type_offer').val(selling_price_type);
             $('#quantity_offer').val(get_qty);
             $('#buy_quantity_offer').val(buy_qty);



           }
        });

}

function get_details()
{

  var item_code=$('#item_code').val();
  //$('#item_code').val('');
  $('#items_codes').val('');
  $('#item_name').val('');
  $('#mrp').val('');
  $('#hsn').val('');
  $('#uom').val('');
  $('#uom_name').val('');
  $('#tax_rate').val('');
//
$("select").select2();
var row_id=$('#last').val();

      $.ajax({  
        
        type: "GET",
        url: "{{ url('estimation/getdata_item/{id}') }}",
        data: { id: item_code },             
                        
        success: function(data){
         console.log(data);
             if(data[3]==1)
             {
              // $('.uom_exclusive').children('option').remove();
              // $('.uom_inclusive').children('option').remove();
             //$('.uom_inclusive').children('option:not(:first)').remove();
             id = data[0].item_id;

             item_codes(id);
            //  name =data[0].item_name;
            //  code =data[0].code;
            //  mrp =data[0].mrp;
            //  hsn =data[0].hsn;
            //  uom_id =data[0].uom_id;
            //  uom_name =data[0].uom_name;
            //  igst =data[1].igst;

            //  var first_data='<option value="'+code+'">'+uom_name+'</option>';
            //   $('.uom_exclusive').append(first_data);
            //   $('.uom_inclusive').append(first_data);

            //  for(var i=0;i<data[2].length;i++)
            //  {
            //   var item_uom_id=data[2][i].id;
            //   var item_uom_name=data[2][i].name;
            //   var item_uom_code=data[2][i].item_code;
            //   if(item_uom_name == uom_name)
            //   {

            //   }
            //   else
            //   {
            //     var div_data='<option value="'+item_uom_code+'">'+item_uom_name+'</option>';
            //   $('.uom_exclusive').append(div_data);
            //   $('.uom_inclusive').append(div_data);
            //   }

            //  }


            //  $('#item_code').val(item_code);
            //  $('#items_codes').val(id);
            //  $('#item_name').val(name);
            //  $('#mrp').val(mrp);
            //  $('#hsn').val(hsn);
            //  $('#uom').val(uom_id);
            //  $('#uom_name').val(uom_name);
            //  $('#tax_rate').val(igst);
            //  $('#quantity').focus();
            //  $('#cat').hide();


            //  if($('#quantity').val() != '')
            //  {
              
              
            //   var rate_exclusive = $('#exclusive').val();
            //   var rate_inclusive = $('#inclusive').val();
            //   var quantity = $('#quantity').val();
            //   var tax_rate = $('.tax_rate').val();
            //   var total = parseInt(quantity)*parseFloat(rate_exclusive);
            //   $('#amount').val(total.toFixed(2));
            //   if(tax_rate == '')
            //   {
            //     $('#net_price').val(total.toFixed(2));
            //   }
              
            //   var rate = parseFloat(tax_rate)/100;
            //   var gst_rate = parseFloat(rate_exclusive)*parseFloat(rate);
            //   var gst_rate_inclusive = parseFloat(rate_exclusive)+parseFloat(gst_rate);
            //   $('#inclusive').val(gst_rate_inclusive.toFixed(2));
            //   var net_val = parseFloat(total)*parseFloat(rate);
      
            //   $('.gst').val(net_val.toFixed(2));

            //   var total_net_val = parseFloat(total)+parseFloat(net_val);
            //   $('#net_price').val(total_net_val.toFixed(2));
            //  }
            // else
            // {

            // }

             }
                    
             else
             {
              item_with_same_data(item_code);
             }
              
        }

    });
      var item_id=$('#items_codes').val();
      $.ajax({

           type: "POST",
            url: "{{ url('estimation/last_purchase_rate/') }}",
            data: { id: item_id },
           success: function(data) {
             $('#last_purchase_rate').val(data);
             
           }
        });


}

function item_with_same_data(item_code)
{
  $.ajax({

        type: "GET",
        url: "{{ url('sale_order/same_items/{id}') }}",
        data: { id: item_code },

        success:function(data){
          console.log(data);
          $('.item_display').show();
          $('.item_display').dialog({width:1000},{height:250});
          $('.append_item_display').html(data);
        }

  })
}


function find_cat()
{
  
  $('#categories').val("");
  $('#brand').val("");
  $("select").select2();
  $('#browse_item').val("");
  $('#cat').show();
  $('.row_brand').remove(); 
  $('.row_category').remove();
  $('#cat').dialog({width:900},{height:250}).prev(".ui-dialog-titlebar").css("background","#28a745").prev(".ui-dialog.ui-widget-content");
    
}

function browse_item()
{
  var browse_item = $('#browse_item').val();
  $.ajax({  
        
        type: "GET",
        url: "{{ url('pos/browse_item/{id}') }}",
        data: { browse_item: browse_item},             
             
        success: function(data){
          $('.row_brand').remove(); 
        $('.row_category').remove(); 
        $(".append_item").html(data);
        }
      });
}

function categories_check()
{
  var  categories=$('#categories').val();
  var  brand=$('#brand').val();
  if(brand == '')
  {
    brand ='no_val';
  }
  $.ajax({  
        
        type: "GET",
        url: "{{ url('pos/change_items/{id}') }}",
        data: { categories: categories, brand: brand },             
             
        success: function(data){ 
          

          

          
        $('.row_brand').remove(); 
        $('.row_category').remove(); 
        $(".append_item").html(data);
        return false;
          var bar_code = [];
          var item_id =[];
          var item_code =[];
          var item_name =[];
          var item_brand_id =[];
          var item_brand_name =[];
          var item_category_name =[];
          var item_category_id =[];
          var item_ptc =[];
          var barcode_last = data.length-1;
          var item_last = data[barcode_last].length;
          for(var i=0;i<barcode_last;i++)
          {
            
             bar_code.push(data[i][0].barcode);
             item_brand_name.push(data[i][0].brand_name)
            
          }
          for(var j=0;j<item_last;j++)
            {
              item_code.push(data[item_last][j].item_code);
              item_id.push(data[item_last][j].item_id);
              item_name.push(data[item_last][j].item_name);
              if(data[item_last][j].brand_id == 0)
              {
                item_brand_name.push('Not Applicable');
              }
              else
              {
                item_brand_id.push(data[item_last][j].brand_id);
              }
              item_category_name.push(data[item_last][j].category_name);
              item_category_id.push(data[item_last][j].categories_id);
              item_ptc.push(data[item_last][j].ptc);
            }

            for (var k=0; k < barcode_last; k++)
            {

              var table_data='<tr class="row_category"><td><input type="hidden" value="'+item_id[k]+'" class="append_item_id'+k+'"><input type="hidden" value="'+item_code[k]+'" class="append_item_code'+k+'"><font style="font-family: Times new roman;">'+item_code[k]+'</font></td><td><input type="hidden" value="'+item_name[k]+'" class="append_item_name'+k+'"><font style="font-family: Times new roman;">'+item_name[k]+'</font></td><td><input type="hidden" value="'+item_brand_id[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_brand_name[k]+'</font></td><td><input type="hidden" value="'+item_category_id[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_category_name[k]+'</font></td><td><input type="hidden" value="'+item_ptc[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_ptc[k]+'</font></td><td><input type="hidden" value="'+bar_code[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+bar_code[k]+'</font></td><td><center><input type="radio" name="select" onclick="add_data('+k+')"></center></td></tr>';
                
                $(table_data).appendTo('.append_item');

            }
        }


    });
}

function brand_check()
{
  
  var brand = $('.brand').val();
  

  $.ajax({

        type: "POST",
        url: "{{ url('pos/brand_filter/') }}",
        data: {brand: brand },             
             
        success: function(data)
        {
          $('.row_category').remove();
          $('.row_brand').remove();
          $(".append_item").html(data);
          return false;

          var bar_code = [];
          var item_id =[];
          var item_code =[];
          var item_name =[];
          var item_brand_id =[];
          var item_brand_name =[];
          var item_category_name =[];
          var item_category_id =[];
          var item_ptc =[];
          var item_mrp =[];
          var barcode_last = data.length-1;
          var item_last = data[barcode_last].length;
          for(var i=0;i<barcode_last;i++)
          {
            //console.log(data[i][0].barcode);
             bar_code.push(data[i][0].barcode);
            
          }
          for(var j=0;j<item_last;j++)
            {
              item_code.push(data[item_last][j].item_code);
              item_id.push(data[item_last][j].item_id);
              item_name.push(data[item_last][j].item_name);
              item_brand_id.push(data[item_last][j].brand_id);
              item_brand_name.push(data[item_last][j].brand_name);
              item_category_name.push(data[item_last][j].category_name);
              item_category_id.push(data[item_last][j].categories_id);
              item_ptc.push(data[item_last][j].ptc);
              item_mrp.push(data[item_last][j].mrp);
            }

            for (var k=0; k < barcode_last; k++)
            {

              var table_data='<tr class="row_brand"><td><center><input type="radio" name="select" onclick="add_data('+k+')"></center></td><td><input type="hidden" value="'+item_id[k]+'" class="append_item_id'+k+'"><input type="hidden" value="'+item_code[k]+'" class="append_item_code'+k+'"><font style="font-family: Times new roman;">'+item_code[k]+'</font></td><td><input type="hidden" value="'+item_name[k]+'" class="append_item_name'+k+'"><font style="font-family: Times new roman;">'+item_name[k]+'</font></td><td><input type="hidden" value="'+item_mrp[k]+'" class="append_item_name'+k+'"><font style="font-family: Times new roman;">'+item_mrp[k]+'</font></td><td><input type="hidden" value="'+item_brand_id[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_brand_name[k]+'</font></td><td><input type="hidden" value="'+item_category_id[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_category_name[k]+'</font></td><td><input type="hidden" value="'+item_ptc[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+item_ptc[k]+'</font></td><td><input type="hidden" value="'+bar_code[k]+'" class="append_item_brand_name'+k+'"><font style="font-family: Times new roman;">'+bar_code[k]+'</font></td></tr>';
                
                $(table_data).appendTo('.append_item');

            }
        }

  });
}

function add_data(val)
{
  // $('.item_display').dialog('close');
  item_codes($('.append_item_id'+val).val(),$('.append_value'+val).val());
}
function add_append_data(val)
{
  item_codes($('.item_id'+val).val(),$('.append_value'+val).val());
}

function code_check()
{
  
  item_codes();
  
}

function customer_details()
{

  var customer_id=$('.customer_id').val();

  $.ajax({
           type: "POST",
            url: "{{ url('sale_order/address_details/') }}",
            data: { customer_id : customer_id },
           success: function(data) {
            var result = JSON.parse(data);
            $('#address_line_1').val(result.address);
           $('.address').text(result.address);
           $('.estimation_no').children('option:not(:first)').remove()
           .end().append(result.estimation_options);
           }
        });
}

function estimation_details()
{

  var estimation_no=$('.estimation_no').val();
  

  $.ajax({
           type: "POST",
            url: "{{ url('sales_order/estimation_details/') }}",
            data: { estimation_no : estimation_no },
           success: function(data) {
            $('.tables').remove();
            $('.expense').remove();
            var result=JSON.parse(data);
            if(result.status>0){
$('.append_proof_details').append(result.data);
var expense_length=$(".expense_type").length;
if(expense_length >1)
{
$('.append_expense').append(result.expense_typess);
$('#expense_count').val(result.expense_cnt);
}
else if(result.expense_cnt == 0)
{
  $('.append_expense').html(result.expense_typess);
  $('#expense_count').val(result.expense_cnt+1);
}
else
{
  $('.append_expense').html(result.expense_typess);
  $('#expense_count').val(result.expense_cnt);
}
$('.taxes').html(result.tax_append);

$('#total_discount').val(result.item_discount_sum);
$('#overall_discount').val(result.overall_discount);
$('#overall_discount').attr('readonly','readonly');
$('#round_off').val(result.round_off);
$('.total_net_value').text(result.total_net_value);
$("#grand_total").val(total_net_price.toFixed(2));
$("#grand_total").val(total_net_price.toFixed(2));
 $('#total_price').val(result.total_net_value);
 $('.estimation_date').val(result.date);
 $('#counts').val(result.status);


var total_net_price=calculate_total_net_price();
var total_amount=calculate_total_amount();
var total_gst=calculate_total_gst();
$("#total_gst").val(total_gst.toFixed(2));
$("#igst").val(total_gst.toFixed(2));
var half_gst = parseFloat(total_gst)/2;
$("#cgst").val(half_gst.toFixed(2));
$("#sgst").val(half_gst.toFixed(2));
var q=calculate_total_discount();
$('#total_discount').val(q.toFixed(2));
$('#disc_total').val(q.toFixed(2));
total_expense_cal();
//overall_discounts();
roundoff_cal();


var to_html_total_net = total_net_price.toFixed(2);
var to_html_total_amount = total_amount.toFixed(2);
$(".total_net_price").html(parseFloat(to_html_total_net));
$(".total_amount").html(parseFloat(to_html_total_amount));




            }
           }
        });
}

function uom_details_inclusive()
{
var uom_inclusive=$('.uom_inclusive').val();

item_codes(uom_inclusive);
}

function uom_details_exclusive()
{

var uom_exclusive=$('.uom_exclusive').val();
item_codes(uom_exclusive);
}

 function overall_discounts()
 {

    $(".overall_discount").blur(function() {
    if ($(this).val() == "" || $(this).val() == 0) 
    {
        $(this).val('0');
        $('#overall_discount').val(0);
    }
});
  

      var total = $('#total_price').val();
    if(total == 0)
    {
      alert('You Cannot Add Overall Discount Without Adding Item Details!!');
      $('.overall_discount').val(0);
    }
    else
    {

  $('.input_discounts').each(function(){
    var count = $(this).attr('class').split(' ')[1];
      var itemwiseoffer = $('#itemwiseoffer'+count).val();
      if(itemwiseoffer == 0)
      {

        var overall_discount = $('#overall_discount').val();
        if(overall_discount == '')
        {
          overall_discount = 0;
        }
        console.log(overall_discount);
        var amount = $('#amnt'+count).val();
        var gst_rs = $('#tax'+count).val();
        var total_amount =calculate_total_amount();

        var disc_distribution = parseFloat(overall_discount)/parseFloat(total_amount)*parseFloat(amount);
        var total_discount = parseFloat($(this).val())+parseFloat(disc_distribution);
        var net_value = parseFloat(amount)+parseFloat(gst_rs)-parseFloat(total_discount);
        //$('#input_discount'+count).val(total_discount);
        $('.font_overall_disc'+count).text(disc_distribution.toFixed(2));
        $('#overall_disc'+count).val(disc_distribution.toFixed(2));
        // $('#font_discount'+count).text(total_discount.toFixed(2));
        // $('.discount_val'+count).val(total_discount.toFixed(2));
        $('#net_price'+count).val(net_value.toFixed(2));
        $('.font_net_price'+count).text(net_value.toFixed(2));

      }
      else
      {

      }
      
  });

}
  var total_net_price = calculate_total_net_price();
  $("#total_price").val(total_net_price.toFixed(2));
  $(".total_net_value").text(total_net_price.toFixed(2));
  var to_html_total_net = total_net_price.toFixed(2);
  $(".total_net_price").html(parseFloat(to_html_total_net));
  roundoff_cal();
  // individual_expense();
  // total_expense_cal();
  var q=calculate_total_discount();
  $('#total_discount').val(q.toFixed(2));
  $('#disc_total').val(q.toFixed(2));
}


</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
<script src="jquery.ui.position.js"></script>


<style type="text/css">
  .ui-dialog.ui-widget-content { background: #a3d072; }
</style>

        

    </div>
    <!-- card body end@ -->
  </div>
</div>
@endsection

