@extends('admin.layout.app')
@section('content')
<main class="page-content">

<div class="col-12 body-sec">
  <div class="card">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>List Sales Estimation</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            @if($check_id != 1)
            <li><button type="button" class="btn btn-success"><a href="{{ route('sales_estimation.create') }}">Sales Estimation</a></button></li>
            @else
            @endif
          </ul>
        </div>
      </div>
    </div>
    <!-- card header end@ -->
    <div class="card-body">
      <table id="master" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Voucher No </th>
            <th>Voucher Date </th>
            <th>Customer Name</th>
            <th>Sales Man Name</th>
            <th>Agent Name</th>
            <th>overall Discount</th>
            <!-- <th>Round Off</th> -->
            <th>Total Expense</th>
            <th>Taxable Value</th>
            <th>Tax Value</th>
            <th>Net Value</th>
           <th>Action </th>
          </tr>
        </thead>
        <tbody>
          @foreach($sale_estimation as $key => $value)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $value->sale_estimation_no }}</td>
              <td>{{ $value->sale_estimation_date }}</td>
              @if(isset($value->customer->name) && !empty($value->customer->name))
              <td>{{ $value->customer->name }}</td>
              @else
              <td></td>
              @endif
              @if(isset($value->salesman->name) && !empty($value->salesman->name))
              <td>{{ $value->salesman->name }}</td>
              @else
              <td></td>
              @endif
              @if(isset($value->agent->name) && !empty($value->agent->name))
              <td>{{ $value->agent->name }}</td>
              @else
              <td></td>
              @endif
              <td>{{ $total_discount[$key] }}</td>
              <!-- <td>{{ $value->round_off }}</td> -->
              <td>{{ $expense_total[$key] }}</td>
              <td>{{ $taxable_value[$key] }}</td>
              <td>{{ $tax_value[$key] }}</td>
              <td>{{ $total[$key] }}</td>
              <td> 
                @if($value->cancel_status == 0)
                <a href="{{ route('sales_estimation.show',$value->sale_estimation_no) }}" class="px-1 py-0 text-white rounded" title="View">><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('sales_estimation.edit',$value->sale_estimation_no) }}" class="px-1 py-0  text-white rounded" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="{{url('sales_estimation/delete/'.$value->sale_estimation_no )}}" onclick="return confirm('Are you sure ?')" class="px-1 py-0  text-white rounded" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                <a href="{{ url('sales_estimation/cancel/'.$value->sale_estimation_no) }}" class="px-2 py-1 bg-warning text-white rounded">Cancel</a>

                <br><br>
                <a href="{{url('sales_estimation/item_details/'.$value->sale_estimation_no )}}" class="px-1 py-0 bg-info text-white rounded"><i class="fa fa-eye" aria-hidden="true"></i>Item Details</a>
                <a href="{{url('sales_estimation/expense_details/'.$value->sale_estimation_no )}}" class="px-1 py-0 bg-info text-white rounded"><i class="fa fa-eye" aria-hidden="true"></i>Expense Details</a>
                @else
                <a href="{{ url('sales_estimation/retrieve/'.$value->sale_estimation_no) }}" class="px-2 py-1 bg-primary text-white rounded">Retrieve</a>
                @endif
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