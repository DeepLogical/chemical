<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Auth;
use Cookie;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

use Spatie\Permission\Models\Role;

use Mail;
use Deep\Admin\Mail\UserRegisteredMail;

class UserAuthModal extends Component
{
    use PasswordValidationRules;

    public $isOpen = 0, $roleOptions = [], $name, $email, $phone, $role, $password, $password_confirmation;

    public function render(){ return view('deep::livewire.parts.user-auth-modal')->layout('layouts.admin'); }

    public function register(){
        $input = [
            'name'                          => $this->name,
            'email'                         => $this->email,
            'phone'                         => $this->phone,
            'role'                          => $this->role,
            'password'                      => $this->password,
            'password_confirmation'         => $this->password_confirmation,
        ];

        Validator::make($input, [
            'name'                          => ['required', 'string', 'max:255'],
            'role'                          => ['required', 'string', 'max:255'],
            'phone'                         => ['required', 'unique:users'],
            'password'                      => $this->passwordRules(),
            'terms'                         => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // 'numeric', 'digits:10', 

        try{
            DB::transaction(function () use($input) {
                $last_id = optional( User::orderBy('id', 'DESC')->first() )->id;
                $new_id = encode( (int)$last_id + 1 );
                $referred_by_id = null;
                $refrence = Cookie::get('refrence');
                if($refrence){ 
                    $referred_by = User::select('id')->where('referral_code', $refrence)->first();
                    if($referred_by){
                        $referred_by_id = $referred_by->id;
                    }
                }
    
                $role           =   $this->role ? $this->role : 'user';
                
                $entry = User::create([
                    'name'                          =>  $this->name,
                    'email'                         =>  $this->email,
                    'phone'                         =>  $this->phone,
                    'wallet'                        =>  0,
                    'reward'                        =>  0,
                    'password'                      =>  Hash::make($this->password),
                    'referral_code'                 =>  'ChefsPoint-'.$new_id,
                    'referred_by'                   =>  $referred_by_id,
                    'email_verified_at'             =>  null
                ])->assignRole($role);
    
                if( $entry ){ Auth::loginUsingId($entry->id); }
                sendNotifications( "registration" );
                $this->closeModal();
    
                $this->dispatch('userRegistered');
    
                try{
                    Mail::to( $this->email)->send(new UserRegisteredMail( encode( $entry->id ) ));
                }catch (\Exception $e) {
                    \Log::warning("UserRegisteredMail Mail not sent ".$e->getMessage());
                }
                
                return redirect(route('home') );
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In Register Modal ".$e->getMessage() ); }
    }

    public function login(){
        $this->validate([
            'email'                     => 'required|email',
            'password'                  => 'required',
        ]);

        $user = User::where('email', $this->email)->first();

        if( !$user ){
            $this->dispatch('alert', ['type' => 'error',  'message' => 'No account by this name. Please register' ]);
            return;
        }

        if ( ! Hash::check($this->password, $user->password, []) ) {
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Wrong Credentials' ]);
            return;
        }

        Auth::loginUsingId($user->id, $remember = true);
        $this->closeModal();
        $this->dispatch('loggedIn');
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['openAuthModalCalled'];
    public function openAuthModalCalled( $role ){ 
        if( Auth::check() ){
            $this->dispatch('alert', ['type' => 'success',  'message' => "Already Logged in" ]);
            return;
        }

        $this->isOpen           =   1;

        if( $role ){
            $this->role         =   $role;
        }
    }

    private function resetInputFields(){
        $this->name                             =   null;
        $this->email                            =   null;
        $this->phone                            =   null;
        $this->role                             =   null;
        $this->password                         =   null;
        $this->password_confirmation            =   null;
        $this->isOpen                           =   false;
    }
}