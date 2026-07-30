<section id="home" class="relative overflow-hidden pt-32 sm:pt-36">
    <div class="mx-auto grid max-w-7xl items-center gap-14 px-6 pb-24 pt-8 lg:grid-cols-[1.12fr_.88fr] lg:px-8 lg:pb-32">
        <div class="relative z-10">
            <div
                data-reveal
                class="mb-6 inline-flex items-center gap-2 rounded-full border border-cyan-300/20 bg-cyan-300/[0.06] px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-cyan-300"
            >
                <span class="size-2 animate-pulse rounded-full bg-cyan-300 shadow-[0_0_18px_rgba(103,232,249,.9)] motion-reduce:animate-none"></span>
                Houston · Open to selected opportunities
            </div>

            <h1 data-reveal class="max-w-5xl text-5xl font-black leading-[.96] tracking-[-0.06em] text-white sm:text-6xl lg:text-[5rem]">
                Marketing, creative and technology built to
                <span class="animated-gradient-text">generate growth.</span>
            </h1>

            <p data-reveal class="mt-7 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                Senior Digital Marketing & Growth Manager combining SEO, paid media, analytics,
                AI automation, multimedia production and full-stack product development.
            </p>

            <div data-reveal class="mt-9 flex flex-col gap-4 sm:flex-row">
                <a href="#work" class="button-primary">
                    View selected work
                    <svg class="size-4 transition group-hover:translate-x-1 motion-reduce:transform-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6"/>
                    </svg>
                </a>

                <a href="#contact" class="button-secondary">
                    Discuss a project
                </a>
            </div>

            <div data-reveal class="mt-12 grid max-w-2xl grid-cols-3 gap-3">
                <div class="metric-card">
                    <strong>10+</strong>
                    <span>Years of experience</span>
                </div>
                <div class="metric-card">
                    <strong>$200K+</strong>
                    <span>Monthly media budget audited</span>
                </div>
                <div class="metric-card">
                    <strong>360°</strong>
                    <span>Marketing + creative + technology</span>
                </div>
            </div>
        </div>

        <div data-reveal class="relative mx-auto w-full max-w-lg lg:ml-auto">
            <div class="absolute -inset-10 rounded-[3rem] bg-gradient-to-br from-cyan-400/15 via-blue-500/10 to-violet-500/15 blur-3xl"></div>

            <div
                x-data="tiltCard"
                @mousemove="tilt($event)"
                @mouseleave="reset()"
                :style="style"
                class="relative will-change-transform motion-reduce:transform-none"
            >
                <div class="relative overflow-hidden rounded-[2.5rem] border border-white/10 bg-white/[0.055] p-3 shadow-2xl shadow-black/40 backdrop-blur">
                    <div class="absolute inset-x-10 top-0 h-px bg-gradient-to-r from-transparent via-cyan-300 to-transparent"></div>

                    <img
                        src="{{ asset('images/israel-zepeda.jpg') }}"
                        alt="Israel Zepeda"
                        width="1200"
                        height="1500"
                        fetchpriority="high"
                        class="aspect-[4/5] w-full rounded-[2rem] object-cover object-top"
                    >

                    <div class="absolute bottom-7 left-7 right-7 rounded-2xl border border-white/10 bg-slate-950/80 p-5 shadow-xl backdrop-blur-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-300">Current focus</p>
                        <p class="mt-2 font-semibold text-white">Growth marketing, AI-powered content, SaaS and business automation.</p>
                    </div>
                </div>
            </div>

            <div class="floating-badge -left-5 top-16 hidden sm:block">
                <p class="text-xs text-slate-400">Core strength</p>
                <p class="mt-1 font-bold text-white">Strategy + Execution</p>
            </div>
        </div>
    </div>
</section>
