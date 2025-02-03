<div>
    {{-- KeyValue Form --}}
    <x-filament-panels::form wire:submit.prevent="submit" id="keyValueForm">
        <!-- Add Column Button -->
        {{-- <button type="button" id="addColumnBtn">Add Column</button>

        <!-- Add Row Button -->
        <button type="button" id="addRowBtn">Add Row</button>

        <!-- Export Data Button -->
        <button type="button" id="exportDataBtn">Export to JSON</button> --}}
        {{-- {{ $this->form }} --}}

        <div id="example-table"style="height: 660px; width: 1331px;"></div>

        {{-- Submit Button --}}
        <x-filament::button type="submit" color="primary" class="mt-4">
            Submit
        </x-filament::button>
    </x-filament-panels::form>
</div>
