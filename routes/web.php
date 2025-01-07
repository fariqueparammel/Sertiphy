  <?php



    use App\Http\Controllers\uploadFile;
    use Illuminate\Support\Facades\Route;

    Route::post('/upload', [UploadFile::class, 'store'])->name('upload');
    // Route::get('/upload', [uploadFile::class, 'store']);
    ?>
