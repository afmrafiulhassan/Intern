<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => '', 'bodyClass' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => '', 'bodyClass' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if (isset($component)) { $__componentOriginal7442783a15dff2b0d32f2947a462c2e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7442783a15dff2b0d32f2947a462c2e2 = $attributes; } ?>
<?php $component = App\View\Components\BaseLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('base-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BaseLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'bodyClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bodyClass)]); ?>

  <main>
      <div class="container-small page-login">
        <div class="flex" style="gap: 5rem">
          <div class="auth-page-form">
            <div class="text-center">
              <a href="/">
                <img src="/img/logoipsum-265.svg" alt="" />
              </a>
            </div>
            <?php echo e($slot); ?>

            
              <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                <?php if (isset($component)) { $__componentOriginal5c54a6d4d676c1c26a467c6a9c275c37 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c54a6d4d676c1c26a467c6a9c275c37 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.google-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('google-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c54a6d4d676c1c26a467c6a9c275c37)): ?>
<?php $attributes = $__attributesOriginal5c54a6d4d676c1c26a467c6a9c275c37; ?>
<?php unset($__attributesOriginal5c54a6d4d676c1c26a467c6a9c275c37); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c54a6d4d676c1c26a467c6a9c275c37)): ?>
<?php $component = $__componentOriginal5c54a6d4d676c1c26a467c6a9c275c37; ?>
<?php unset($__componentOriginal5c54a6d4d676c1c26a467c6a9c275c37); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal2949c33fde11a5a5c0b074140772c9d5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2949c33fde11a5a5c0b074140772c9d5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fb-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('fb-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2949c33fde11a5a5c0b074140772c9d5)): ?>
<?php $attributes = $__attributesOriginal2949c33fde11a5a5c0b074140772c9d5; ?>
<?php unset($__attributesOriginal2949c33fde11a5a5c0b074140772c9d5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2949c33fde11a5a5c0b074140772c9d5)): ?>
<?php $component = $__componentOriginal2949c33fde11a5a5c0b074140772c9d5; ?>
<?php unset($__componentOriginal2949c33fde11a5a5c0b074140772c9d5); ?>
<?php endif; ?>
              </div>
              <div class="login-text-dont-have-account">
                <?php echo e($footerLink); ?>

              </div>
          </div>
          <div class="auth-page-image">
            <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
          </div>
        </div>
      </div>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7442783a15dff2b0d32f2947a462c2e2)): ?>
<?php $attributes = $__attributesOriginal7442783a15dff2b0d32f2947a462c2e2; ?>
<?php unset($__attributesOriginal7442783a15dff2b0d32f2947a462c2e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7442783a15dff2b0d32f2947a462c2e2)): ?>
<?php $component = $__componentOriginal7442783a15dff2b0d32f2947a462c2e2; ?>
<?php unset($__componentOriginal7442783a15dff2b0d32f2947a462c2e2); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Internship\BasicEcommerce_WithLaravel\resources\views/layouts/guest.blade.php ENDPATH**/ ?>