<header
    :class="scrolled ? 'border-white/10 bg-slate-950/80 shadow-2xl shadow-black/10 backdrop-blur-xl' : 'border-transparent bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 border-b transition-all duration-300"
>
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-8">
        <a href="#home" class="group inline-flex items-center gap-3">
            <span class="grid size-10 place-items-center rounded-2xl bg-gradient-to-br from-cyan-300 via-blue-400 to-violet-500 font-black text-slate-950 shadow-lg shadow-cyan-500/20 transition duration-300 group-hover:rotate-3 group-hover:scale-105 motion-reduce:transform-none">
                IZ
            </span>
            <span>
                <span class="block text-sm font-black tracking-[0.18em] text-white">ISRABUILDER</span>
                <span class="block text-[10px] uppercase tracking-[0.22em] text-slate-400">Marketing · AI · Software</span>
            </span>
        </a>

        <nav class="hidden items-center gap-8 md:flex">
            @foreach ([
                '#about' => 'About',
                '#services' => 'Services',
                '#work' => 'Work',
                '#experience' => 'Experience',
            ] as $href => $label)
                <a href="{{ $href }}" class="nav-link">{{ $label }}</a>
            @endforeach

            <a href="#contact" class="button-primary !px-5 !py-2.5">
                Start a project
            </a>
        </nav>

        <button
            @click="mobileOpen = !mobileOpen"
            :aria-expanded="mobileOpen"
            class="grid size-11 place-items-center rounded-xl border border-white/10 bg-white/[0.03] transition hover:border-cyan-300/30 md:hidden"
            aria-label="Toggle navigation"
        >
            <svg x-show="!mobileOpen" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
            <svg x-cloak x-show="mobileOpen" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m6 6 12 12M18 6 6 18"/>
            </svg>
        </button>
    </div>

    <div
        x-cloak
        x-show="mobileOpen"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-start="-translate-y-3 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-3 opacity-0"
        @click.outside="mobileOpen = false"
        class="border-t border-white/10 bg-slate-950/95 px-6 py-5 backdrop-blur-xl md:hidden"
    >
        <nav class="grid gap-2">
            @foreach ([
                '#about' => 'About',
                '#services' => 'Services',
                '#work' => 'Work',
                '#experience' => 'Experience',
                '#contact' => 'Contact',
            ] as $href => $label)
                <a @click="mobileOpen = false" href="{{ $href }}" class="mobile-nav-link">{{ $label }}</a>
            @endforeach
        </nav>
    </div>
</header>
