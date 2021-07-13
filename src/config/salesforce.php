<?php

return [

    'api' => [
        "url_authorize" => env('SALESFORCE_URL_AUTHORIZE', 'https://login.salesforce.com/services/oauth2/token'),
        "client_id" => env('SALESFORCE_CLIENT_ID'),
        "client_secret" => env('SALESFORCE_CLIENT_SECRET'),
        "username" => env('SALESFORCE_USERNAME'),
        "password" => env('SALESFORCE_PASSWORD'),
    ],


    'code_societe' => 1,
    'id_site' => "Site web Oovango",



];