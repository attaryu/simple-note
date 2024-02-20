@php
  $emailError = $errors->first('email');
  $passwordError = $errors->first('password');
  $loginError = $errors->first('login');
@endphp

<x-layout title="Login" class="w-full h-lvh p-12">
  <main class="bg-gradient-to-br from-violet-300 to-violet-500 w-full h-full rounded-2xl grid place-items-center">
    <form action="{{ route('auth.login') }}" method="POST" class="w-1/3 bg-white p-10 rounded-md">
      <h1 class="font-bold text-3xl text-center">You're Comeback!</h1>

      @csrf
      <div class="flex flex-col gap-4 w-full my-10">
        @if ($loginError)
          <p class="text-center w-full py-2 bg-red-100 text-red-600 outline outline-1 outline-red-400 rounded-md text-sm">{{ $loginError }}</p>
        @endif

        <x-input type="email" autocomplete="email" placeholder="Email" name="email" required/>
        @if ($emailError)
          <p class="text-sm text-red-500">{{ $emailError }}</p>
        @endif

        <x-input type="password" placeholder="Password" name="password" required />
        @if ($passwordError)
          <p class="text-sm text-red-500">{{ $passwordError }}</p>
        @endif
      </div>

      <x-button type="submit" class="primary">
        Login
      </x-button>

      <p class="text-sm text-center mt-4">
        Don't have an account? <a href="{{ route('auth.signinPage') }}" class="text-violet-500">Sign In</a>
      </p>
    </form>
  </main>
</x-layout>
