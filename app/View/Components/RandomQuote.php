<?php

namespace App\View\Components;

use App\Services\QuoteService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;
use function App\Services\QuoteService;

class RandomQuote extends Component
{
    public object|null $quote;

    public function __construct(
        protected QuoteService $quoteservice,
        public string $category
    ) {}

    public function render(): View|Closure|string
    {
        $this->fetchQuote();
        return view('components.random-quote');
    }

    private function fetchQuote(): void
    {
        $this->quote = $this->quoteservice->fetch($this->category);
    }
}
