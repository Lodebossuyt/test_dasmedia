<?php

namespace App\Http\Livewire\Backend;

use App\Exports\VacaturesExport;
use App\Models\Company;
use App\Models\Vacature;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{

    use WithPagination;

    /**modals**/
    public $showVacatureDeleteModal = false;
    public $showVacatureModal = false;
    public $showCompanyModal = false;


    /**vacature**/
    public $currentVacature;

    public $name;
    public $company;
    public $apply;
    public $label;

    /**filter**/
    public $title;

    /**validatie**/
    /*protected $rules = [
        'name'=>'required|min:6|unique:App\Models\Vacature,title',
        'company'=>'required',
        'apply'=>'required',
        'label'=>'required',
    ];*/

    protected function rules()
    {
        return [
            'name'=> [
                'required',
                'min:6',
                'unique:App\Models\Vacature,title,' . $this->currentVacature->id,
            ],
            'company'=>'required',
            'apply'=>'required',
            'label'=>'required',
        ];
    }

    /**live validatie**/
    public function updatedName(){
        $this->validate(['name'=>'required|min:6|unique:App\Models\Vacature,title']);
    }
    public function updatedCompany(){
        $this->validate(['company'=>'required']);
    }
    public function updatedApply(){
        $this->validate(['apply'=>'required']);
    }
    public function updatedLabel(){
        $this->validate(['label'=>'required']);
    }

    /**toggle update**/
    public $isUpdate = false;


    public function mount(){
        $this->currentVacature = new Vacature;
    }

    public function createVacatureModal(){
        $this->isUpdate = false;

        $this->name = '';
        $this->company = '';
        $this->apply = '';
        $this->label = '';

        $this->showVacatureModal = true;
    }

    public function createVacature(){
        $this->validate();

        Vacature::create([
            'title'=>$this->name,
            'company_id'=>$this->company,
            'apply'=>$this->apply,
            'label'=>$this->label,
        ]);
        $this->name = '';
        $this->company = '';
        $this->apply = '';
        $this->label = '';

        $this->showVacatureModal = false;
    }

    public function editVacatureModal(Vacature $vacature){
        $this->currentVacature = $vacature;

        $this->isUpdate = true;

        $this->showVacatureModal = true;

        $this->name = $vacature->title;
        $this->company = $vacature->company->id;
        $this->apply = $vacature->apply;
        $this->label = $vacature->label;
    }

    public function editVacature(){
        $this->validate();

        $this->currentVacature->title = $this->name;
        $this->currentVacature->company_id = $this->company;
        $this->currentVacature->apply = $this->apply;
        $this->currentVacature->label = $this->label;

        $this->currentVacature->update();

        $this->showVacatureModal = false;
    }

    public function deleteVacatureModal(Vacature $vacature){
        $this->currentVacature = $vacature;
        $this->showVacatureDeleteModal = true;
    }

    public function deleteVacature(Vacature $vacature){
        $this->showVacatureDeleteModal = false;
        $vacature->delete();
        $this->currentVacature = new Vacature;

    }

    /**Company**/
    public function createCompanyModal(){
        $this->showCompanyModal = true;
    }

    /**export csv**/

    public function export()
    {
        return Excel::download(new VacaturesExport, 'vacatures.csv');
    }

    public function render()
    {
        $companies = Company::all();
        $vacatures = Vacature::when($this->title, function($query){
            $query->where('title', 'LIKE' , '%' . $this->title . '%');
        })->paginate(125, ['*'], 'vacaturesPage');
        return view('livewire.backend.index', compact('vacatures', 'companies'));
    }
}
