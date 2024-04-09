<?php

namespace App\Livewire\Admin;

use App\Livewire\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Builder;

class OrderList extends Component
{
    use WithPagination;
    public $cardFilter = '';

    public function filterCards() {
        $this->resetPage();
    }

    public function clearData() {
        Orders::query()->truncate();
        OrderDetails::query()->truncate();
        $this->reset();
    }

    public function render()
    {
        $orders = Orders::paginate(10);
        if (!empty($this->cardFilter)) {
            $orders = Orders::whereHas('orderDetails', function (Builder $query) {
                $query->whereHas('bingoCard', function (Builder $query) {
                    $query->where('card_number', 'like', "%" . $this->cardFilter . "%");
                });
            })->paginate(10);
        }

        return view('livewire.admin.order-list', ['orders' => $orders])->layout('layouts.admin');
    }
}
