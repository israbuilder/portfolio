<section id="contact" class="section-shell">
    <div data-reveal class="contact-shell">
        <div class="contact-inner">
            <div class="absolute right-[-8rem] top-[-9rem] size-[25rem] rounded-full bg-cyan-400/10 blur-3xl"></div>

            <div class="relative grid gap-12 lg:grid-cols-[.9fr_1.1fr]">
                <div>
                    <p class="eyebrow">Let’s build something valuable</p>
                    <h2 class="text-4xl font-black tracking-[-0.04em] text-white sm:text-5xl">
                        Need stronger marketing, a better website or an AI-powered system?
                    </h2>
                    <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">
                        Share your goal, the current challenge and the result you want to achieve.
                    </p>

                    <div class="mt-8 space-y-3 text-sm text-slate-400">
                        <a href="mailto:xencarmarketing@gmail.com" class="block transition hover:text-cyan-300">xencarmarketing@gmail.com</a>
                        <a href="tel:+12817285637" class="block transition hover:text-cyan-300">+1 281 728 5637</a>
                        <p>Houston, Texas</p>
                    </div>
                </div>

                <form wire:submit="submitContact" class="rounded-3xl border border-white/10 bg-white/[0.035] p-6 sm:p-8">
                    @if ($messageSent)
                        <div
                            x-data="{ visible: true }"
                            x-show="visible"
                            x-init="setTimeout(() => visible = false, 6000)"
                            x-transition
                            class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 p-4 text-sm text-emerald-200"
                        >
                            Thank you. Your message was received successfully.
                        </div>
                    @endif

                    @error('form')
                        <div class="mb-6 rounded-2xl border border-rose-400/20 bg-rose-400/10 p-4 text-sm text-rose-200">{{ $message }}</div>
                    @enderror

                    <div class="grid gap-5 sm:grid-cols-2">
                        <label class="field-group">
                            <span>Name</span>
                            <input wire:model.blur="name" type="text" autocomplete="name" class="field-input" placeholder="Your name">
                            @error('name') <small>{{ $message }}</small> @enderror
                        </label>

                        <label class="field-group">
                            <span>Email</span>
                            <input wire:model.blur="email" type="email" autocomplete="email" class="field-input" placeholder="you@company.com">
                            @error('email') <small>{{ $message }}</small> @enderror
                        </label>
                    </div>

                    <div class="mt-5 grid gap-5 sm:grid-cols-2">
                        <label class="field-group">
                            <span>Company</span>
                            <input wire:model.blur="company" type="text" autocomplete="organization" class="field-input" placeholder="Optional">
                            @error('company') <small>{{ $message }}</small> @enderror
                        </label>

                        <label class="field-group">
                            <span>Primary need</span>
                            <select wire:model.blur="service" class="field-input">
                                <option value="">Select one</option>
                                <option value="marketing">Marketing & Growth</option>
                                <option value="web-development">Website / Software</option>
                                <option value="ai-automation">AI Automation</option>
                                <option value="multimedia">Video & Multimedia</option>
                                <option value="consulting">Consulting</option>
                            </select>
                            @error('service') <small>{{ $message }}</small> @enderror
                        </label>
                    </div>

                    <label class="field-group mt-5">
                        <span>Project details</span>
                        <textarea wire:model.blur="message" rows="5" class="field-input resize-none" placeholder="What are you trying to achieve?"></textarea>
                        @error('message') <small>{{ $message }}</small> @enderror
                    </label>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="submitContact"
                        class="button-primary mt-6 w-full disabled:cursor-wait disabled:opacity-60"
                    >
                        <span wire:loading.remove wire:target="submitContact">Send project inquiry</span>
                        <span wire:loading wire:target="submitContact">Sending…</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
