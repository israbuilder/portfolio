import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('portfolioShell', () => ({
    mobileOpen: false,
    scrolled: false,
    showBackToTop: false,
    reduceMotion: false,
    observer: null,

    init() {
        this.reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const handleScroll = () => {
            this.scrolled = window.scrollY > 24;
            this.showBackToTop = window.scrollY > 700;
        };

        handleScroll();
        window.addEventListener('scroll', handleScroll, { passive: true });

        this.setupRevealObserver();

        document.addEventListener('livewire:navigated', () => this.setupRevealObserver());
        window.addEventListener('portfolio-filtered', () => {
            requestAnimationFrame(() => this.setupRevealObserver());
        });

        window.addEventListener('contact-sent', () => {
            document.querySelector('#contact')?.scrollIntoView({
                behavior: this.reduceMotion ? 'auto' : 'smooth',
                block: 'center',
            });
        });
    },

    setupRevealObserver() {
        this.observer?.disconnect();

        const elements = document.querySelectorAll('[data-reveal]:not(.is-visible)');

        if (this.reduceMotion || !('IntersectionObserver' in window)) {
            elements.forEach((element) => element.classList.add('is-visible'));
            return;
        }

        this.observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, {
            rootMargin: '0px 0px -8% 0px',
            threshold: 0.12,
        });

        elements.forEach((element, index) => {
            element.style.transitionDelay = `${Math.min(index % 4, 3) * 70}ms`;
            this.observer.observe(element);
        });
    },
}));

Alpine.data('tiltCard', () => ({
    style: 'transform: perspective(1000px) rotateX(0deg) rotateY(0deg)',

    tilt(event) {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        const rect = event.currentTarget.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width;
        const y = (event.clientY - rect.top) / rect.height;

        const rotateY = (x - 0.5) * 7;
        const rotateX = (0.5 - y) * 7;

        this.style = `transform: perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    },

    reset() {
        this.style = 'transform: perspective(1000px) rotateX(0deg) rotateY(0deg)';
    },
}));

Alpine.start();
