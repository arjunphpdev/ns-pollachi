@extends('admin.layout.app')
@section('content')
<div class="col-12 body-sec">
  <div class="card">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>List Price Updation</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="{{ route('price_updation.create') }}">Price Updation</a></button></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- card header end@ -->
    <div class="card-body">
      <table id="master" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Item Code </th>
            <th>Item Name </th>
            <th>Brand Name </th>
            <th>Category</th>
            <th>HSN</th>
            <th>MRP</th>
            <th>Selling Price</th>
            <th>Mark Up(%)</th>
            <th>Mark Up(Rs)</th>
            <th>Mark Down(%)</th>
            <th>Mark Down(Rs)</th>
            <th>Unit Price</th>
            <th>Tax Rate</th>
           <th>Action </th>
          </tr>
        </thead>
        <tbody>
          @foreach($updations as $key => $value)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ @$value->item->code }}</td>
              <td>{{ @$value->item->name }}</td>
              @if($value->brand_id == 0)
              <td>Not Applicable</td>
              @else
              <td>{{ @$value->brand->name }}</td>
              @endif
              <td>{{ @$value->category->name }}</td>
              <td>{{ @$value->item->hsn }}</td>
              <td>{{ @$value->item->mrp }}</td>
              <td>{{ $value->selling_price }}</td>
              <td>{{ $value->mark_up_percent }}</td>
              <td>{{ $value->mark_up_rs }}</td>
              <td>{{ $value->mark_down_percent }}</td>
              <td>{{ $value->mark_down_rs }}</td>
              <td>{{ $value->unit_price }}</td>
              <td>{{ $value->tax_rate }}</td>
              <td> 
                <a href="{{ route('price_updation.show',$value->id) }}" class="px-2 py-1 bg-info text-white rounded"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('price_updation.edit',$value->id) }}" class="px-2 py-1 bg-success text-white rounded"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="" onclick="return confirm('Are you sure ?')" class="px-2 py-1 bg-danger text-white rounded"><i class="fa fa-trash" aria-hidden="true"></i></a>

                
              </td>
            </tr>
         @endforeach
        </tbody>
      </table>

    </div>
    <!-- card body end@ -->
  </div>
</div>
@endsection