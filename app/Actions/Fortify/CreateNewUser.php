<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles; 
use Cookie;
use Ramsey\Uuid\Uuid;

class CreateNewUser implements CreatesNewUsers
{
    use HasRoles;  // This allows your class to use the HasRoles trait
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' =>  ['required', 'numeric', 'digits:10', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $uuid = Uuid::uuid4()->toString();

        $referred_by_id = null;
        $refrence = Cookie::get('refrence');
        if($refrence){ 
            $referred_by = User::select('id')->where('referral_code', $refrence)->first();
            if($referred_by){
                $referred_by_id = $referred_by->id;
            }
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone'                         => $input['phone'],
            'wallet'                        => 0,
            'reward'                        => 0,
            'referral_code'                 => 'ChefPoint-'.$uuid,
            'referred_by'                   => $referred_by_id,
        ])->assignRole('user');
    }
}
