<?php

namespace App\Http\Livewire;

use App\Models\Partner as ModelsPartner;
use Livewire\Component;

class Partner extends Component
{
    public function render()
    {
        $partners = ModelsPartner::all();
        return view('livewire.partner', compact('partners'));
    }
}
