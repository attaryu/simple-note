<x-layout title="{{ $title }}" class="flex relative">
    <x-sidebar />
  
    <div class="p-6 w-5/6 h-svh fixed right-0 top-0 overflow-y-auto">
        {{ $slot }}
    </div>
</x-layout>
