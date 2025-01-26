<?php

namespace App\Filament\App\Resources\ProjectsResource\Pages;

use Illuminate\Support\Facades\Auth;
use app\Filament\App\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Services\storeProjectIdService;

class CreateProjects extends CreateRecord
{
    protected static string $resource = ProjectsResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }


    protected function getRedirectUrl(): string
    {
        $project_id = $this->record->id;
        $sendProjectId = new storeProjectIdService;
        $sendProjectId->getProjectId($project_id);
        session_start();
        //using a session to store the proejctId
        Session::put('projectId',  $project_id);
        return $this->getResource()::getUrl('view');
    }
}
