<?php

namespace App\Http\Controllers;

use Filament\Livewire\Notifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification as NotificationsNotification;

use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\Livewire;

// Request $request
class routeToDownloadPage extends Controller
{
    public function handleRouting()
    {
        // if ($request->input() == 200) {
        // return Notification::make()
        //     ->title('Saved successfully')
        //     ->success()
        //     ->send();
        // echo "TestController / do";
        Notification::make()
            ->title('Notification Test')
            ->success()
            ->send();
        return redirect()->back();
    }
}
