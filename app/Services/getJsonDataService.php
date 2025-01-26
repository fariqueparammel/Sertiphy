<?php

namespace App\Services;

use App\Models\FieldData; // Assuming you have a Certificate model
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

class getJsonDataService
{
    public static function firstRowData()
    {
        $projectId = session('projectId');
        if (!$projectId) {
            Log::error('Project ID not found in session.');
            return null;
        }
        $rowData =  FieldData::select('fieldData')->where('project_id', $projectId)->first();
        if (!$rowData) {
            Log::error('No field data found for project ID: ' . $projectId);
            return null;
        }
        return $rowData->fieldData;
    }
}
