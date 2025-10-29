<x-guest-layout title="Signup" bodyClass="page-signup">
    <h1 class="auth-page-title">Signup</h1>

    <form action="{{ route('signup.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required />
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Your Password" required />
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="Repeat Password" required />
        </div>

        <hr />

        <div class="form-group">
            <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required />
        </div>

        <div class="form-group">
            <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required />
        </div>

        <div class="form-group">
            <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" />
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary btn-login w-full">Register</button>
    </form>

    <x-slot:footerLink>
        Already have an account? -
        <a href="{{ route('login') }}">Click here to login</a>
    </x-slot:footerLink>
</x-guest-layout>