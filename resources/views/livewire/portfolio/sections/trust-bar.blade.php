<section class="border-y border-white/10 bg-white/[0.02]">
    <div class="mx-auto max-w-7xl overflow-hidden px-6 py-7 lg:px-8">
        <div class="marquee-mask">
            <div class="marquee-track motion-reduce:animate-none">
                @foreach (array_merge(
                    ['Legal', 'Insurance', 'Hospitality', 'Real Estate', 'Healthcare', 'SaaS', 'Industrial'],
                    ['Legal', 'Insurance', 'Hospitality', 'Real Estate', 'Healthcare', 'SaaS', 'Industrial']
                ) as $industry)
                    <span class="mx-7 whitespace-nowrap text-xs font-black uppercase tracking-[0.22em] text-slate-500">
                        {{ $industry }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</section>
