<x-app-layout>
    <main>
        <!-- Favourite Cars -->
        <section>
            <div class="container">
                <div class="flex justify-between items-center mb-4">
                    <h2>My Favourite Cars</h2>
                    @if ($cars->total() > 0)
                        <div class="pagination-summary text-sm text-muted">
                            <p>
                                Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                                of {{ $cars->total() }} results
                            </p>
                        </div>
                    @endif
                </div>

                {{-- If user has favourite cars --}}
                @if ($cars->count() > 0)
                    <div class="car-items-listing">
                        @foreach ($cars as $car)
                            <x-car-item :$car :isInWatchlist="true" />
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($cars->hasPages())
                        <div class="pagination-wrapper mt-4">
                            {{ $cars->onEachSide(1)->links() }}
                        </div>
                    @endif

                {{-- If user has no favourite cars --}}
                @else
                    <div class="text-center py-10">
                        <h3 class="text-xl font-semibold mb-2">No favourite cars yet.</h3>
                        <p class="text-muted mb-4">
                            You haven’t added any cars to your favourites list yet.
                            Browse the latest cars and tap the heart icon to add them.
                        </p>
                        <a href="{{ route('car.search') }}" class="btn btn-primary">
                            Browse Cars
                        </a>
                    </div>
                @endif
            </div>
        </section>
        <!--/ Favourite Cars -->
    </main>
</x-app-layout>