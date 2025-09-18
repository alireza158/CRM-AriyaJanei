@props(['title', 'route', 'svg' => 'file', 'color' => 'bg-gray-100'])

<div class="{{ $color }} border border-gray-200 rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
    {{-- آیکون SVG --}}
    <div class="flex items-center mb-4">
        <div class="w-10 h-10 text-gray-700 mr-3">
            @include("components.icons.$svg")
        </div>
        <h3 class="text-lg font-bold text-gray-800">{{ $title }}</h3>
    </div>

    <div class="mt-auto">
        <a href="{{ route($route) }}"
           class="text-sm px-4 py-2 inline-block bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            مشاهده
        </a>
    </div>
</div>
