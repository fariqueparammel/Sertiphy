<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ManualDataEntry extends Page
{
    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.app.resources.projects-resource.pages.manual-data-entry';
}
