@php
  $format = 'j M Y, g:i a';
  $timezone = timezone_open('Asia/Jakarta');
  $updated = date_timezone_set($note['updated_at'], $timezone);
  $created = date_timezone_set($note['created_at'], $timezone);
@endphp

<x-sidebar-layout title="Note - {{ $note['title'] }}">
  <form action="{{ route('note.update', $note) }}" method="POST" class="flex flex-col w-full *:outline-none">
    @csrf
    @method('put')

    <div class="flex gap-6 items-center">
      <div class="flex gap-3 items-center">
        @foreach (['none', 'favorite', 'archive'] as $status)
          <label for="{{ $status }}" class="bg-violet-50 border-[1px] border-violet-600 text-violet-600 px-3 py-1.5 block rounded-md has-[:checked]:bg-violet-600 has-[:checked]:text-white cursor-pointer">
            <input type="radio" name="status" id="{{ $status }}" value="{{ $status }}" @if ($status === $note['status']) checked @endif class="hidden">
            {{ strtoupper($status[0]) . substr($status, 1) }}
          </label>
        @endforeach
      </div>
    </div>

    <input type="text" name="title" id="title" placeholder="Title..." required class="mt-6 text-2xl font-semibold" value="{{ $note['title'] }}">

    <textarea name="content" id="content" placeholder="What do you think for now?" rows="18" required class="w-full resize-y mt-4 text-lg opacity-85">{{ $note['content'] }}</textarea>

    <button type="submit" class="bg-violet-500 text-white size-16 rounded-full font-semibold fixed bottom-7 right-7">Save</button>
  </form>
</x-sidebar-layout>
