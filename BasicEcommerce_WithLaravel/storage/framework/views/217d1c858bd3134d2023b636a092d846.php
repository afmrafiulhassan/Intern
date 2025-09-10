<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Login','bodyClass' => 'page-login']); ?>

    <h1 class="auth-page-title">Login</h1>

    <form action="" method="post">
              <div class="form-group">
                <input type="email" placeholder="Your Email" />
              </div>
              <div class="form-group">
                <input type="password" placeholder="Your Password" />
              </div>
              <div class="text-right mb-medium">
                <a href="/password-reset.html" class="auth-page-password-reset"
                  >Reset Password</a
                >
              </div>

              <button class="btn btn-primary btn-login w-full">Login</button>
    </form>

     <?php $__env->slot('footerLink', null, []); ?> 
        Don't have an account? -
        <a href="/signup.html"> Click here to create one</a>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Internship\BasicEcommerce_WithLaravel\resources\views/auth/login.blade.php ENDPATH**/ ?>