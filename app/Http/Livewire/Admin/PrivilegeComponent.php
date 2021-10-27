<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PrivilegeComponent extends Component
{
    public $privileges;

    protected $rules = [
        'createForm.name' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
    ];

    public $createForm = [
        'name' => null,
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
    ];

    public function mount(){
       if (auth()->user()->can('privilege.index')) {
            $this->getPrivileges();
       } else {
           abort(403);
       }

    }

    public function getPrivileges(){
        $this->privileges = Permission::orderBy('name', 'asc')->get();
    }

    public function save(){
        if (auth()->user()->can('privilege.store')) {
            $this->validate();
            Permission::create(['name' => $this->createForm['name']]);
            $this->reset('createForm');
            $this->getPrivileges();
        } else {
            abort(403);
        }

    }

    public function edit($id){
        $privilege = Permission::findOrFail($id);
        $this->resetValidation();
        $this->privilege = $privilege;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $privilege->name;

    }

    public function update(){
        if (auth()->user()->can('privilege.update')) {
            $this->validate([
                'editForm.name' => 'required',
            ]);
            $this->privilege->update($this->editForm);
            $this->getPrivileges();
            $this->reset('editForm');
        } else {
            abort(403);
        }

    }
    public function render()
    {
        return view('livewire.admin.privilege-component')->layout('layouts.admin');
    }
}
