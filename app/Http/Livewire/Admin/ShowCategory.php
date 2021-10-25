<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowCategory extends Component
{
    use WithFileUploads;
    public $category, $subcategories, $subcategory, $rand;

    protected $listeners = ['delete'];

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:subcategories,slug',
        'createForm.image' => 'required|image|max:1024',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.image' => 'imagen',
    ];

    public $editImage;

    public $createForm = [
        'name' => null,
        'slug' => null,
        'image' => null
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'image' => null,
    ];

    public function mount(Category $category){
        $this->category = $category;
        $this->getSubcategories();
        $this->rand = rand();
    }

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value){
        $this->editForm['slug'] = Str::slug($value);
    }

    public function getSubcategories(){
        $this->subcategories = Subcategory::where('category_id', $this->category->id)->where('subcategory_status','1')->get();
    }

    public function save(){
        $this->validate();
        $image = $this->createForm['image']->store('public/subcategories');
        $this->category->subcategories()->create(
            [
                'name' => $this->createForm['name'],
                'slug' => $this->createForm['slug'],
                'image' => $image
            ]
        );
        $this->reset('createForm');
        $this->getSubcategories();
    }

    public function edit($id){
        $subcategory = Subcategory::findOrFail($id);
        $this->resetValidation();

        $this->subcategory = $subcategory;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $subcategory->name;
        $this->editForm['slug'] = $subcategory->slug;
        $this->editForm['image'] = $subcategory->image;

    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:subcategories,slug,' . $this->subcategory->id,
        ]);
        if ($this->editImage) {
            $rules['editImage'] = 'required|image|max:1024';
        }
        $this->validate($rules);
        if ($this->editImage) {
            Storage::delete($this->editForm['image']);
            $this->editForm['image'] = $this->editImage->store('public/categories');
        }
        $this->subcategory->update($this->editForm);

        $this->getSubcategories();
        $this->reset('editForm');

    }

    public function delete($id){
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update(['subcategory_status' => '0']);
        $this->getSubcategories();
    }

    public function render()
    {
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
