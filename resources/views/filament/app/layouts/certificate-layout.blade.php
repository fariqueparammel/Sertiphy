{{-- resources/views/filament/app/layouts/certificate-layout.blade.php --}}
{{-- Main flex container: fixed height below Filament top bar (verify 4rem matches actual header height), prevents its own scrolling --}}
{{-- Verify Filament header height: Inspect the <header> element in dev tools and adjust '4rem' if needed. E.g., h-[calc(100vh-68px)] --}}
<div class="flex h-[calc(100vh-4rem)] bg-gray-100 dark:bg-gray-800 overflow-hidden">

    {{-- Left Sidebar: Fixed width, internal scrolling for its sections --}}
    {{-- Using w-3/20 which is 15% --}}
    <div
        class="Lside-gallery w-3/20 border-r border-gray-300 dark:border-gray-700 flex flex-col bg-white dark:bg-gray-900 shadow-sm">
        {{-- Preset Templates Section: Takes half height, scrolls internally --}}
        <div id="preset-template"
            class="Lside-gallery-preset-template p-3 border-b border-gray-200 dark:border-gray-800 h-1/2 overflow-y-auto">
            <h3
                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 sticky top-0 bg-white dark:bg-gray-900 py-1 text-center">
                {{-- <<< Added text-center --}}
                Presets</h3> {{-- Added sticky header --}}
            @yield('preset-template')
        </div>

        {{-- Upload Template Section: Takes remaining height, scrolls internally --}}
        <div id="upload-template" class="Lside-gallery-template-upload p-3 flex-grow overflow-y-auto">
            <h3
                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 sticky top-0 bg-white dark:bg-gray-900 py-1 text-center">
                {{-- <<< Added text-center --}}
                Your Templates</h3> {{-- Added sticky header --}}
            @yield('upload-template')
        </div>
    </div>

    {{-- Center Content Area: Fixed width, top bar fixed height, canvas fills rest and scrolls internally --}}
    {{-- Using w-14/20 which is 70% --}}
    <div class="stateManagement-container-canvas w-14/20 flex flex-col">
        {{-- Top Toolbar: Fixed height, styles kept as before --}}
        <div
            class="topPanel h-14 flex-shrink-0 flex items-center gap-x-4 px-4 border-b border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm">
            {{-- Toolbar content... (no changes here) --}}
            <label for="fontSelector"
                class="text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">Font:</label>
            <select id="fontSelector"
                class="block w-36 h-8 text-sm rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-white"></select>
            <script type="module" src="{{ asset('js/filament/fontstyle.js') }}"></script>

            <label for="colorPicker" class="text-sm font-medium text-gray-700 dark:text-gray-200">Color:</label>
            <input type="color" id="colorPicker"
                class="h-7 w-7 p-0 border border-gray-300 dark:border-gray-600 rounded cursor-pointer">

            <label for="fontSizeInput"
                class="text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">Size:</label>
            <input type="number" id="fontSizeInput" value="24" min="1"
                class="block w-20 h-8 text-sm rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-white text-center">

            {{-- Buttons pushed to the right --}}
            <div class="ml-auto flex items-center gap-2">
                <x-filament::button size="sm" color="gray" class="clear">
                    Clear
                </x-filament::button>
                <x-filament::button size="sm" class="generate">
                    Generate
                </x-filament::button>
            </div>
            <button wire:click="download" style="display: none;" id="routeToDownload"></button>
        </div>

        {{-- Konva Canvas Area: Fills remaining space, scrolls internally if needed --}}
        <div id="konvaCanvas"
            class="flex-grow overflow-hidden {{-- <<< Changed from overflow-auto --}} bg-gray-200 dark:bg-gray-700 p-4 flex items-center justify-center">
            <div id="container" class="bg-white shadow-lg"></div>
        </div>
    </div>

    {{-- Right Sidebar: Fixed width, data section fills height and scrolls internally --}}
    {{-- Using w-3/20 which is 15% --}}
    <div
        class="Rside-gallery w-3/20 border-l border-gray-300 dark:border-gray-700 flex flex-col bg-white dark:bg-gray-900 shadow-sm">
        {{-- Removed the ai-otherfeatures div --}}

        {{-- Draggable Data Section: Fills entire sidebar height now, scrolls internally --}}
        <div class="sample-draggable-data p-3 flex-grow overflow-y-auto">
            <h3
                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 sticky top-0 bg-white dark:bg-gray-900 py-1">
                {{-- No text-center here unless desired --}}
                Data Fields</h3> {{-- Added sticky header --}}
            @yield('data')
        </div>
    </div>

</div>

{{-- Script block remains the same --}}
@php
    $user_id = Auth::id();
@endphp
<script>
    const currentProjectId = {{ session('projectId', 'null') }};
    const user_id = {{ $user_id ?? 'null' }};
    // console.log("Current Project ID:", currentProjectId);
    // console.log("Current user ID:", user_id);
</script>

{{-- Make sure necessary JS (like the upload handler from previous response) is loaded --}}
