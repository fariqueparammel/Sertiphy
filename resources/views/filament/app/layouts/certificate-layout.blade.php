<div class="main-layout">


    <div class= "Lside-gallery">
        {{-- <div id="container"> --}}
        <div id="preset-template" class="Lside-gallery-preset-template">

            {{-- @include('filament.app.components.preset-template') --}}
            @yield('preset-template')

        </div>

        <div id="upload-template" class="Lside-gallery-template-upload">
            fsr
            {{-- @yield('upload-template') --}}

            {{--
                @include('filament.app.components.upload-template') --}}
        </div>
        {{-- </div> --}}
    </div>
    <div class="stateManagement-container-canvas">
        <div class="topPanel">

        </div>
        <div id="konvaCanvas">

            <div id="container"></div>
        </div>


    </div>
    <div class="Rside-gallery">

        <div class="ai-otherfeatures"></div>

        <div class="sample-draggable-data"></div>

    </div>


</div>
