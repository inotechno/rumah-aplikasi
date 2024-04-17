<?php

namespace App\Http\Livewire;

use App\Models\Service as ModelsService;
use Livewire\Component;

class Service extends Component
{
    public function render()
    {
        $services = ModelsService::all();
        return view('livewire.service', compact('services'));
    }
}
