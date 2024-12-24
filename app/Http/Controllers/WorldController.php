<?php

namespace App\Http\Controllers;

use DB;
Use Auth;
use File;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Ramsey\Uuid\Uuid;

class WorldController extends Controller
{
    public function imageCropPost(Request $request){
        $data           = $request->image;
        $user_id        = $request->user_id ? $request->user_id : Auth::user()->id;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $fileName = $user_id.'-'.time() . '.png';
        $path = public_path() . "/storage/profile/".$fileName;
        file_put_contents($path, $data);

        $user           =   User::select('profile_photo_path')->where('id', $user_id)->first();
        if( $user && $user->profile_photo_path ){ file::delete( public_path( $user->profile_photo_path ) ); }

        User::where( 'id', $user_id )->update([
            'profile_photo_path'        => "/storage/profile/".$fileName
        ]);

        return response()->json([ 'success' => 1, 'message' => "Image uploaded successfully", 'media' => "/storage/profile/".$fileName ]);
    }

    public function spatieData(){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::statement('truncate table roles;');
        DB::statement('truncate table permissions;');
        DB::statement('truncate table role_has_permissions;');
        DB::statement('truncate table model_has_roles;');

        DB::statement('truncate table users;');

        DB::transaction(function () {
            $roles = [ "owner", "owner_ops", "superadmin", "admin", "teacher", "executive", "seo", "user" ];
            $permissions = [ 
                "Create Blog", "Edit Blog", "Check Blogs",                
                "Create Teacher", "Edit Teacher", "Check Teachers",
                "Create User", "Edit User", "Check User",
                "Check Leads"
            ];
            
            foreach($roles as $i){ 
                $role = Role::create(['name' => $i]);
            }

            foreach($permissions as $i){ 
                $role = Permission::create(['name' => $i]);
            }

            $this->createAdmin();
        });
    }

    private function createAdmin(){
        $data = [
            [ 'name' => "Deepak Tiwari", 'email' => "almora1deepak@gmail.com", "phone" => "9302785405", "role" => "owner" ]
        ];

        foreach( $data as $i ){
            $uuid = Uuid::uuid4()->toString();
            
            User::create([
                'name'                          => $i['name'],
                'email'                         => $i['email'],
                'phone'                         => $i['phone'],
                'wallet'                        => 0,
                'password'                      => Hash::make("123456789"),
                'referral_code'                 => 'cowoso-'.$uuid,
                'referred_by'                   => null,
                'email_verified_at'             => now()
            ])->assignRole($i['role']);
        }
    }

    public function test(){
        if( !Auth::check() || Auth::user()->id != 1 ){
            return;
        }

    }
}