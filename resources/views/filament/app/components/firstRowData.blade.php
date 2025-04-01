{{-- resources/views/filament/app/components/firstRowData.blade.php --}}
@php
    // Use optional chaining and null coalescing for safety
    $data = json_decode($rowData ?? '[]', true);
@endphp

{{-- Removed the outer div, added spacing directly to the list --}}
<ol class="OrderedDataList space-y-1.5"> {{-- Remove list-style via Tailwind base, add vertical spacing --}}
    @forelse ($data as $key => $value)
        {{-- Added background, padding, border, rounded corners, hover effect, flex layout --}}
        <li
            class="listData flex items-center justify-between bg-gray-50 dark:bg-gray-800 p-2 rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out cursor-grab">
            {{-- Keep data-container ID if needed by JS, apply styling --}}
            <div class="data-container flex items-center gap-1.5 text-sm flex-grow mr-2" id="data-container"
                key="{{ $key }}" value="{{ $value }}">
                <span class="data-key font-medium text-gray-800 dark:text-gray-200">{{ $key }}</span>
                <span class="text-gray-500 dark:text-gray-400">:</span>
                <span class="data-value text-gray-600 dark:text-gray-300 truncate">{{ $value }}</span>
                {{-- Added truncate --}}
            </div>
            {{-- Keep btn div if structure is important for JS --}}
            <div class="btn flex-shrink-0">
                {{-- Keep remove-btn class, style with Tailwind --}}
                <button
                    class="remove-btn text-red-500 hover:text-red-700 dark:hover:text-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1 dark:focus:ring-offset-gray-800 rounded p-0.5"
                    data-key="{{ $key }}" data-value="{{ $value }}"
                    aria-label="Remove {{ $key }}">
                    {{-- Use a small SVG icon for the 'X' --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </li>
    @empty
        <li class="text-sm text-gray-400 dark:text-gray-500 italic">No data available.</li>
    @endforelse
</ol>
