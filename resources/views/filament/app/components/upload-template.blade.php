<div id="addTemplateButton">

    <x-filament::button id="templateButton" size="sm" icon="heroicon-m-plus">
        Add your template
        {{-- <div x-data="templateUpload"> --}}

        <x-filament::input id="templateImage" type="file"
            accept=".jpg,.jpeg,.png,.svg,image/jpg,image/jpeg,image/png,image/svg+xml" style="display: none;" />

    </x-filament::button>
</div>
<div>

    {{-- {{ $files = null }} --}}
    @if ($files != null)


        @foreach ($files as $file)
            <div class="image-container">
                <x-filament::button class="image-button" data-file-url="{{ asset('storage/' . $file) }} ">
                    <img src="{{ asset('storage/' . $file) }}" alt="Preset Template" class="template-image"
                        loading="lazy">
                </x-filament::button>
            </div>
        @endforeach
    @endif
    <div class="uploaded-image-container">
        <x-filament::button class="uploaded-image-button" style="display: none;">
            <img alt="Upload Template" class="uploaded-template-image" loading="lazy" style="display: none;">
        </x-filament::button>

    </div>

</div>
