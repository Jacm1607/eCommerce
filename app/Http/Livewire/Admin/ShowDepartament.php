<?php

namespace App\Http\Livewire\Admin;

use App\Models\Departament;
use Livewire\Component;
use App\Models\Province;

class ShowDepartament extends Component
{
    protected $listeners = ['delete'];

    public $department, $provincies, $province;

    public $createForm = [
        'name' => '',
        'cost' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'cost' => null
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.cost' => 'costo'
    ];


    public function mount(Departament $department){
        $this->department = $department;
        $this->getProvicies();
    }

    public function getProvicies(){
        $this->provincies = Province::where('departament_id', $this->department->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required',
            "createForm.cost" => 'required|numeric|min:1|max:100',
        ]);

        $this->department->provincies()->create($this->createForm);


        $this->reset('createForm');

        $this->getProvicies();

        $this->emit('saved');
    }

    public function edit(Province $province){
        $this->province = $province;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $province->name;
        $this->editForm['cost'] = $province->cost;
    }

    public function update(){
        $this->province->name = $this->editForm['name'];
        $this->province->cost = $this->editForm['cost'];
        $this->province->save();

        $this->reset('editForm');
        $this->getProvicies();
    }


    // public function delete(province $province){
    //     $province->delete();
    //     $this->getProvicies();
    // }

    public function render()
    {
        return view('livewire.admin.show-departament')->layout('layouts.admin');
    }
}
