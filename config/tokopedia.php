<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tokopedia Open API Configuration
    |--------------------------------------------------------------------------
    |
    | Credentials from Tokopedia Developer / Partner Center.
    | Token and requests are handled server-side only.
    |
    */
    'client_id' => env('TOKOPEDIA_CLIENT_ID', ''),
    'client_secret' => env('TOKOPEDIA_CLIENT_SECRET', ''),
    'fs_id' => env('TOKOPEDIA_FS_ID', ''),
    'shop_id' => env('TOKOPEDIA_SHOP_ID', ''),
    'api_url' => env('TOKOPEDIA_API_URL', 'https://fs.tokopedia.net'),
    'auth_url' => env('TOKOPEDIA_AUTH_URL', 'https://accounts.tokopedia.com/token?grant_type=client_credentials'),
];

