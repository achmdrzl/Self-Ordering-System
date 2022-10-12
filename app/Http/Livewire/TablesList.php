<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class TablesList extends Component
{

    public $table_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteConfirm',
        'showConfirmed' => 'showConfirm'
    ];

    public function render()
    {
        $customers = Customer::orderBy('no_table', 'ASC')->get();

        return view('livewire.tables-list', compact('customers'));
    }

    public function removeItem($id)
    {
        $this->table_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }

    public function showItem($id)
    {
        $this->table_id = $id;
        $this->dispatchBrowserEvent('show-table-confirm');
    }

    public function showConfirm()
    {
        $data = Customer::where('id', $this->table_id)->first();
        $data->update(['status' => 'Free']);

        $this->dispatchBrowserEvent('tableShowed');
    }

    public function deleteConfirm()
    {
        $data = Customer::where('id', $this->table_id)->first();
        $data->update(['status' => 'Unactive']);

        $this->dispatchBrowserEvent('tableDeleted');
    }
}
