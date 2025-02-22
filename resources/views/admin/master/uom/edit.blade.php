@extends('admin.layout.app')
@section('content')
<?php
use App\Mandatoryfields;
?>
<main class="page-content">

<div class="col-12 body-sec">
  <div class="card container px-0">
    <!-- card header start@ -->
    <div class="card-header px-2">
      <div class="row">
        <div class="col-4">
          <h3>Edit UOM </h3>
        </div>
        <div class="col-8 mr-auto">
          <ul class="h-right-btn mb-0 pl-0">
            <li><button type="button" class="btn btn-success"><a href="{{url('master/uom')}}">Back</a></button></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- card header end@ -->
    <div class="card-body">
    
      <form  method="post" class="form-horizontal needs-validation" novalidate action="{{url('master/uom/update/'.$uom->id)}}" enctype="multipart/form-data">
      {{csrf_field()}}

        <div class="form-row">
            <div class="col-md-7">
                <div class="form-group row">
                  <label for="validationCustom01" class="col-sm-4 col-form-label">Name<?php echo Mandatoryfields::mandatory('uom_name');?></label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control name only_allow_alp_num_dot_com_amp" placeholder="Name" name="name" value="{{old('name',$uom->name)}}" <?php echo Mandatoryfields::validation('uom_name');?> autofocus>
                    <span class="mandatory"> {{ $errors->first('name')  }} </span>
                    <div class="invalid-feedback">
                      Enter valid Name
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col-md-7">
                  <div class="form-group row">
                    <label for="validationCustom01" class="col-sm-4 col-form-label"> Description <?php echo Mandatoryfields::mandatory('uom_description');?></label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control description only_allow_alp_num_dot_com_amp" placeholder="Description" name="description" value="{{old('description',$uom->description)}}" <?php echo Mandatoryfields::validation('uom_description');?>>
                      <span class="mandatory"> {{ $errors->first('description')  }} </span>
                      <div class="invalid-feedback">
                        Enter valid Description
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="col-md-7">
                    <div class="form-group row">
                      <label for="validationCustom01" class="col-sm-4 col-form-label"> Remark <?php echo Mandatoryfields::mandatory('uom_remark');?></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control remark only_allow_alp_num_dot_com_amp" placeholder="Remark" name="remark" value="{{old('remark',$uom->remark)}}" <?php echo Mandatoryfields::validation('uom_remark');?>>
                        <span class="mandatory"> {{ $errors->first('remark')  }} </span>
                        <div class="invalid-feedback">
                          Enter valid Remark
                        </div>
                      </div>
                    </div>
                  </div>
          
         
        </div>
        <div class="col-md-7 text-right">
          <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
    <!-- <script src="{{asset('assets/js/master/capitalize.js')}}"></script> -->
    <!-- card body end@ -->
  </div>
</div>
@endsection