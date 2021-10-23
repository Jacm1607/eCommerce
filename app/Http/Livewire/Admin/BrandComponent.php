<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;

use Livewire\WithPagination;

class BrandComponent extends Component
{
    use WithPagination;

    // public $brands;
    public $brand;
    protected $listeners = ['delete'];

    public $createForm=[
        'name' => null
    ];

    public $editForm=[
        'open' => false,
        'name' => null
    ];

    public $rules = [
        'createForm.name' => 'required'
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre'
    ];

    public function save(){
        $this->validate();
        Brand::create($this->createForm);
        $this->reset('createForm');
        $this->render();
    }

    public function edit(Brand $brand){
        $this->brand = $brand;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $brand->name;
    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required'
        ]);
        $this->brand->update($this->editForm);
        $this->reset('editForm');
        $this->render();
    }

    public function delete(Brand $brand){
        $brand->delete();
        $this->render();
    }

    public function render()
    {
        return view('livewire.admin.brand-component', ['brands' => Brand::paginate(10)])->layout('layouts.admin');
    }
}
