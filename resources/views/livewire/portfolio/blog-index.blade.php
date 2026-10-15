<div>
    @include('livewire.portfolio.partials.navigation')

    <main class="pt-24 pb-20">
        <!-- Blog Hero Header -->
        <section class="section-shell !py-12 border-b border-white/10">
            <div class="max-w-4xl">
                <div class="inline-flex items-center gap-2 eyebrow">
                    <span class="inline-block size-2 rounded-full bg-cyan-300"></span>
                    Blog &amp; Articles
                </div>
                <h1 class="section-title mt-2">
                    Insights, Strategy &amp; Technology
                </h1>
                <p class="section-copy">
                    Articles, guides, and case studies on Digital Marketing, SEO, AI Automation, and Software Development.
                </p>
            </div>
        </section>

        <!-- Dynamic Articles Grid -->
        <section class="section-shell">
            @if(count($posts) > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        @php
                            $formattedDate = \App\Services\BlogService::formatPostDate($post['published_at'] ?? $post['created_at'] ?? null);
                            $imageUrl = $post['featured_image_url'] ?? null;
                        @endphp
                        <article class="project-card group flex flex-col transition-all duration-300 hover:border-cyan-300/40">
                            @if($imageUrl)
                                <a href="{{ route('portfolio.blog.show', $post['slug']) }}" class="block relative aspect-[16/10] overflow-hidden bg-slate-900">
                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $post['title'] }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                </a>
                            @endif

                            <div class="p-6 flex flex-col flex-1">
                                @if($formattedDate)
                                    <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-cyan-300 mb-3">
                                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                            <line x1="16" x2="16" y1="2" y2="6" />
                                            <line x1="8" x2="8" y1="2" y2="6" />
                                            <line x1="3" x2="21" y1="10" y2="10" />
                                        </svg>
                                        <time datetime="{{ $post['published_at'] ?? '' }}">{{ $formattedDate }}</time>
                                    </div>
                                @endif

                                <h2 class="text-xl font-bold text-white group-hover:text-cyan-300 transition-colors leading-snug">
                                    <a href="{{ route('portfolio.blog.show', $post['slug']) }}">
                                        {{ $post['title'] }}
                                    </a>
                                </h2>

                                @if(!empty($post['excerpt']))
                                    <p class="mt-3 text-sm text-slate-400 leading-relaxed line-clamp-3 flex-1">
                                        {{ $post['excerpt'] }}
                                    </p>
                                @endif

                                <div class="mt-6 pt-4 border-t border-white/10 flex items-center justify-between">
                                    <a
                                        href="{{ route('portfolio.blog.show', $post['slug']) }}"
                                        class="inline-flex items-center gap-2 text-sm font-bold text-cyan-300 hover:text-white transition-colors"
                                    >
                                        <span>Read article</span>
                                        <svg class="size-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M5 12h14" />
                                            <path d="m12 5 7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty state when no posts are available -->
                <div class="max-w-2xl mx-auto text-center py-20 px-6 rounded-3xl border border-white/10 bg-slate-900/40 backdrop-blur">
                    <div class="inline-grid size-14 place-items-center rounded-2xl bg-cyan-300/10 text-cyan-300 mb-4">
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                            <path d="M6 6h10"/>
                            <path d="M6 10h10"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">No articles available yet</h2>
                    <p class="mt-3 text-slate-400 leading-relaxed max-w-md mx-auto">
                        We are preparing new content for this section. Please check back soon or explore the main sections.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('portfolio.home') }}" class="button-secondary">
                            Back to home
                        </a>
                    </div>
                </div>
            @endif
        </section>
    </main>

    @include('livewire.portfolio.partials.footer')
</div>
