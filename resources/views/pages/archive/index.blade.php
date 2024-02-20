<x-sidebar-layout title="Archive">
  <main>
    <h1 class="text-2xl font-semibold">Archive</h1>
    
    <ul class="flex flex-col gap-3 mt-4">
      @foreach ($notes as $note)
        @php
          $convertedDate = date_timezone_set($note['updated_at'], timezone_open('Asia/Jakarta'));
        @endphp

        <li class="bg-zinc-100 p-5 rounded-lg flex items-center">
          <div>
            <a href="{{ route('note.show', [$note]) }}" class="text-lg font-semibold hover:underline">{{ $note['title'] }}</a>
            <p class="mt-1 text-sm opacity-70">Last update at: {{ $convertedDate->format('j M Y, g:i a') }}</p>
          </div>

          <div class="ml-auto flex gap-3">
            <form action="{{ route('note.archive', $note) }}" method="POST">
              @csrf
              @method('patch')
              <button type="submit" class="rounded-lg p-2 grid place-items-center border-[1px] border-zinc-700">
                <x-icon>unarchive</x-icon>
              </button>
            </form>
            <form action="{{ route('note.destroy', $note) }}" method="POST">
              @csrf
              @method('delete')
              <button type="submit" class="rounded-lg p-2 grid place-items-center border-[1px] border-zinc-700">
                <x-icon>delete</x-icon>
              </button>
            </form>
          </div>
        </li>
      @endforeach
    </ul>
  </main>
</x-sidebar-layout>
