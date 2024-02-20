<aside class="w-1/6 h-svh p-5 border-r-[1px] border-zinc-300 flex flex-col gap-5 fixed">
    <div class="bg-violet-500 text-white rounded-lg p-4 flex flex-col">
        <div class="size-14 rounded-full bg-zinc-100"></div>

        <p class="font-semibold truncate mt-4">{{ $user->name }}</p>
        <p class="text-sm truncate">{{ $user->email }}</p>
    </div>

    <a href="{{ route('note.create') }}" class="text-center border-[1px] py-2 border-violet-500 rounded-md text-violet-500 bg-violet-100 font-bold">New Note</a>

    <nav class="flex flex-col gap-2">
        @foreach ($links as $link)
            @if ($link['path'] === $currentLink)
                <a href="{{ $link['path'] }}" class="bg-violet-500 text-white py-2 px-3 rounded-md flex gap-3">
                    <x-icon>{{ $link['icon'] }}</x-icon>
                    {{ $link['title'] }}
                </a>
            @else
                <a href="{{ $link['path'] }}" class="py-2 px-3 rounded-md flex gap-3">
                    <x-icon>{{ $link['icon'] }}</x-icon>
                    {{ $link['title'] }}
                </a>
            @endif
        @endforeach
    </nav>

    <form action="{{ route('auth.logout') }}" method="POST" class="mt-auto">
        @csrf
        <x-button class="secondary" fontSize="base" type="submit">Log Out</x-button>
    </form>
</aside>
