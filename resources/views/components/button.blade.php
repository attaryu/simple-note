<button
    type="{{ $type }}"
    @class([
        'py-2.5 rounded-md font-semibold focus:outline outline-2 outline-offset-1 outline-violet-600',
        'text-white bg-violet-500 hover:bg-violet-400' => $class === 'primary',
        'text-violet-600 hover:text-violet-400 bg-violet-100 hover:bg-violet-50' => $class === 'secondary',
        $width => $width,
        "text-$fontSize" => $fontSize,
    ])
    {{ $attributes }}
>
    {{ $slot }}
</button>
