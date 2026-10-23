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

                <form
                    x-data="{
                        name: '',
                        email: '',
                        company: '',
                        service: '',
                        message: '',
                        errors: {},
                        success: false,
                        whatsappUrl: '',
                        validate() {
                            this.errors = {};
                            if (!this.name.trim()) this.errors.name = 'Please provide your name.';
                            if (!this.email.trim()) {
                                this.errors.email = 'Please provide your email address.';
                            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email.trim())) {
                                this.errors.email = 'Please provide a valid email address.';
                            }
                            if (!this.service) this.errors.service = 'Please select a service.';
                            if (!this.message.trim() || this.message.trim().length < 10) {
                                this.errors.message = 'Please provide at least 10 characters.';
                            } else if (this.message.trim().length > 1500) {
                                this.errors.message = 'Please keep your message under 1500 characters.';
                            }
                            return Object.keys(this.errors).length === 0;
                        },
                        handleSubmit() {
                            if (!this.validate()) return;

                            const serviceNames = {
                                'marketing': 'Marketing & Growth',
                                'web-development': 'Website / Software',
                                'ai-automation': 'AI Automation',
                                'multimedia': 'Video & Multimedia',
                                'consulting': 'Consulting'
                            };

                            const serviceLabel = serviceNames[this.service] || this.service;
                            const companyLabel = this.company.trim() || 'N/A';

                            const lines = [
                                'New project inquiry (israbuilder.com)',
                                '',
                                'Name: ' + this.name.trim(),
                                'Email: ' + this.email.trim(),
                                'Company: ' + companyLabel,
                                'Service: ' + serviceLabel,
                                '',
                                'Project details:',
                                this.message.trim()
                            ];

                            const rawText = lines.join('\n');
                            const encodedText = encodeURIComponent(rawText);

                            // Si es computadora de escritorio, abrir directo WhatsApp Web sin la pantalla intermedia
                            const isMobile = /Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);
                            const targetUrl = isMobile
                                ? 'https://api.whatsapp.com/send?phone=12817285637&text=' + encodedText
                                : 'https://web.whatsapp.com/send?phone=12817285637&text=' + encodedText;

                            this.whatsappUrl = targetUrl;

                            // Sincrónico: el navegador nunca abre 'about:blank' ni lo bloquea
                            window.open(targetUrl, '_blank', 'noopener,noreferrer');

                            this.success = true;
                            this.name = '';
                            this.email = '';
                            this.company = '';
                            this.service = '';
                            this.message = '';
                            this.errors = {};
                        }
                    }"
                    @submit.prevent="handleSubmit()"
                    class="rounded-3xl border border-white/10 bg-white/[0.035] p-6 sm:p-8"
                >
                    <template x-if="success">
                        <div
                            x-data="{ visible: true }"
                            x-show="visible"
                            x-init="setTimeout(() => visible = false, 15000)"
                            x-transition
                            class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 p-5 text-emerald-200"
                        >
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-white">Inquiry prepared!</p>
                                    <p class="mt-1 text-xs text-emerald-300/90">
                                        WhatsApp has been opened in a new tab. If it did not open automatically, click the button below:
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <a
                                    :href="whatsappUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-500 px-4 py-2 text-xs font-bold text-slate-950 transition hover:bg-emerald-400 shadow-md shadow-emerald-500/20"
                                >
                                    <svg class="size-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                    </svg>
                                    Continue to WhatsApp
                                </a>
                            </div>
                        </div>
                    </template>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <label class="field-group">
                            <span>Name</span>
                            <input x-model="name" type="text" autocomplete="name" class="field-input" placeholder="Your name">
                            <template x-if="errors.name">
                                <small class="text-rose-400" x-text="errors.name"></small>
                            </template>
                        </label>

                        <label class="field-group">
                            <span>Email</span>
                            <input x-model="email" type="email" autocomplete="email" class="field-input" placeholder="you@company.com">
                            <template x-if="errors.email">
                                <small class="text-rose-400" x-text="errors.email"></small>
                            </template>
                        </label>
                    </div>

                    <div class="mt-5 grid gap-5 sm:grid-cols-2">
                        <label class="field-group">
                            <span>Company</span>
                            <input x-model="company" type="text" autocomplete="organization" class="field-input" placeholder="Optional">
                        </label>

                        <label class="field-group">
                            <span>Primary need</span>
                            <select x-model="service" class="field-input">
                                <option value="">Select one</option>
                                <option value="marketing">Marketing & Growth</option>
                                <option value="web-development">Website / Software</option>
                                <option value="ai-automation">AI Automation</option>
                                <option value="multimedia">Video & Multimedia</option>
                                <option value="consulting">Consulting</option>
                            </select>
                            <template x-if="errors.service">
                                <small class="text-rose-400" x-text="errors.service"></small>
                            </template>
                        </label>
                    </div>

                    <label class="field-group mt-5">
                        <div class="flex items-center justify-between">
                            <span>Project details</span>
                            <span class="text-xs text-slate-500" x-text="message.length + '/1500'"></span>
                        </div>
                        <textarea x-model="message" maxlength="1500" rows="5" class="field-input resize-none" placeholder="What are you trying to achieve?"></textarea>
                        <template x-if="errors.message">
                            <small class="text-rose-400" x-text="errors.message"></small>
                        </template>
                    </label>

                    <button
                        type="submit"
                        class="button-primary mt-6 w-full"
                    >
                        <span>Send project inquiry</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
