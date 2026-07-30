<section class="section-shell">
    <div class="grid gap-12 lg:grid-cols-[.8fr_1.2fr] lg:items-center">
        <div data-reveal>
            <p class="eyebrow">Toolkit</p>
            <h2 class="section-title">From strategy to measurable execution.</h2>
            <p class="section-copy">
                The advantage is not knowing one platform—it is understanding how the full system works together.
            </p>
        </div>

        <div data-reveal class="flex flex-wrap gap-3">
            @foreach ($tools as $tool)
                <span class="skill-pill">{{ $tool }}</span>
            @endforeach
        </div>
    </div>
</section>
