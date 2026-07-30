<section id="work" class="section-shell">
    <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
        <div data-reveal class="max-w-3xl">
            <p class="eyebrow">Selected work</p>
            <h2 class="section-title">Projects connecting business goals with digital execution.</h2>
        </div>

        <div data-reveal class="flex flex-wrap gap-2" role="group" aria-label="Filter projects">
            @foreach ($categories as $key => $label)
                <button
                    type="button"
                    wire:click="setCategory('{{ $key }}')"
                    wire:loading.attr="disabled"
                    @class([
                        'rounded-full px-4 py-2 text-sm font-bold transition duration-300',
                        'bg-cyan-300 text-slate-950 shadow-lg shadow-cyan-500/20' => $activeCategory === $key,
                        'border border-white/10 bg-white/[0.03] text-slate-300 hover:border-cyan-300/30 hover:text-white' => $activeCategory !== $key,
                    ])
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div
        wire:loading.class="opacity-50"
        wire:target="setCategory"
        class="mt-12 grid gap-7 transition-opacity lg:grid-cols-2"
    >
        @foreach ($projects as $project)
            <article
                wire:key="project-{{ Str::slug($project['name']) }}"
                data-reveal
                class="project-card group"
            >
                <div class="relative aspect-[16/9] overflow-hidden bg-gradient-to-br from-slate-800 to-slate-950">
                    <img
                        src="{{ asset($project['image']) }}"
                        alt="{{ $project['name'] }}"
                        width="1600"
                        height="900"
                        loading="lazy"
                        decoding="async"
                        class="h-full w-full object-cover opacity-80 transition duration-700 group-hover:scale-105 group-hover:opacity-100 motion-reduce:transform-none"
                        onerror="this.style.display='none'"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/10 to-transparent"></div>
                    <span class="absolute left-6 top-6 rounded-full border border-white/15 bg-slate-950/65 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-cyan-300 backdrop-blur">
                        {{ $project['category'] }}
                    </span>
                </div>

                <div class="p-7">
                    <h3 class="text-2xl font-black text-white">{{ $project['name'] }}</h3>
                    <p class="mt-4 leading-7 text-slate-400">{{ $project['description'] }}</p>
                    <p class="mt-5 text-sm font-bold text-cyan-300">{{ $project['result'] }}</p>

                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach ($project['tags'] as $tag)
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs text-slate-300">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
