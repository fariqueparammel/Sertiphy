<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\ProjectsResource;
use App\Services\getJsonDataService;
use App\Http\Controllers\presetTemplateImage;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;


class CertificateDesigner extends Page
{
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // protected static string $resource = ProjectsResource::class;
    protected static string $view = 'filament.app.pages.certificate-designer';
    protected ?string $heading = '';
    public $files = [];
    public $firstRowData;
    public function mount()
    {


        //need to make it fetch data based on projectId !!!!!!!!
        // i think i stored the current project id in the session might need to pass it throught url or take it fromt he session
        //might be deleting the session in the excelupload controller
        $this->firstRowData = getJsonDataService::firstRowData();
        // Call the controller method
        $this->files = $this->getImage();
    }
    public function download()
    {
        // $projectId = Session::get('projectId'); // Example: Get the project ID
        // return redirect()->to(ProjectsResource::getDownloadUrl($projectId));
        return redirect()->to(ProjectsResource::getUrl('download'));
    }

    public static function getImage()
    {

        $imagePath = Storage::files('preset-templates');
        // dd($imagePath);
        //  Storage::disk('public')->files('templatesImages');
        // dd($imagePath);
        // $projectIdd = Session::get('projectId');
        // dump($projectIdd);
        foreach ($imagePath as $imageFullpath) {
            $file_path = Storage::url($imageFullpath);
            // $url = asset($file_path);
            // $urls[] = storage_path($imageFullpath);

            $urls[] = $file_path;

            //testing files variable
            $files = $urls;
        }
        return $files;
        // return view('filament.app.pages.certificate-designer', compact('files'));
    }
}
