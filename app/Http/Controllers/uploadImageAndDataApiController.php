<?php

namespace App\Http\Controllers;

use App\Models\FieldProperties;
use Illuminate\Http\Request;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;


class uploadImageAndDataApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function uploadImages(Request $request)
    // {
    //     $user_id = Auth::id();
    //     $projectId = Session::get('projectId');

    //     if (!$user_id) {
    //         return response()->json(['error' => 'User not authenticated'], 401);
    //     }

    //     if (!$projectId) {
    //         return response()->json(['error' => 'Project ID not found in session'], 400);
    //     }

    //     return response()->json([
    //         'user_id' => $user_id,
    //         'project_id' => $projectId
    //     ]);
    // }

    public function uploadImages(Request $request)
    {
        // Validate the request
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:10000',
            'jsonObject' =>  'required|string',
            'project_id' =>  'required|string',
            'user_id' =>  'required|string',

            // Max 2MB per image
        ]);
        //$projectId = 54;
        $user_id = $request->input('user_id');
        $projectId = $request->input('project_id');
        dump($user_id);

        dump($projectId);






        if (!$user_id || !$projectId) {
            dump("project/userid nill");
            return response()->json([
                'message' => 'Authentication or project ID is missing.',
            ], 400);
        }
        $jsonObject = json_decode($request->input('jsonObject'), true);
        dump($jsonObject);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'message' => 'Invalid JSON object.',
            ], 400);
        }
        $uploadedImages = [];

        // Loop through the uploaded files
        foreach ($request->file('images') as $image) {

            $storagePath = "user-uploads/user_id_{$user_id}/project_id_{$projectId}";

            // Store the image in DigitalOcean Spaces
            try {
                // $image = $request->file('images');
                $path = Storage::disk('digitalOceanSpaces')->put($storagePath, $image, 'public');
                $url = Storage::url($path);

                // Add the URL to the array
                $uploadedImages[] = $url;
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Failed to upload one or more images.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
        // 'user_id', 'project_id', 'field_properties', 'fieldDescription'
        if ($uploadedImages != null) {
            $i = 0;
            foreach ($uploadedImages as $item) {
                $imageUrl = ["url" => $item];
                $url = json_encode($imageUrl);
                $image = "image" . $i;
                dump($image);
                FieldProperties::insert([
                    'user_id' => $user_id,
                    'project_id' => $projectId,
                    'fieldDescription' => $image,
                    'field_properties' => $url,


                ]);
                $i++;
            }
            foreach ($jsonObject as $item) {
                $propertyName = $item["key"];
                unset($item['key']);
                $properties = json_encode($item);
                FieldProperties::insert([
                    'user_id' => $user_id,
                    'project_id' => $projectId,
                    'fieldDescription' => $propertyName,
                    'field_properties' => $properties,


                ]);
            }
        }
        Notification::make()
            ->title('Upload Successful')
            ->body('All images have been uploaded successfully.')
            ->success()
            ->send();

        // Return a success response

        return response()->json([
            'message' => 'Images uploaded successfully',
            'images' => $uploadedImages,
            'properties' => $jsonObject,

        ]);
    }
}
    //         // Return a JSON response
    //         return response()->json([
    //             'message' => 'Images uploaded successfully.',
    //             'images' => $uploadedImages,
    //         ]);
    //     }

    //     public function index()
    //     {
    //         //
    //     }

    //     /**
    //      * Store a newly created resource in storage.
    //      */
    //     public function store(Request $request)
    //     {
    //         //
    //     }

    //     /**
    //      * Display the specified resource.
    //      */
    //     public function show(FieldProperties $fieldProperties)
    //     {
    //         //
    //     }

    //     /**
    //      * Update the specified resource in storage.
    //      */
    //     public function update(Request $request, FieldProperties $fieldProperties)
    //     {
    //         //
    //     }

    //     /**
    //      * Remove the specified resource from storage.
    //      */
    //     public function destroy(FieldProperties $fieldProperties)
    //     {
    //         //
    //     }
    //     public function test()
    //     {
    //         return "testing api";
