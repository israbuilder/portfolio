<div>
    @include('livewire.portfolio.partials.navigation')

    <main class="pt-24 pb-20">
        @php
            $formattedDate = \App\Services\BlogService::formatPostDate($post['published_at'] ?? $post['created_at'] ?? null);
            $normalizedContent = \App\Services\BlogService::normalizeHtmlContent($post['content'] ?? '');
            $authorName = 'Israel Zepeda';
            $siteUrl = config('app.url', url('/'));
            $articleUrl = route('portfolio.blog.show', $post['slug']);

            $articleSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $post['title'],
                'description' => $post['seo']['meta_description'] ?? $post['excerpt'] ?? $post['title'],
                'image' => $featuredImage,
                'author' => [
                    '@type' => 'Person',
                    'name' => $authorName,
                    'url' => $siteUrl,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => $authorName,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('images/favicon.png'),
                    ],
                ],
                'mainEntityOfPage' => $articleUrl,
            ];

            if (!empty($post['published_at'])) {
                $articleSchema['datePublished'] = $post['published_at'];
            }
            if (!empty($post['updated_at'])) {
                $articleSchema['dateModified'] = $post['updated_at'];
            }

            $breadcrumbSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('portfolio.home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('portfolio.blog.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $post['title'], 'item' => $articleUrl],
                ],
            ];
        @endphp

        <!-- JSON-LD Structured Data for Search Engines -->
        <script type="application/ld+json">
            {!! json_encode([$articleSchema, $breadcrumbSchema], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        <!-- Article Header and Breadcrumbs -->
        <section class="section-shell !py-12 border-b border-white/10">
            <div class="max-w-4xl mx-auto">
                <nav aria-label="Breadcrumb" class="mb-6">
                    <ol class="flex flex-wrap items-center gap-2 text-xs font-semibold text-slate-400">
                        <li>
                            <a href="{{ route('portfolio.home') }}" class="hover:text-cyan-300 transition-colors">Home</a>
                        </li>
                        <li aria-hidden="true" class="text-slate-600">/</li>
                        <li>
                            <a href="{{ route('portfolio.blog.index') }}" class="hover:text-cyan-300 transition-colors">Blog</a>
                        </li>
                        <li aria-hidden="true" class="text-slate-600">/</li>
                        <li class="text-cyan-300 truncate max-w-[200px] sm:max-w-md" aria-current="page">
                            {{ $post['title'] }}
                        </li>
                    </ol>
                </nav>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">
                    {{ $post['title'] }}
                </h1>

                @if($formattedDate)
                    <div class="mt-6 flex flex-wrap items-center gap-4 text-sm text-slate-400">
                        <div class="flex items-center gap-2 text-cyan-300 font-medium">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                            </svg>
                            <time datetime="{{ $post['published_at'] ?? '' }}">{{ $formattedDate }}</time>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Article Body -->
        <article class="mx-auto max-w-4xl px-6 py-12">
            <!-- Featured Image -->
            @if(!empty($post['featured_image_url']))
                <div class="mb-10 rounded-3xl overflow-hidden border border-white/10 bg-slate-900 shadow-2xl">
                    <img
                        src="{{ $post['featured_image_url'] }}"
                        alt="{{ $post['title'] }}"
                        loading="eager"
                        class="w-full max-h-[520px] object-cover"
                    />
                </div>
            @endif

            <!-- Excerpt -->
            @if(!empty($post['excerpt']))
                <p class="text-xl font-medium leading-relaxed text-slate-300 border-l-4 border-cyan-300 pl-6 py-2 mb-10 italic bg-white/[0.02] rounded-r-2xl">
                    {{ $post['excerpt'] }}
                </p>
            @endif

            <!-- Content HTML -->
            @if(!empty($normalizedContent))
                <div class="prose max-w-none">
                    {!! $normalizedContent !!}
                </div>
            @else
                <p class="text-slate-400 italic">No additional content available for this article.</p>
            @endif

            <div class="mt-14 pt-8 border-t border-white/10">
                <a
                    href="{{ route('portfolio.blog.index') }}"
                    class="inline-flex items-center gap-2 font-bold text-cyan-300 hover:text-white transition-colors text-base"
                >
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    <span>Back to all articles</span>
                </a>
            </div>
        </article>
    </main>

    @include('livewire.portfolio.partials.footer')
</div>
