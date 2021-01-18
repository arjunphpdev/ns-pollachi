<?php $__env->startSection('content'); ?>
<main class="page-content">

<div class="col-12 body-sec">
  <div class="card">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>List Payment Request</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="<?php echo e(route('payment_request.create')); ?>">Payment Request</a></button></li>
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
            <th>Party Name </th>
            <th>Request No </th>
            <th>Request Date</th>
            <th>Bill No</th>
            <th>Bill Date</th>
            <th>Request Amount</th>
           <th>Action </th>
          </tr>
        </thead>
       <tbody>
		 <?php $__currentLoopData = $payment_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?></td>
			  <?php if(isset($value->supplier_det->name) && !empty($value->supplier_det->name)): ?>
              <td><?php echo e($value->supplier_det->name); ?></td>
              <?php else: ?>
              <td></td>
              <?php endif; ?>
              <td><?php echo e($value->request_no); ?></td>
              <td><?php echo e($value->request_date); ?></td>
              <td><?php echo e($value->purchase_id); ?></td>
              <td><?php echo e($value->purchase_id); ?></td>
              <td><?php echo e($value->request_amount); ?></td>
              
              <td class="icon">
	<span class="tdshow"> 
                <a href="" class="px-1 py-0 text-white rounded" title="View">><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="" class="px-1 py-0  text-white rounded" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="" onclick="return confirm('Are you sure ?')" class="px-1 py-0  text-white rounded" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a> 
</span>
                
              </td>
            </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>

    </div>
    <!-- card body end@ -->
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ns_pollachi\resources\views/admin/payment_request/view.blade.php ENDPATH**/ ?>