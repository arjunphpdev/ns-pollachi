<style>
.bg-video-wrap {
  position: absolute;
  overflow: hidden;
  width: 100%;
  height: 100vh;
  background: url(https://designsupply-web.com/samplecontent/vender/codepen/20181014.png) no-repeat center center/cover;
}
video {
  min-width: 100%;
  min-height: 100vh;
  z-index: 1;
}
.overlay {
  width: 100%;
  height: 100vh;
  position: relative;
  top: 0;
  left: 0;
  background-image: linear-gradient(45deg, rgba(0,0,0,.3) 50%, rgba(0,0,0,.7) 50%);
  background-size: 3px 3px;
  z-index: 2;
}
</style>



<div class="bg-video-wrap">
    <video src="assets/image/background.mov" loop muted autoplay>
    </video>
    <div class="overlay">
    </div>
  </div>







<?php $__env->startSection('content'); ?>

<div class="container" id="login-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: rgb(255 255 255 / 90%)">
                <div class="card-header"><?php echo e(__('Login')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>" >
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('User Name')); ?></label> -->

                            <div class="col-md-8 mx-auto">
                                <input  type="text" class="form-control <?php if ($errors->has('user_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('user_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="user_name" placeholder="Username" value="<?php echo e(old('user_name')); ?>" required autocomplete="off">

                                <?php if ($errors->has('user_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('user_name'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                           <!-- <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label> -->

                            <div class="col-md-8 mx-auto">
                                <input id="password" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" placeholder="Password" required autocomplete="off" >

                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 mx-auto text-center">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Login')); ?>

                                </button>
								<br/>
                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ns_pollachi\resources\views/auth/login.blade.php ENDPATH**/ ?>