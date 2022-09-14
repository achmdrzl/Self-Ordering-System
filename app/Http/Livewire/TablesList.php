<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class TablesList extends Component
{
    public function render()
    {
        $customers = Customer::all();
        return view('livewire.tables-list', compact('customers'));
    }

    public function removeItem($id)
    {
        Customer::destroy($id);
    }


}
