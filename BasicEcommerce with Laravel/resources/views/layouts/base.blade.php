@props(['bodyClass' => '', 'title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | CAR BUY & SELL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- App Styles --}}
    <link rel="stylesheet" href="/css/app.css" />
</head>

<body @if ($bodyClass) class="{{ $bodyClass }}" @endif>

    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script src="/js/app.js"></script>

    @stack('scripts')

    {{-- JS Favourite Logic --}}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.addToFavourite = async function(carId) {
                try {
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : null;
                    if (!csrfToken) return console.error('CSRF token missing');

                    const res = await fetch(`/car/${carId}/favourite`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    });

                    if (res.status === 401) {
                        window.location.href = '/login';
                        return;
                    }

                    const data = await res.json();
                    if (!data.success) throw new Error(data.message || 'Failed');

                    // Try to find the heart button in listings
                    let btn = document.querySelector(`.car-item[data-car-id="${carId}"] .btn-heart`);

                    // Or fallback to show page (direct heart button)
                    if (!btn) {
                        btn = document.querySelector(`.btn-heart[onclick="addToFavourite(${carId})"]`);
                    }

                    if (btn) {
                        if (data.action === 'added') {
                            btn.classList.add('is-favourited');
                            btn.setAttribute('aria-pressed', 'true');
                            btn.querySelector('svg').setAttribute('fill', 'orange');
                            btn.querySelector('svg').setAttribute('stroke', 'orange');
                        } else if (data.action === 'removed') {
                            btn.classList.remove('is-favourited');
                            btn.setAttribute('aria-pressed', 'false');
                            btn.querySelector('svg').setAttribute('fill', 'none');
                            btn.querySelector('svg').setAttribute('stroke', '#999');
                        }
                    }
                } catch (err) {
                    console.error('Favourite toggle failed:', err);
                    alert('Could not update favourite status.');
                }
            };
        });
    </script>

</body>

</html>
