<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#020617">

    <title>{{ $title ?? 'Israel Zepeda | Digital Marketing, Growth, AI & Software' }}</title>
    <meta name="description" content="Senior Digital Marketing & Growth Manager specializing in SEO, Google Ads, AI automation, multimedia and software development.">

    <meta property="og:title" content="Israel Zepeda | Digital Marketing, Growth, AI & Software">
    <meta property="og:description" content="Marketing strategy, AI automation, video production and software built around measurable business growth.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/israel-zepeda-og.jpg') }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    x-data="portfolioShell"
    x-init="init()"
    class="min-h-screen overflow-x-hidden bg-slate-950 text-slate-100 antialiased selection:bg-cyan-300 selection:text-slate-950"
>
    <div class="pointer-events-none fixed inset-0 -z-20 overflow-hidden">
        <div class="aurora aurora-one"></div>
        <div class="aurora aurora-two"></div>
        <div class="absolute inset-0 bg-grid opacity-[0.035]"></div>
    </div>

    {{ $slot }}

    <button
        x-cloak
        x-show="showBackToTop"
        x-transition.opacity
        @click="window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' })"
        class="fixed bottom-6 right-6 z-50 grid size-12 place-items-center rounded-full border border-white/10 bg-slate-900/85 text-white shadow-2xl backdrop-blur-xl transition hover:-translate-y-1 hover:border-cyan-300/40 hover:text-cyan-300 motion-reduce:transform-none"
        aria-label="Back to top"
    >
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    @livewireScripts
</body>
</html>
