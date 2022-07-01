<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Vacature;
use Livewire\Component;
use Livewire\WithPagination;

class Company extends Component
{
    public $title;

    protected $company;

    use WithPagination;

    public function mount($id){
        $company = \App\Models\Company::findOrFail($id);
        $this->company = $company;
    }

    public function render()
    {
        $vacatures = Vacature::where('company_id', $this->company->id)->when($this->title, function($query){
            $query->orWhere('title', 'LIKE' , '%' . $this->title . '%');
        })->paginate(125);
        return view('livewire.frontend.company',
            ['company'=>$this->company, 'vacatures'=>$vacatures])
            ->extends('components.frontend', ['header'=>$this->company->name]);
    }
}
