<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Departament;

class DepartamentComponent extends Component
{
    public $departments, $department;

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => ''
    ];

    public $editForm = [
        'open' => false,
        'name' => ''
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre'
    ];

    public function mount(){
        if (auth()->user()->can('departament.index')) {
            $this->getDepartments();
        } else {
            abort(403);
        }
    }

    public function getDepartments(){
        $this->departments = Departament::all();
    }

    public function save(){
        if (auth()->user()->can('departament.store')) {
            $this->validate([
                "createForm.name" => 'required'
            ]);

            Departament::create($this->createForm);

            $this->reset('createForm');

            $this->getDepartments();

            $this->emit('saved');
        } else {
            abort(403);
        }
    }

    public function edit(Departament $department){
        $this->department = $department;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $department->name;
    }

    public function update(){
        if (auth()->user()->can('departament.update')) {
            $this->department->name = $this->editForm['name'];
            $this->department->save();
            $this->reset('editForm');
            $this->getDepartments();
        } else {
            abort(403);
        }
    }
    // public function delete(Departament $department){
    //     $department->delete();
    //     $this->getDepartments();
    // }

    public function render()
    {
        return view('livewire.admin.departament-component')->layout('layouts.admin');
    }
}
