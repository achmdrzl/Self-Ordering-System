<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        $categories = Category::where('status', 'active')->get();
        return view('livewire.category-list', compact('categories'));
    }
}
