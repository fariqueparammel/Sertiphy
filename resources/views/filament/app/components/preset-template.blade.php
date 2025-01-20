<div class="preset-template-images">
    @foreach ($files as $file)
        <div class="image-container">
            <x-filament::button class="image-button" data-file-url="{{ asset('storage/' . $file) }} ">
                <img src="{{ asset('storage/' . $file) }}" alt="Preset Template" class="template-image" loading="lazy">
            </x-filament::button>
        </div>
    @endforeach
</div>
