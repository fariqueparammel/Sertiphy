<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use App\Filament\App\Resources\ProjectsResource;
use Filament\Resources\Pages\Page;

class downloadCertificates extends Page
{
    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.app.resources.projects-resource.pages.download-certificates';
}
