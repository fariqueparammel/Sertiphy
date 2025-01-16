<div class="preset-template-images">
    {{-- @php
        foreach ($files as $file) {
            dd($file);
        }
    @endphp --}}
    @foreach ($files as $file)
        <div class="image-container">
            <img src="{{ asset('storage/' . $file) }}" alt="Preset Template" class="template-image" loading="lazy">
        </div>
    @endforeach



</div>
{{-- <style>
    .preset-template-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .image-container {
        width: 150px;
        height: 150px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .template-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style> --}}
