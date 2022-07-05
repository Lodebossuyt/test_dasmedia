<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Vacature;
use Livewire\Component;
use Livewire\WithPagination;

class Welcome extends Component
{
    use WithPagination;

    public $title;

    public function updatedTitle(){
        $this->resetPage();
    }

    public function render()
    {
        $vacatures = Vacature::query()
            ->with('company')
            ->when($this->title, function($query){
            $query->where('title', 'LIKE' , '%' . $this->title . '%');
        })->paginate(125);
        return view('livewire.frontend.welcome', compact('vacatures'));
    }
}
