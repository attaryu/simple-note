<x-sidebar-layout title="Home">
    <main>
        <h1 class="text-3xl font-semibold">Note</h1>

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
                        <form action="{{ route('note.favorite', $note) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button type="submit" class="rounded-lg p-2 grid place-items-center border-[1px] border-zinc-700">
                                @if ($note['status'] === 'favorite')
                                    <x-icon>favorite</x-icon>
                                @else
                                    <x-icon>favorite_border</x-icon>
                                @endif
                            </button>
                        </form>
                        
                        <form action="{{ route('note.archive', $note) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button type="submit" class="rounded-lg p-2 grid place-items-center border-[1px] border-zinc-700">
                                <x-icon>archive</x-icon>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>
</x-sidebar-layout>
