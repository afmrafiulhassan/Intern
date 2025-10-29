<x-guest-layout title="Login" bodyClass="page-login">

    <h1 class="auth-page-title">Login</h1>

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required />
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Your Password" required />
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="text-right mb-medium">
            {{-- <a href="{{ route('password.request') }}" class="auth-page-password-reset">Reset Password</a> --}}
        </div>

        <button type="submit" class="btn btn-primary btn-login w-full">Login</button>
    </form>

    <x-slot:footerLink>
        Don't have an account? -
        <a href="{{ route('signup') }}">Click here to create one</a>
    </x-slot:footerLink>

</x-guest-layout>