@php
  $emailError = $errors->first('email');
  $nameError = $errors->first('name');
  $passwordError = $errors->first('password');
@endphp

<x-layout title="Sign In" class="w-full h-lvh p-12">
  <main class="bg-gradient-to-br from-violet-300 to-violet-500 w-full h-full rounded-2xl grid place-items-center">
    <form action="{{ route('auth.signin') }}" method="POST" class="w-1/3 bg-white p-10 rounded-md">
      <h1 class="font-bold text-3xl text-center">Welcome!</h1>
      
      @csrf
      <div class="flex flex-col gap-4 w-full my-10">
        <x-input type="text" autocomplete="name" placeholder="Name" name="name" required/>
        @if ($nameError)
          <p class="text-sm text-red-500">{{ $nameError }}</p>
        @endif
        <x-input type="email" autocomplete="email" placeholder="Email" name="email" required/>
        @if ($emailError)
          <p class="text-sm text-red-500">{{ $emailError }}</p>
        @endif
        <x-input type="password" placeholder="Password" name="password" required />
        <x-input type="password" placeholder="Confirm Password" name="password_confirmation" required />
        @if ($passwordError)
          <p class="text-sm text-red-500">{{ $passwordError }}</p>
        @endif
      </div>

      <x-button type="submit" class="primary">
        Login
      </x-button>

      <p class="text-sm text-center mt-4">
        Have an account? <a href="{{ route('auth.loginPage') }}" class="text-violet-500">Login</a>
      </p>
    </form>
  </main>
</x-layout>
