<x-sidebar-layout title="New Note">
  <main>
    <form action="{{ route('note.store') }}" method="POST" class="flex flex-col w-full *:outline-none">
      @csrf
  
      <div class="flex gap-6 items-center">
        <h1 class="text-2xl">New Note</h1>
        <div class="flex gap-3 items-center">
          @foreach (['none', 'favorite', 'archive'] as $i => $status)
            <label for="{{ $status }}" class="bg-violet-50 border-[1px] border-violet-600 text-violet-600 px-3 py-1.5 block rounded-md has-[:checked]:bg-violet-600 has-[:checked]:text-white cursor-pointer">
              <input type="radio" name="status" id="{{ $status }}" value="{{ $status }}" @if ($i === 0) checked @endif class="hidden">
              {{ strtoupper($status[0]) . substr($status, 1) }}
            </label>
          @endforeach
        </div>
      </div>
  
      <input type="text" name="title" id="title" placeholder="Title..." required class="mt-6 text-2xl font-semibold">
  
      <textarea name="content" id="content" placeholder="What do you think for now?" rows="18" required class="w-full resize-y mt-4 text-lg opacity-85"></textarea>
  
      <button type="submit" class="bg-violet-500 text-white size-16 rounded-full font-semibold fixed bottom-7 right-7">Save</button>
    </form>
  </main>
</x-sidebar-layout>
