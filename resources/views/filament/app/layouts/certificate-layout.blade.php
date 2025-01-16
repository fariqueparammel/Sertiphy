<div class="main-layout">


    <div class= "Lside-gallery">
        {{-- <div id="container"> --}}
        <div id="preset-template" class="Lside-gallery-preset-template">

            {{-- @include('filament.app.components.preset-template') --}}
            @yield('images')

        </div>

        <div id="upload-template" class="Lside-gallery-template-upload">

            fsr
            {{--
                @include('filament.app.components.upload-template') --}}
        </div>
        {{-- </div> --}}
    </div>
    <div class="stateManagement-container-canvas">
        <div class="topPanel">
        </div>
        <div id="konvaCanvas"></div>


    </div>
    <div class="Rside-gallery">

        <div class="ai-otherfeatures"></div>

        <div class="sample-draggable-data"></div>

    </div>


</div>
