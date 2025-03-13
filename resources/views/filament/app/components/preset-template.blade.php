<div class="preset-template-images">


    @foreach ($files as $file)
        <div class="image-container">
            {{-- data-file-url="{{ asset('storage/' . $file) }} " --}}
            <x-filament::button class="image-button" data-file-url="{{ $file }}">
                <img src="{{ $file }}" alt="Preset Template" class="template-image">
            </x-filament::button>
        </div>
    @endforeach
</div>
