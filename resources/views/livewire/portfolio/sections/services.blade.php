<section id="services" class="section-shell border-y border-white/10 bg-white/[0.02]">
    <div data-reveal class="max-w-3xl">
        <p class="eyebrow">Capabilities</p>
        <h2 class="section-title">One partner across marketing, creative and technology.</h2>
        <p class="section-copy">
            Strategy and hands-on execution in one connected workflow—without adding unnecessary JavaScript or heavy animation libraries.
        </p>
    </div>

    <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($services as $service)
            <article
                data-reveal
                class="service-card group"
            >
                <div class="service-icon">
                    @switch($service['icon'])
                        @case('chart')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19V9m6 10V5m6 14v-7m4 7H2"/></svg>
                            @break
                        @case('search')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                            @break
                        @case('cursor')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m4 4 7.5 16 2-6.5L20 11 4 4Z"/></svg>
                            @break
                        @case('code')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m8 9-3 3 3 3m8-6 3 3-3 3m-3-9-2 12"/></svg>
                            @break
                        @case('sparkles')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 3 1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5L12 3Z"/><path d="m19 15 .8 2.2L22 18l-2.2.8L19 21l-.8-2.2L16 18l2.2-.8L19 15Z"/></svg>
                            @break
                        @case('video')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="13" height="12" rx="2"/><path d="m16 10 5-3v10l-5-3"/></svg>
                            @break
                    @endswitch
                </div>

                <h3 class="mt-6 text-xl font-black text-white">{{ $service['title'] }}</h3>
                <p class="mt-3 leading-7 text-slate-400">{{ $service['description'] }}</p>

                <div class="mt-6 h-px w-12 bg-gradient-to-r from-cyan-300 to-transparent transition-all duration-500 group-hover:w-full"></div>
            </article>
        @endforeach
    </div>
</section>
