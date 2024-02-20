@php
  $format = 'j M Y, g:i a';
  $timezone = timezone_open('Asia/Jakarta');
  $updated = date_timezone_set($note['updated_at'], $timezone);
  $created = date_timezone_set($note['created_at'], $timezone);
@endphp

<x-sidebar-layout title="Note - {{ $note['title'] }}">
  <main>
    <div class="flex gap-5 items-center p-5 bg-violet-600 rounded-lg">
      <div class="flex gap-2 items-center">
        @foreach (['favorite', 'archive'] as $status)
          <form action="{{ route("note.$status", $note) }}" method="POST">
            @csrf
            @method('patch')
            <button
              type="submit"
              @class([
                'border-[1px] px-3 py-1.5 block rounded-md',
                'text-white' => $status !== $note['status'],
                'bg-white text-violet-600' => $status === $note['status'],
              ])
            >
              {{ $status }}
            </button>
          </form>
        @endforeach
      </div>

      <p class="text-white">Last updated at <time datetime="{{ $note['updated_at'] }}">{{ $updated->format($format) }}</time></p>

      <div class="ml-auto flex gap-2">
        <a href="{{ route('note.edit', $note) }}" class="text-violet-600 bg-white rounded-lg grid place-items-center p-2">
          <x-icon>edit_note</x-icon>
        </a>
  
        <form action="{{ route('note.destroy', $note) }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="text-violet-600 bg-white rounded-lg grid place-items-center p-2">
            <x-icon>delete</x-icon>
          </button>
        </form>
      </div>
    </div>

    <h1 class="text-2xl font-semibold mt-8">{{ $note['title'] }}</h1>
    <p class="mt-4 text-lg opacity-85">{{ $note['content'] }}</p>
  </main>
</x-sidebar-layout>
