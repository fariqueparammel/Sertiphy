{{-- resources/views/filament/app/components/preset-template.blade.php --}}
{{-- Use Tailwind Grid for layout --}}
<div class="preset-template-images grid grid-cols-2 gap-2">
    @forelse ($files as $file)
        {{-- Keep image-container class if needed, but grid gap handles spacing --}}
        <div class="image-container aspect-w-16 aspect-h-11"> {{-- Maintain aspect ratio --}}
            {{-- Keep image-button class. Remove default button padding/bg. Add focus ring styling. --}}
            <x-filament::button tag="button" {{-- Ensure it's a button if used like one --}} color="gray" {{-- Use gray color to remove default coloring --}}
                class="image-button !p-0 !bg-transparent w-full h-full flex items-center justify-center overflow-hidden rounded-md border border-gray-300 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 dark:focus:ring-offset-gray-900"
                data-file-url="{{ $file }}">
                {{-- Style the image --}}
                <img src="{{ $file }}" alt="Preset Template"
                    class="template-image object-cover w-full h-full transition-transform duration-150 ease-in-out group-hover:scale-105">
            </x-filament::button>
        </div>
    @empty
        <p class="col-span-2 text-sm text-gray-400 dark:text-gray-500 italic">No preset templates found.</p>
    @endforelse
</div>
