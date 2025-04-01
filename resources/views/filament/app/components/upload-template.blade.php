{{-- resources/views/filament/app/components/upload-template.blade.php --}}

{{-- Button section - Kept centering style --}}
<div id="addTemplateButton" class="flex justify-center mb-3"> {{-- Added mb-3 for spacing --}}
    <x-filament::button id="templateButton" size="sm" icon="heroicon-m-plus">
        Add your template
    </x-filament::button>
    {{-- Using filament input as per original code structure --}}
    <x-filament::input id="templateImage" type="file"
        accept=".jpg,.jpeg,.png,.svg,image/jpg,image/jpeg,image/png,image/svg+xml" style="display: none;" />
</div>

{{-- Container for uploaded images - Applying grid layout --}}
{{-- Structure matches original, with added grid classes --}}
<div id="test"> {{-- Kept ID --}}
    <div class="uploaded-image-container grid grid-cols-2 gap-2"> {{-- Kept class, added grid --}}

        {{-- Original Placeholder - Stays hidden as requested --}}

        <div class="image-container aspect-w-16 aspect-h-11"> {{-- Maintain aspect ratio --}}
            {{-- Keep image-button class. Remove default button padding/bg. Add focus ring styling. --}}
            <x-filament::button tag="button" {{-- Ensure it's a button if used like one --}} color="gray" {{-- Use gray color to remove default coloring --}}
                class="uploaded-image-button !p-0 !bg-transparent w-full h-full flex items-center justify-center overflow-hidden rounded-md border border-gray-300 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 dark:focus:ring-offset-gray-900"
                style="display: none">
                {{-- Style the image --}}
                <img alt="upload Template"
                    class="uploaded-template-image object-cover w-full h-full transition-transform duration-150 ease-in-out group-hover:scale-105"
                    style="display: none;">
            </x-filament::button>
        </div>

        {{-- <x-filament::button class="uploaded-image-button" style="display: none;">
            <img alt="Upload Template Placeholder" class="uploaded-template-image" loading="lazy"
                style="display: none;">
        </x-filament::button> --}}
        {{-- End Original Placeholder --}}

        {{-- Dynamically added images by your script should appear here --}}
        {{-- EXAMPLE STRUCTURE for JS to create (Matches preset-template styling): --}}
        {{--
        <div class="image-container aspect-w-16 aspect-h-11 relative group"> // Wrapper with aspect ratio + relative positioning for potential remove button
            <x-filament::button
                tag="button"
                color="gray"
                class="uploaded-image-button !p-0 !bg-transparent w-full h-full flex items-center justify-center overflow-hidden rounded-md border border-gray-300 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 dark:focus:ring-offset-gray-900"> // Styling matches preset buttons
                <img alt="Upload Template" class="uploaded-template-image object-cover w-full h-full" loading="lazy" src="..."> // Use object-cover like presets
            </x-filament::button>
            // Optional: Add a remove button here positioned absolutely, similar to JS example in previous response
        </div>
        --}}

    </div>
</div>
