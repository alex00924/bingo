<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

new #[Layout('layouts.guest')] class extends Component
{
    public string $phone;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $validated = $this->validate([
            'phone' => ['required', 'regex:/\([0-9]{2}\)[0-9]{5}-[0-9]{4}/'],
        ]);

        $user = User::where('phone', $this->phone)->first();
        if (empty($user)) {
            $user = User::create([
                'phone' => $this->phone,
                'email' => $this->phone,
                'password' => Hash::make('123456789')
            ]);

            event(new Registered($user));
        }

        Auth::login($user);

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="phone" :value="__('TELEFONE')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" name="phone" required autofocus autocomplete="phone" placeholder="(__)_____-____"/>
            <x-input-error :messages="$errors->get('form.phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
</div>
