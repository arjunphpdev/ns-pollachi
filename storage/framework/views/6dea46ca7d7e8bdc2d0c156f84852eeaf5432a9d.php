<?php $__env->startSection('content'); ?>
<div class="col-12 body-sec">
  <div class="card container px-0">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>View UOM</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="<?php echo e(url('master/uom')); ?>">Back</a></button></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- card header end@ -->
    <div class="card-body">
      <div class="form-row">
        <div class="col-md-7">
          <div class="form-group row">
            <label for="validationCustom01" class="col-sm-4 col-form-label">UOM :</label>
            <label for="validationCustom01" class="col-sm-4 col-form-label"> <?php echo e($uom->name); ?></label>
          </div>
        </div>

        <div class="col-md-7">
            <div class="form-group row">
              <label for="validationCustom01" class="col-sm-4 col-form-label">Description  :</label>
              <label for="validationCustom01" class="col-sm-4 col-form-label"> <?php echo e($uom->description); ?></label>
            </div>
          </div>

          <div class="col-md-7">
              <div class="form-group row">
                <label for="validationCustom01" class="col-sm-4 col-form-label">Remark :</label>
                <label for="validationCustom01" class="col-sm-4 col-form-label"> <?php echo e($uom->remark); ?></label>
              </div>
            </div>
        
        
      </div>
    </div>
    <!-- card body end@ -->
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ns_pollachi\resources\views/admin/master/uom/show.blade.php ENDPATH**/ ?>