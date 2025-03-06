<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Forms\Components\KeyValue;

use Filament\Resources\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\Projects;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms;
use Illuminate\Support\Facades\DB;

use Filament\Notifications\Notification;



class ManualDataEntry extends Page implements HasForms
{
    // use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.app.resources.projects-resource.pages.manual-data-entry';
    protected ?string $heading = " ";
    protected static ?string $title = 'Enter Data';

    // public $disableAddRow = true; // Prevent adding rows when duplicates are found




    // public  $enteredData;

    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             KeyValue::make('test')
    //                 ->label('Enter Data as heading value eg:Name : fari')
    //                 ->keyLabel('Column Name')
    //                 ->valueLabel(' Value')
    //                 ->addable($this->disableAddRow) // Disable adding rows if duplicates are found
    //                 ->editableKeys($this->disableAddRow)
    //                 ->statePath('enteredData'),
    //         ]);
    // }


    // public function submit()
    // {
    //     $tableData = $this->form->getState();

    //     $data = $tableData['enteredData'];
    //     $keys = array_keys($data);
    //     dd($keys);
    // $values = array_count_values($keys);
    // dd($values);
    // dd(gettype($keys));
    // $duplicateKeys = array_filter(array_count_values($keys));
    // dd($duplicateKeys);
    // $arraycount = array_count_values($keys);
    // // dump(print_r($arraycount));
    // $items = array();
    // foreach ($keys as  $value) {

    //     dump($value);
    //     $items[] = $value;
    // }
    // dd($items);

    // $tableData = $this->form->getState()['table_data']; // Access form data

    // Check for duplicate keys



    // if (!empty($duplicateKeys)) {
    //     // Notify user about duplicate keys
    //     Notification::make()
    //         ->title('Duplicate Keys Detected')
    //         ->body('The same key exists more than once. Please resolve duplicates before proceeding.')
    //         ->persistent()
    //         ->send();

    //     // Disable adding new rows until duplicates are resolved
    //     $this->disableAddRow = true;

    //     // Retain only the last occurrences of duplicates
    //     $filteredData = collect($tableData)->unique(function ($item, $key) {
    //         return $key; // Keep only the last occurrence of each duplicate key
    //     })->all();

    //     // Update form data with filtered rows
    //     $this->form->fill(['table_data' => $filteredData]);

    //     return;
    // }

    // If no duplicates, save data and route to the next page
    // $recordId = $this->getRecordId(); // Implement this method to get the record ID
    // DB::table('your_table_name')->updateOrInsert(
    //     ['record_id' => $recordId],
    //     ['data' => json_encode($tableData)]
    // );

    // Notify user of successful submission
    //     Notification::make()
    //         ->title('Data Submitted Successfully')
    //         ->success()
    //         ->send();

    //     // Redirect to the next page
    //     return redirect()->route('filament.app.pages.certificate-designer'); // Replace with your route name
    // }

    // public function table(Table $table): Table
    // {

    //     return $table

    //         ->emptyStateHeading('No posts yet')
    //         ->query(Projects::query())
    //         ->columns([

    //             TextColumn::make('currency')
    //                 ->money('EUR')
    //         ])
    //         ->filters([
    //             // ...
    //         ])
    //         ->actions([
    //             // ...
    //         ])
    //         ->bulkActions([
    //             // ...
    //         ]);
    // }
    // public function query()
    // {
    //     return Projects::query(); // Replace 'Project' with the appropriate model
    // }
}
