<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for SEO indexing.
     */
    public function __invoke(BlogService $blogService): Response
    {
        $baseUrl = rtrim(config('app.url', 'https://israbuilder.com'), '/');

        // Static canonical routes
        $urls = [
            [
                'loc' => $baseUrl . '/',
                'lastmod' => Carbon::now()->startOfDay()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => $baseUrl . '/blog',
                'lastmod' => Carbon::now()->startOfDay()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
        ];

        // Dynamic blog collection from CMS
        try {
            $postsResponse = $blogService->getPosts(1, 100);
            $posts = $postsResponse['data'] ?? [];

            foreach ($posts as $post) {
                if (empty($post['slug'])) {
                    continue;
                }

                // Skip non-published items if status field exists
                if (isset($post['status']) && $post['status'] !== 'published') {
                    continue;
                }

                $rawDate = $post['updated_at'] ?? $post['published_at'] ?? $post['created_at'] ?? null;
                $lastmod = $rawDate ? Carbon::parse($rawDate)->toAtomString() : Carbon::now()->startOfDay()->toAtomString();

                $urls[] = [
                    'loc' => $baseUrl . '/blog/' . rawurlencode($post['slug']),
                    'lastmod' => $lastmod,
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            }
        } catch (\Throwable) {
            // Failsafe: Continue with static routes if external blog API fails
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $item) {
            $xml .= "    <url>\n";
            $xml .= '        <loc>' . htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= '        <lastmod>' . htmlspecialchars($item['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= '        <changefreq>' . htmlspecialchars($item['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
            $xml .= '        <priority>' . htmlspecialchars($item['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
