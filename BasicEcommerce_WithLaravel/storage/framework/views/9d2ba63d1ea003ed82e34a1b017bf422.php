<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Home']); ?>
    <!-- Home Slider -->
    <section class="hero-slider">
        <!-- Carousel wrapper -->
        <div class="hero-slides">
            <!-- Item 1 -->
            <div class="hero-slide">
                <div class="container">
                    <div class="slide-content">
                        <h1 class="hero-slider-title">
                            Buy <strong>The Best Cars</strong> <br />
                            in your region
                        </h1>
                        <div class="hero-slider-content">
                            <p>
                                Use powerful search tool to find your desired cars based on
                                multiple search criteria: Maker, Model, Year, Price Range, Car
                                Type, etc...
                            </p>

                            <button class="btn btn-hero-slider">Find the car</button>
                        </div>
                    </div>
                    <div class="slide-image">
                        <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hero-slide">
                <div class="flex container">
                    <div class="slide-content">
                        <h2 class="hero-slider-title">
                            Do you want to <br />
                            <strong>sell your car?</strong>
                        </h2>
                        <div class="hero-slider-content">
                            <p>
                                Submit your car in our user friendly interface, describe it,
                                upload photos and the perfect buyer will find it...
                            </p>

                            <button class="btn btn-hero-slider">Add Your Car</button>
                        </div>
                    </div>
                    <div class="slide-image">
                        <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>
            <button type="button" class="hero-slide-prev">
                <svg style="width: 18px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </button>
            <button type="button" class="hero-slide-next">
                <svg style="width: 18px" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </section>
    <!--/ Home Slider -->
    <main>

        <?php if (isset($component)) { $__componentOriginal3c8b11d14bd2f3c6983234fd6ddee71a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3c8b11d14bd2f3c6983234fd6ddee71a = $attributes; } ?>
<?php $component = App\View\Components\SearchForm::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SearchForm::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3c8b11d14bd2f3c6983234fd6ddee71a)): ?>
<?php $attributes = $__attributesOriginal3c8b11d14bd2f3c6983234fd6ddee71a; ?>
<?php unset($__attributesOriginal3c8b11d14bd2f3c6983234fd6ddee71a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3c8b11d14bd2f3c6983234fd6ddee71a)): ?>
<?php $component = $__componentOriginal3c8b11d14bd2f3c6983234fd6ddee71a; ?>
<?php unset($__componentOriginal3c8b11d14bd2f3c6983234fd6ddee71a); ?>
<?php endif; ?>

        <!-- New Cars -->
        <section>
            <div class="container">
                <h2>Latest Added Cars</h2>
                <div class="car-items-listing">
                    <?php for($i = 0; $i < 15; $i++): ?>
                        <?php if (isset($component)) { $__componentOriginal5d2b0c22fc4d0939e9116ed8d18932d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d2b0c22fc4d0939e9116ed8d18932d8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.car-item','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('car-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d2b0c22fc4d0939e9116ed8d18932d8)): ?>
<?php $attributes = $__attributesOriginal5d2b0c22fc4d0939e9116ed8d18932d8; ?>
<?php unset($__attributesOriginal5d2b0c22fc4d0939e9116ed8d18932d8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d2b0c22fc4d0939e9116ed8d18932d8)): ?>
<?php $component = $__componentOriginal5d2b0c22fc4d0939e9116ed8d18932d8; ?>
<?php unset($__componentOriginal5d2b0c22fc4d0939e9116ed8d18932d8); ?>
<?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        <!--/ New Cars -->
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Internship\BasicEcommerce_WithLaravel\resources\views/welcome.blade.php ENDPATH**/ ?>