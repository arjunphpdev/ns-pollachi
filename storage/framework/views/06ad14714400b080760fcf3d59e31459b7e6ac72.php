<?php $__env->startSection('content'); ?>
<main class="page-content">

<div class="col-12 body-sec">
  <div class="card container px-0">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>Add City</h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="<?php echo e(url('master/city')); ?>">Back</a></button></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- card header end@ -->
    <div class="card-body">

      <form method="post" class="form-horizontal needs-validation" novalidate action="<?php echo e(url('master/city/store')); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>


        <div class="form-row">
          
          <div class="col-md-8">
            <div class="form-group row">
              <label for="validationCustom01" class="col-sm-4 col-form-label">State <span class="mandatory">*</span></label>
              <div class="col-sm-6">
                <select class="js-example-basic-multiple col-12 form-control custom-select state_id" name="state_id" required>
                  <option value="">Choose State</option>
                  <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(old('state_id') == $value->id): ?>
                  <option value="<?php echo e($value->id); ?>" selected><?php echo e($value->name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="mandatory"> <?php echo e($errors->first('state_id')); ?> </span>
                <div class="invalid-feedback">
                  Enter valid State 
                </div>
              </div>
              <a href="<?php echo e(url('master/state/create')); ?>" target="_blank">
                <button type="button"  class="px-3 btn btn-success ml-2" title="Add State"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
               <button type="button"  class="px-3 btn btn-success mx-2 refresh_state_id" title="Refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group row">
              <label for="validationCustom01" class="col-sm-4 col-form-label"> District <span class="mandatory">*</span></label>
              <div class="col-sm-6">
                <select class="js-example-basic-multiple form-control col-12 custom-select district_id" placeholder="Choose District" name="district_id" required>
                  <option value="">Choose District</option>
                  <?php $__currentLoopData = $district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(old('district_id') == $value->id): ?>
                  <option value="<?php echo e($value->id); ?>" selected><?php echo e($value->name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="mandatory"> <?php echo e($errors->first('district_id')); ?> </span>
                <div class="invalid-feedback">
                  Enter valid District
                </div>
              </div>
              <a href="<?php echo e(url('master/district/create')); ?>" target="_blank">
                <button type="button"  class="px-3 btn btn-success ml-2 " title="Add District"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
               <button type="button"  class="px-3 btn btn-success mx-2 refresh_district_id" title="Refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
          
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group row">
              <label for="validationCustom01" class="col-sm-4 col-form-label">City Name <span class="mandatory">*</span></label>
              <div class="col-sm-8">
                <input type="text" class="form-control name only_allow_alp_num_dot_com_amp" placeholder="City Name" name="name" value="<?php echo e(old('name')); ?>" required>
                <span class="mandatory"> <?php echo e($errors->first('name')); ?> </span>
                <div class="invalid-feedback">
                  Enter valid City Name
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group row">
              <label for="validationCustom01" class="col-sm-4 col-form-label">Remark </label>
              <div class="col-sm-8">
                <input type="text" class="form-control remark" name="remark" value="<?php echo e(old('remark')); ?>" placeholder="Remark">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7 text-right">
          <button class="btn btn-success" name="add" type="submit">Submit</button>
        </div>
      </form>
    </div>
    <script src="<?php echo e(asset('assets/js/master/capitalize.js')); ?>"></script>
    <!-- card body end@ -->
  </div>
</div>


<script type="text/javascript">

  $(document).on('input','.name',function(){

  $(this).val($(this).val().replace(/[^a-zA-Z ]/gi, ''));

  });


$(document).on("click",".refresh_state_id",function(){
   var state_dets=refresh_state_master_details();
  $(".state_id").html(state_dets);
  $(".district_id").html("<option value=''>Choose District</option>");
});

$(document).on("click",".refresh_district_id",function(){
  var state_id=$("state_id").val();
  if(state_id !="")
  {
    var district_dets=refresh_district_master_details(state_id);
    $(".district_id").html(district_dets);
  }
 });


function get_state_based_district(state_id,district_id)
{
  $.ajax({
              type: "post",
              url: "<?php echo e(url('common/get-state-based-district')); ?>",
              data: {state_id: state_id, district_id:district_id},
              success: function (res)
              {
                result = JSON.parse(res);
                $(".district_id").html(result.option);
              }
          });

}

$(document).ready(function(){
  var state_id="<?php echo e(old('state_id')); ?>";
  var district_id="<?php echo e(old('district_id')); ?>"; 
 if(state_id != ""){
  get_state_based_district(state_id,district_id);
 }

});
$(document).on("change",".state_id",function(){
  var state_id=$(this).val();
  get_state_based_district(state_id,"");
});

$(document).on("click",".refresh_district",function(){
  var state_id=$(".state_id").val();
  if(state_id !="")
  {
    var test=refresh_district_master_details(state_id);
  }
});



 

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ns_pollachi\resources\views/admin/master/city/add.blade.php ENDPATH**/ ?>