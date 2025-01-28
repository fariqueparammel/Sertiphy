<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class OpenProject extends Page  implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;
    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.app.resources.projects-resource.pages.open-project';
    protected ?string $heading = "Let's start crafting";
    protected static ?string $title = 'Data';

    public $showForm = false;

    public function manualDataEntry()
    {
        // $this->showForm = true;

        // return  redirect()->$this->getRedirectUrl();
        return redirect()->to($this->getResource()::getUrl('data-entry'));
    }


    public function getFormSchema(): array
    {
        return [
            KeyValue::make('Enter Data')
                ->keyLabel('Property name')


        ];
    }

    public function getFormActions(): array
    {
        return [
            Action::make('greet')
                ->action(function () {
                    Notification::make()
                        ->title(__('Hello ' . $this->name))
                        ->success()
                        ->send();
                }),
        ];
    }
    // protected function layout(): string
    // {
    //     // Use a layout without the sidebar
    //     return 'filament.layouts.topbar-only';
    // }


    public function getRedirectUrl(): string
    {

        return $$this->getResource()::getUrl('data-entry');
    }
}
