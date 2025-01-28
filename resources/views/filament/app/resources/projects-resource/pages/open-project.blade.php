<x-filament-panels::page>
    {{-- @php
        $projectId = $this->data['project_id'];
    @endphp --}}
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif --}}
    {{-- @php
        $project_id = $request->route('record');
        dd($project_id);
    @endphp --}}

    <form method='post' action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="record" value="{{ $record }}"> --}}
        <div class="flex gap-x-6">
            <!-- File Upload Button -->

            <x-filament::button color="primary">
                <x-filament::input type="file" id="uploadfile" name="file" class="hidden"
                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                {{-- <input type='hidden' name='record' value="{{ $projectid }}"> --}}
                <label for="uploadfile" class="cursor-pointer">
                    Choose CSV/XLSX File
                </label>
            </x-filament::button>

            <!-- Manual Data Entry Button (Will remain as is for now) -->
            <x-filament::button wire:click="manualDataEntry" color="primary" id="manualDataEntryBtn">
                Manual Data Entry
            </x-filament::button>

            {{-- <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" /> --}}

            <!-- Display the name of the chosen file -->
            <div id="fileName" class="mt-2 text-sm text-gray-500 hidden"></div>

            <!-- Submit Button (Initially Hidden) -->
            <x-filament::button color="primary" id="submitBtn" type='submit' class="hidden">
                Submit
            </x-filament::button>



        </div>
        {{-- @if ($showForm)
            <x-filament-panels::form id="form">
                {{ $this->form }}
            </x-filament-panels::form>
        @endif --}}

    </form>
    <!-- JavaScript to control visibility of the Submit button and file name display -->
    <script>
        const fileInput = document.getElementById('uploadfile');
        const submitButton = document.getElementById('submitBtn');
        const fileNameDisplay = document.getElementById('fileName');
        // const manualDataEntryBtn = document.getElementById('manualDataEntryBtn');
        // const form = document.getElementById('form');
        // manualDataEntryBtn.addEventListener('click', function() {
        //     form.style.display = "block";


        // })
        // Toggle visibility of submit button and display file name based on file selection
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                // Show submit button
                submitButton.classList.remove('hidden');

                // Display the selected file name
                fileNameDisplay.classList.remove('hidden');
                fileNameDisplay.textContent = `Selected File: ${fileInput.files[0].name}`;
            } else {
                // Hide submit button and file name display
                submitButton.classList.add('hidden');
                fileNameDisplay.classList.add('hidden');
            }
        });
    </script>

</x-filament-panels::page>
