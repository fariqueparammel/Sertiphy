<?php

namespace App\Filament\App\Pages;

use App\Http\Controllers\presetTemplateImage;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class CertificateDesigner extends Page
{
    // public static function shouldRegisterNavigation(): bool
    // {
    //     return false;
    // }
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.certificate-designer';
    protected ?string $heading = '';
    public $files = [];

    public function mount()
    {


        // Call the controller method
        $this->files = $this->getImage();
    }

    public static function getImage()
    {

        $imagePath = Storage::disk('public')->files('templatesImages');
        // dd($imagePath);
        foreach ($imagePath as $imageFullpath) {
            // $file_path = Storage::url($imageFullpath);
            // $url = asset($file_path);
            // $urls[] = storage_path($imageFullpath);

            $urls[] = $imageFullpath;

            //testing files variable
            $files = $urls;
        }
        return $files;
        // return view('filament.app.pages.certificate-designer', compact('files'));
    }
}
