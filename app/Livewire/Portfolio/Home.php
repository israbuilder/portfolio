<?php

namespace App\Livewire\Portfolio;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('components.layouts.portfolio')]
class Home extends Component
{
    public string $activeCategory = 'all';

    public string $name = '';
    public string $email = '';
    public string $company = '';
    public string $service = '';
    public string $message = '';

    public bool $messageSent = false;

    #[Locked]
    public array $categories = [
        'all' => 'All work',
        'marketing' => 'Marketing',
        'software' => 'Software',
        'multimedia' => 'Multimedia',
    ];

    public function setCategory(string $category): void
    {
        if (! array_key_exists($category, $this->categories)) {
            return;
        }

        $this->activeCategory = $category;
        $this->dispatch('portfolio-filtered');
    }

    public function submitContact(): void
    {
        $key = 'portfolio-contact:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 4)) {
            $seconds = RateLimiter::availableIn($key);

            $this->addError('form', "Please wait {$seconds} seconds before trying again.");

            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'max:160'],
            'company' => ['nullable', 'string', 'max:120'],
            'service' => ['required', 'in:marketing,web-development,ai-automation,multimedia,consulting'],
            'message' => ['required', 'string', 'min:20', 'max:2000'],
        ]);

        RateLimiter::hit($key, 60);

        /*
         * Replace this log-only implementation with Mail::to(...)->send(...)
         * or persist the lead in your CRM/database.
         */
        logger()->info('Portfolio contact request', $validated);

        $this->reset(['name', 'email', 'company', 'service', 'message']);
        $this->messageSent = true;
        $this->resetValidation();

        $this->dispatch('contact-sent');
    }

    public function getFilteredProjectsProperty(): array
    {
        $projects = $this->projects();

        if ($this->activeCategory === 'all') {
            return $projects;
        }

        return array_values(array_filter(
            $projects,
            fn (array $project): bool => in_array($this->activeCategory, $project['categories'], true)
        ));
    }

    public function render(): View
    {
        return view('livewire.portfolio.home', [
            'services' => $this->services(),
            'projects' => $this->filteredProjects,
            'experience' => $this->experience(),
            'tools' => $this->tools(),
        ]);
    }

    private function services(): array
    {
        return [
            [
                'title' => 'Growth Marketing',
                'description' => 'Data-driven strategies focused on qualified leads, conversion rates, occupancy, revenue and measurable growth.',
                'icon' => 'chart',
            ],
            [
                'title' => 'SEO & Local Search',
                'description' => 'Technical SEO, content strategy, Search Console, Google Business Profile and local-market visibility.',
                'icon' => 'search',
            ],
            [
                'title' => 'Paid Media',
                'description' => 'Google Ads and Meta Ads strategy, landing pages, attribution, conversion tracking and budget optimization.',
                'icon' => 'cursor',
            ],
            [
                'title' => 'Web & Product Development',
                'description' => 'Fast websites, customer portals, CRM integrations, WordPress, Laravel, Livewire, React and Next.js.',
                'icon' => 'code',
            ],
            [
                'title' => 'AI Automation',
                'description' => 'AI-assisted content, lead qualification, reporting, customer communication and business workflows.',
                'icon' => 'sparkles',
            ],
            [
                'title' => 'Video & Creative',
                'description' => 'Commercial video, motion graphics, social content, Premiere Pro, After Effects, Photoshop and Canva.',
                'icon' => 'video',
            ],
        ];
    }

    private function projects(): array
    {
        return [
            [
                'name' => 'Law Offices of Manuel Solis',
                'category' => 'Legal Marketing & Technology',
                'categories' => ['marketing', 'software'],
                'description' => 'Audited and optimized Google Ads, conversion tracking, landing pages, CRM workflows, marketing automation and internal client technology.',
                'result' => '$200K+ monthly advertising budget',
                'image' => 'images/projects/manuel-solis.jpg',
                'tags' => ['Google Ads', 'Analytics', 'CRM', 'Automation', 'Laravel'],
            ],
            [
                'name' => 'Mariners Insurance',
                'category' => 'Insurance Technology',
                'categories' => ['marketing', 'software'],
                'description' => 'Built a bilingual auto-insurance rater and health-insurance application designed to generate and qualify leads in English and Spanish.',
                'result' => 'Bilingual acquisition platform',
                'image' => 'images/projects/mariners-insurance.jpg',
                'tags' => ['Insurance Rater', 'SEO', 'Lead Generation', 'Bilingual'],
            ],
            [
                'name' => 'Marietas Islands',
                'category' => 'Tourism & Hospitality',
                'categories' => ['marketing', 'multimedia'],
                'description' => 'Created the brand, WordPress website, online reservations, payments, U.S.-focused organic SEO, OTA presence and reputation strategy.',
                'result' => 'Organic positioning in the U.S.',
                'image' => 'images/projects/marietas-islands.jpg',
                'tags' => ['WordPress', 'SEO', 'Bookings', 'Payments', 'OTAs'],
            ],
            [
                'name' => 'AI Food Service',
                'category' => 'SaaS & ERP',
                'categories' => ['software'],
                'description' => 'Wholesale food-distribution ERP with customers, inventory, pricing, orders, invoicing, purchasing, delivery and AI-assisted ordering.',
                'result' => 'End-to-end distribution platform',
                'image' => 'images/projects/ai-food-service.jpg',
                'tags' => ['Laravel', 'Livewire', 'Filament', 'PostgreSQL', 'AI'],
            ],
            [
                'name' => 'Empire Torque Tools ERP',
                'category' => 'Industrial Rental Software',
                'categories' => ['software'],
                'description' => 'Multi-location rental platform for equipment assets, quotes, deliveries, returns, inspections, maintenance and certifications.',
                'result' => 'Connected rental operations',
                'image' => 'images/projects/empire-torque.jpg',
                'tags' => ['ERP', 'Laravel', 'Livewire', 'PostgreSQL'],
            ],
            [
                'name' => 'Hospitality & Real Estate',
                'category' => 'Hotel / RE/MAX Bahía',
                'categories' => ['marketing', 'multimedia'],
                'description' => 'Developed websites, booking and payment experiences, SEO, property promotion, visual content and online lead generation.',
                'result' => 'Direct bookings and property leads',
                'image' => 'images/projects/hospitality-real-estate.jpg',
                'tags' => ['Hospitality', 'Real Estate', 'SEO', 'WordPress'],
            ],
        ];
    }

    private function experience(): array
    {
        return [
            [
                'company' => 'Law Offices of Manuel Solis',
                'role' => 'Digital Marketing & Technology',
                'period' => '2023–2026',
                'summary' => 'Led initiatives spanning Google Ads, websites, attribution, CRM workflows, marketing automation, cloud infrastructure and internal software.',
            ],
            [
                'company' => 'Xencar',
                'role' => 'Multimedia & Digital Marketing Manager',
                'period' => '2012–2023',
                'summary' => 'Developed websites, SEO strategies, digital campaigns, video, motion graphics, brand systems, analytics and marketing technology.',
            ],
            [
                'company' => 'Independent Projects',
                'role' => 'Growth Marketing, Web & AI Consultant',
                'period' => 'Ongoing',
                'summary' => 'Built and promoted projects across tourism, hospitality, insurance, healthcare, finance, real estate, SaaS and industrial services.',
            ],
        ];
    }

    private function tools(): array
    {
        return [
            'Google Ads', 'Google Analytics 4', 'Search Console', 'Google Business Profile',
            'Meta Business Suite', 'WordPress', 'Laravel', 'Livewire', 'Filament',
            'React', 'Next.js', 'Tailwind CSS', 'PostgreSQL', 'MongoDB',
            'Adobe Premiere Pro', 'After Effects', 'Photoshop', 'Illustrator',
            'Canva', 'OpenAI', 'Marketing Automation', 'CRM Integrations',
        ];
    }
}
