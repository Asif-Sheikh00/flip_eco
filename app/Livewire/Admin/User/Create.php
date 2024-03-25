<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;

class Create extends Component
{
    public $user_name, $user_email, $user_password, $user_status = 'active';

    public function render()
    {
        return view('livewire.admin.user.create');
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['user_name' => 'required'], ['user_name' => 'Bro jaruri h!!']);
    }

    public function store()
    {
        $this->validate(['user_name' => 'required'], ['user_name' => 'Bro jaruri h!!']);
        // dd($this->user_name, $this->user_email, $this->user_password, $this->user_status);
    }
}
