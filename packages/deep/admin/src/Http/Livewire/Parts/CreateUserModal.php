<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Auth;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;

class CreateUserModal extends Component
{
    use PasswordValidationRules;

    public $redirect = 0, $isOpen, $heading = "Create User Here", $show_roles = 1, $name, $email, $phone, $role, $role_options, $password, $password_confirmation;

    public function mount( $redirect = null, $role = null ){
        if( $role ){
            $this->show_roles = 0;
        }

        $this->role_options             =   Role::get();
    }

    public function render(){ return view('deep::livewire.parts.create-user-modal'); }

    public function submit(){
        $input = [
            'name'                          => $this->name,
            'email'                         => $this->email,
            'phone'                         => $this->phone,
            'password'                      => $this->password,
            'role'                          => $this->role,
            'password_confirmation'         => $this->password_confirmation,
        ];

        Validator::make($input, [
            'name'                          => ['required', 'string', 'max:255'],
            'phone'                         => ['required', 'numeric', 'digits:10', 'unique:users'],
            'role'                          => ['required', 'string', 'max:255'],
            'password'                      => $this->passwordRules(),
            'terms'                         => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        try{
            DB::transaction(function () use($input) {
                $uuid = Uuid::uuid4()->toString();
                
                $entry = User::create([
                    'name'                          =>  $this->name,
                    'email'                         =>  $this->email,
                    'phone'                         =>  $this->phone,
                    'wallet'                        =>  0,
                    'reward'                        =>  0,
                    'password'                      =>  Hash::make($this->password),
                    'referral_code'                 =>  'KaamWaale-'.$uuid,
                    'referred_by'                   =>  null,
                    'email_verified_at'             =>  now()
                ])->assignRole($this->role);
                
                $this->dispatch('userCreated', encode( $entry->id ));                
                $this->closeModal();
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In Create User ".$e->getMessage() ); }
    }

    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = [ 'createUser', 'memberCreated', 'closeUserModal' ];
    public function memberCreated(){ $this->resetInputFields(); }
    public function closeUserModal(){ $this->resetInputFields(); }
    public function createUser(){ 
        $this->resetInputFields(); 
        $this->isOpen                       =   1;
    }

    private function resetInputFields(){
        $this->name                         =   null;
        $this->email                        =   null;
        $this->phone                        =   null;
        $this->password                     =   null;
        $this->password_confirmation        =   null;
        $this->role                         =   null;
        $this->isOpen                       =   0;
    }

    private function getRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }    
        return $string;
    }
}