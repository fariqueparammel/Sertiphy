<div id="addTemplateButton">

    <x-filament::button id="templateButton" size="sm" icon="heroicon-m-plus">
        Add your template
        {{-- <div x-data="templateUpload"> --}}

        <x-filament::input id="templateImage" type="file"
            accept=".jpg,.jpeg,.png,.svg,image/jpg,image/jpeg,image/png,image/svg+xml" style="display: none;" />

    </x-filament::button>
</div>
