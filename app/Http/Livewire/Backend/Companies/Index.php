<?php

namespace App\Http\Livewire\Backend\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $name;

    protected $listeners = ['refreshCompanies'=>'$refresh'];

    protected $rules = [
        'name'=> 'required|min:3|unique:App\Models\Company,name',
    ];

    public function updatedName(){
        $this->validate(['name'=>'required|min:3|unique:App\Models\Company,name']);
    }

    public function createCompany(){
        $this->validate();

        Company::create([
           'name'=>$this->name,
        ]);
        $this->name = '';
    }

    public function deleteCompany(Company $company){
        $company->delete();

        $company->vacatures()->delete();
    }

    public function render()
    {
        $companies = Company::paginate(5, ['*'], 'companiesPage');
        return view('livewire.backend.companies.index', compact('companies'));
    }
}
