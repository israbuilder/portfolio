<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LlmsFullTxtController extends Controller
{
    public function __invoke(BlogService $blogService): Response
    {
        $baseUrl = $blogService->getApiBaseUrl();

        if (empty($baseUrl)) {
            Log::error('[llms-full.txt] PUBLIC_API_URL no está definida en el entorno.');

            return response("# Configuration Error\n\nPUBLIC_API_URL is missing.", 500, [
                'Content-Type' => 'text/plain; charset=utf-8',
            ]);
        }

        $url = "{$baseUrl}/llms-full.txt";

        try {
            $res = Http::withoutVerifying()
                ->timeout(15)
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                ])
                ->get($url);

            if (! $res->successful()) {
                throw new \Exception("CRM returned HTTP {$res->status()}");
            }

            return response($res->body(), 200, [
                'Content-Type' => 'text/plain; charset=utf-8',
                'Cache-Control' => 'public, max-age=3600',
            ]);
        } catch (\Throwable $error) {
            Log::error("[llms-full.txt] Error fetching from CRM: " . $error->getMessage());

            return response("# Service Temporarily Unavailable\n\nPlease check back soon.", 503, [
                'Content-Type' => 'text/plain; charset=utf-8',
            ]);
        }
    }
}
