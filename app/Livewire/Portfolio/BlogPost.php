<?php

namespace App\Livewire\Portfolio;

use App\Services\BlogService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.portfolio')]
class BlogPost extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render(BlogService $blogService): View
    {
        $post = $blogService->getPostBySlug($this->slug);

        if (! $post) {
            abort(404);
        }

        $metaTitle = trim($post['seo']['meta_title'] ?? $post['title'] ?? 'Artículo');
        $seoTitle = "{$metaTitle} | Israel Zepeda";
        $seoDescription = trim($post['seo']['meta_description'] ?? $post['excerpt'] ?? ($post['title'] . ' — Israel Zepeda'));
        $featuredImage = $post['featured_image_url'] ?? asset('images/israbuilder.jpg');

        return view('livewire.portfolio.blog-post', [
            'post' => $post,
            'featuredImage' => $featuredImage,
        ])->layoutData([
            'title' => $seoTitle,
            'description' => $seoDescription,
            'image' => $featuredImage,
            'ogType' => 'article',
        ]);
    }
}
