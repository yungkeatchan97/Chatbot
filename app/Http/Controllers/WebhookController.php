<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $response = 'hi?';

        $fulfillment = array(
            "fulfillmentText" => $response
        );

        echo(json_encode($fulfillment));
    }
}
