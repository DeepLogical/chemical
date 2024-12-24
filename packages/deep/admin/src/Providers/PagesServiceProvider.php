<?php

namespace Deep\Admin\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Admin\Http\Livewire\Admin\AdminDashboard;
use Deep\Admin\Http\Livewire\Admin\AdminUsers;
use Deep\Admin\Http\Livewire\Admin\AdminSetting;
use Deep\Admin\Http\Livewire\Admin\AdminWalletRechargeHistory;
use Deep\Admin\Http\Livewire\Admin\AdminSpatie;

use Deep\Admin\Http\Livewire\Parts\AdminSearch;
use Deep\Admin\Http\Livewire\Parts\AdminSidebar;
use Deep\Admin\Http\Livewire\Parts\UserAuthModal;
use Deep\Admin\Http\Livewire\Parts\CreateUserModal;
use Deep\Admin\Http\Livewire\Parts\AdminHeader;

use Deep\Admin\Http\Livewire\User\MyStaffList;
use Deep\Admin\Http\Livewire\User\UserSpatie;
use Deep\Admin\Http\Livewire\User\Notifications;
use Deep\Admin\Http\Livewire\User\ProfileImage;
use Deep\Admin\Http\Livewire\User\WalletRechargeHistory;
use Deep\Admin\Http\Livewire\User\Register;
use Deep\Admin\Http\Livewire\User\Login;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->mergeConfigFrom( __DIR__.'/../../config/deep.php', 'deep' );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->publishes([ __DIR__.'/../../config/deep.php' => config_path('deep.php'), ], 'config');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'deep');
        $this->publishes([ __DIR__.'/../../resources/views' => resource_path('views/vendor/deep'), ], 'views');

        Livewire::component('adminDashboard', AdminDashboard::class);
        Livewire::component('adminUsers', AdminUsers::class);
        Livewire::component('adminSpatie', AdminSpatie::class);
        Livewire::component('adminSetting', AdminSetting::class);
        Livewire::component('adminWalletRechargeHistory', AdminWalletRechargeHistory::class);
        
        Livewire::component('myStaffList', MyStaffList::class);
        Livewire::component('userSpatie', UserSpatie::class);
        Livewire::component('notifications', Notifications::class);
        Livewire::component('walletRechargeHistory', WalletRechargeHistory::class);
        Livewire::component('profileImage', ProfileImage::class);

        Livewire::component('adminSearch', AdminSearch::class);
        Livewire::component('adminSidebar', AdminSidebar::class);
        Livewire::component('userAuthModal', UserAuthModal::class);
        Livewire::component('createUserModal', CreateUserModal::class);
        Livewire::component('adminHeader', AdminHeader::class);
    }
}