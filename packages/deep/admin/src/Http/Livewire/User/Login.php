<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Login extends Component
{
    public $username, $password;

    public function submit(){
        $this->validate([
            'username'                      => 'required',
            'password'                      => 'required',
        ]);

        $user = User::where('email', $this->username)->orWhere('phone', $this->username)->first();

        if( !$user ){
            $this->dispatch('alert', ['type' => 'error',  'message' => 'No account by this name. Please register' ]);
            return;
        }

        if ( ! Hash::check($this->password, $user->password, []) ) {
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Wrong Credentials' ]);
            return;
        }

        Auth::loginUsingId($user->id, $remember = true);
        $this->dispatch('loggedIn');

        if(Auth::user()->hasRole([ 'owner'])){ return redirect(route('adminUsers') ); }
        if(Auth::user()->hasRole([ 'superadmin', 'admin', 'seo' ])){ return redirect(route('adminMeta') ); }

        return redirect(route('home') );
    }

    public function render(){ return view('deep::livewire.user.login')->layout('layouts.guest'); }
}