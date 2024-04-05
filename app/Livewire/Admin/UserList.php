<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;
 
    public function render()
    {
        $users = User::where('id', '>', 1)->paginate(10);

        return view('livewire.admin.user-list', ['users' => $users])->layout('layouts.admin');
    }
}
