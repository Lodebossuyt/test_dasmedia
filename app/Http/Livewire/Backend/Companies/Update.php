<?php

namespace App\Http\Livewire\Backend\Companies;

use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    public $company;
    public $name;

    protected $rules = [
      'name'=>'required|min:3|unique:App\Models\Company,name',
    ];

    public function rules(){
        return [
          'name'=> [
            'required',
            'min:3',
              Rule::unique('companies')->ignore($this->company->id, 'id')
          ]
        ];
    }

    public function updatedCompanyName(){
        $this->validate(['name'=>'required|min:3|unique:App\Models\Company,name']);
    }

    public function updateCompany(){
        $this->validate();

        $this->company->name = $this->name;
        $this->company->update();

        $this->emit('refreshCompanies');
    }

    public function mount($company){
        $this->company = $company;
        $this->name = $company->name;
    }

    protected $listeners = ['updateCompany'];

    public function render()
    {
        return view('livewire.backend.companies.update');
    }
}
