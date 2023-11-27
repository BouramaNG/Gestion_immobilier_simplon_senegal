<?php

namespace App\Listeners;

use App\Events\NewProductAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewProductNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewProductNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     */
    public function handle(NewProductAdded $event): void
    {
        $propertie = $event->propertie;

        // Envoyer l'email
        Mail::to($propertie->email)
            ->send(new NewProductNotification($propertie));
    }
}
