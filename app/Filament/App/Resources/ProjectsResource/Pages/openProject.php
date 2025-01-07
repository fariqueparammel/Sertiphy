<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Resources\Pages\Page;

class OpenProject extends Page
{
    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.app.resources.projects-resource.pages.open-project';
    protected ?string $heading = "Let's start crafting";
    protected static ?string $title = 'Data';


    // protected function layout(): string
    // {
    //     // Use a layout without the sidebar
    //     return 'filament.layouts.topbar-only';
    // }
}
