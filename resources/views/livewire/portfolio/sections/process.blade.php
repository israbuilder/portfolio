<section class="section-shell border-y border-white/10 bg-white/[0.02]">
    <div data-reveal class="max-w-3xl">
        <p class="eyebrow">Process</p>
        <h2 class="section-title">Clear strategy. Fast execution. Continuous optimization.</h2>
    </div>

    <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['01', 'Discover', 'Business goals, audience, market, competition and current performance.'],
            ['02', 'Design', 'Positioning, customer journey, campaign architecture, content and technical plan.'],
            ['03', 'Build', 'Websites, creative assets, tracking, integrations, automation and campaign launch.'],
            ['04', 'Optimize', 'Analyze performance, improve conversion rates and scale what creates value.'],
        ] as $step)
            <article data-reveal class="process-card group">
                <span class="text-sm font-black text-cyan-300">{{ $step[0] }}</span>
                <h3 class="mt-5 text-xl font-black text-white">{{ $step[1] }}</h3>
                <p class="mt-3 text-sm leading-6 text-slate-400">{{ $step[2] }}</p>
            </article>
        @endforeach
    </div>
</section>
