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
        if (auth()->user()->can('province.index')) {
            $this->department = $department;
            $this->getProvicies();
        } else {
            abort(403);
        }
    }

    public function getProvicies(){
        $this->provincies = Province::where('departament_id', $this->department->id)->get();
    }

    public function save(){
        if (auth()->user()->can('province.store')) {
            $this->validate([
                "createForm.name" => 'required',
                "createForm.cost" => 'required|numeric|min:1|max:100',
            ]);

            $this->department->provincies()->create($this->createForm);


            $this->reset('createForm');

            $this->getProvicies();

            $this->emit('saved');
        } else {
            abort(403);
        }

    }

    public function edit(Province $province){
        $this->province = $province;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $province->name;
        $this->editForm['cost'] = $province->cost;
    }

    public function update(){
        if (auth()->user()->can('province.update')) {
            $this->province->name = $this->editForm['name'];
            $this->province->cost = $this->editForm['cost'];
            $this->province->save();

            $this->reset('editForm');
            $this->getProvicies();
        } else {
            abort(403);
        }

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
