<x-app-layout title="Home">
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
                                Use our powerful search tool to find your desired car based on
                                multiple search criteria: Maker, Model, Year, Price Range, Car
                                Type, and more.
                            </p>

                            <a href="{{ route('car.search') }}" class="btn btn-hero-slider">Find The Car</a>
                        </div>
                    </div>
                    <div class="slide-image">
                        <img src="/img/car-png-39071.png" alt="Car" class="img-responsive" />
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
                                Submit your car easily with our user-friendly interface, add details,
                                upload photos, and the perfect buyer will find it.
                            </p>

                            @auth
                                <a href="{{ route('car.create') }}" class="btn btn-hero-slider">Add Your Car</a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-hero-slider">Add Your Car</a>
                            @endguest
                        </div>
                    </div>
                    <div class="slide-image">
                        <img src="/img/car-png-39071.png" alt="Car" class="img-responsive" />
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
        {{-- Personalized greeting section --}}
        <section class="welcome-section py-8">
            <div class="container text-center">
                @auth
                    <h1 class="text-3xl font-bold mb-3">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-muted mb-6">
                        Manage your cars, add a new listing, or view your favourite cars below.
                    </p>
                    <div class="flex justify-center gap-3 flex-wrap">
                        <a href="{{ route('car.index') }}" class="btn btn-primary">My Cars</a>
                        <a href="{{ route('car.create') }}" class="btn btn-secondary">Add New Car</a>
                        <a href="{{ route('car.watchlist') }}" class="btn btn-outline">My Favourite Cars</a>
                    </div>
                    <br>
                @endauth

                @guest
                    <h1 class="text-3xl font-bold mb-3">Welcome to Largest CarHub!</h1>
                    <p class="text-muted mb-6">
                        Browse through thousands of cars or sign up to list your own today.
                    </p>
                    <br>
                @endguest
            </div>
        </section>

        {{-- Search Form --}}
        <x-search-form />

        <!-- New Cars -->
        <section>
            <div class="container">
                <h2>Latest Added Cars</h2>
                <div class="car-items-listing">
                    @forelse ($cars as $car)
                        <x-car-item :car="$car" :isInWatchlist="in_array($car->id, $favouriteIds)" />
                    @empty
                        <div class="text-center py-10 w-full">
                            <p class="text-muted">No cars have been added yet. Check back soon!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <!--/ New Cars -->
    </main>
</x-app-layout>