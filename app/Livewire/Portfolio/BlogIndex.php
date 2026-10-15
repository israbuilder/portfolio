<?php

namespace App\Livewire\Portfolio;

use App\Services\BlogService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.portfolio')]
class BlogIndex extends Component
{
    public int $page = 1;
    public int $perPage = 12;

    public function render(BlogService $blogService): View
    {
        $response = $blogService->getPosts($this->page, $this->perPage);

        return view('livewire.portfolio.blog-index', [
            'posts' => $response['data'] ?? [],
            'meta' => $response['meta'] ?? [],
        ])->layoutData([
            'title' => 'Blog | Israel Zepeda',
            'description' => 'Guides, articles, insights, and strategies on digital marketing, artificial intelligence, and software development.',
        ]);
    }
}
