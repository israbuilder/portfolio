<section id="experience" class="section-shell border-y border-white/10 bg-white/[0.02]">
    <div class="grid gap-12 lg:grid-cols-[.7fr_1.3fr]">
        <div data-reveal>
            <p class="eyebrow">Experience</p>
            <h2 class="section-title">A career at the intersection of communication and technology.</h2>
        </div>

        <div class="relative border-l border-white/10 pl-8">
            @foreach ($experience as $item)
                <article data-reveal class="relative pb-12 last:pb-0">
                    <span class="timeline-dot"></span>

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-black text-white">{{ $item['company'] }}</h3>
                            <p class="mt-1 font-semibold text-cyan-300">{{ $item['role'] }}</p>
                        </div>
                        <span class="text-sm font-bold text-slate-500">{{ $item['period'] }}</span>
                    </div>

                    <p class="mt-4 max-w-3xl leading-7 text-slate-400">{{ $item['summary'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
