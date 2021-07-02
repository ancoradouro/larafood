<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Client;

class ClientObserver
{
     /**
     * Handle the Client "created" event.
     *
     * @param  \App\Models\Client  $Client
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }

}
