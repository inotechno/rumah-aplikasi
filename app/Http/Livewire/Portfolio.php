<?php

namespace App\Http\Livewire;

use App\Models\Portfolio as ModelsPortfolio;
use Livewire\Component;

class Portfolio extends Component
{
    public function render()
    {
        $portfolios = ModelsPortfolio::limit(6)->get();
        return view('livewire.portfolio', compact('portfolios'));
    }
}
