<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlogService
{

    public function getApiBaseUrl(): string
    {
        $url = config('services.blog.api_url', env('PUBLIC_API_URL', ''));

        if (empty($url)) {
            return '';
        }

        $trimmed = rtrim(trim($url), '/');
        return preg_replace('/\/posts\/?$/', '', $trimmed);
    }

    /**
     *
     * @return array{data: array, meta: array}
     */
    public function getPosts(int $page = 1, int $perPage = 12): array
    {
        $baseUrl = $this->getApiBaseUrl();

        if (empty($baseUrl)) {
            return [
                'data' => [],
                'meta' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'per_page' => $perPage,
                    'total' => 0,
                ],
            ];
        }

        $url = "{$baseUrl}/posts?per_page={$perPage}&page={$page}";

        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                ])
                ->get($url);

            if (! $response->successful()) {
                Log::warning("[Blog API] Error al obtener posts ({$response->status()}) de {$url}");

                return [
                    'data' => [],
                    'meta' => [
                        'current_page' => $page,
                        'last_page' => 1,
                        'per_page' => $perPage,
                        'total' => 0,
                    ],
                ];
            }

            $json = $response->json();

            if (is_array($json) && array_is_list($json)) {
                return [
                    'data' => $json,
                    'meta' => [
                        'current_page' => 1,
                        'last_page' => 1,
                        'per_page' => count($json),
                        'total' => count($json),
                    ],
                ];
            }

            $data = isset($json['data']) && is_array($json['data']) ? $json['data'] : [];
            $meta = $json['meta'] ?? [
                'current_page' => $page,
                'last_page' => 1,
                'per_page' => $perPage,
                'total' => count($data),
            ];

            return [
                'data' => $data,
                'meta' => $meta,
            ];
        } catch (\Throwable $e) {
            Log::warning("[Blog API] Error de red o parseo en {$url}: " . $e->getMessage());

            return [
                'data' => [],
                'meta' => [
                    'current_page' => $page,
                    'last_page' => 1,
                    'per_page' => $perPage,
                    'total' => 0,
                ],
            ];
        }
    }

    public function getPostBySlug(string $slug): ?array
    {
        if (empty($slug)) {
            return null;
        }

        $baseUrl = $this->getApiBaseUrl();

        if (empty($baseUrl)) {
            return null;
        }

        $encodedSlug = rawurlencode($slug);
        $url = "{$baseUrl}/posts/{$encodedSlug}";

        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                ])
                ->get($url);

            if ($response->successful()) {
                $json = $response->json();
                return isset($json['data']) && is_array($json['data']) ? $json['data'] : (array) $json;
            }

            if ($response->status() === 404) {
                $all = $this->getPosts(1, 100);
                foreach ($all['data'] as $post) {
                    if (($post['slug'] ?? null) === $slug) {
                        return $post;
                    }
                }
                return null;
            }

            Log::warning("[Blog API] Error al consultar post '{$slug}' ({$response->status()})");
            return null;
        } catch (\Throwable $e) {
            Log::warning("[Blog API] Error de red para el post '{$slug}': " . $e->getMessage());
            return null;
        }
    }

    public static function normalizeHtmlContent(?string $content): string
    {
        if (empty($content)) {
            return '';
        }

        $cleaned = trim($content);

        if (preg_match('/&lt;\s*\/?\s*(p|h[1-6]|ul|ol|li|strong|em|b|i|a|br|hr|div|blockquote|span|img|table|tr|td|th)\b/i', $cleaned)) {
            $cleaned = str_replace(
                ['&lt;', '&gt;', '&quot;', '&#039;', '&amp;'],
                ['<', '>', '"', "'", '&'],
                $cleaned
            );
        }

        return $cleaned;
    }

    /**
     * Formatea fechas ISO-8601 a formato legible (ej. "October 13, 2026").
     */
    public static function formatPostDate(?string $dateStr): string
    {
        if (empty($dateStr)) {
            return '';
        }

        try {
            $date = \Carbon\Carbon::parse($dateStr);
            return $date->translatedFormat('F j, Y');
        } catch (\Throwable) {
            return '';
        }
    }
}
