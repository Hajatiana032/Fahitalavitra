<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class UrlApiService
{
    /**
     * @param  string  $url
     * @param  array|null  $query
     * @return Response
     * @throws RequestException
     * @throws ConnectionException
     */
    public function url(string $url, ?array $query = [])
    {
        return Http::withHeaders(['Authorization' => 'Bearer '.config('services.tmdb_api_key')])
            ->timeout(5)
            ->get($url, $query)
            ->throw();
    }
}
