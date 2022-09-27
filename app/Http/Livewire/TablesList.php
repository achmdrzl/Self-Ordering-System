<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class TablesList extends Component
{

    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteConfirm'
    ];

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.tables-list', compact('customers'));
    }

    public function removeItem($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function deleteConfirm()
    {
        Customer::destroy($this->delete_id);

        $this->dispatchBrowserEvent('tableDeleted');

    }
}
