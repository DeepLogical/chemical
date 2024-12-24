Add In .gitignore 

/public/ckeditor
/storage

<!-- Basic Installation -->
1.  composer create-project laravel/laravel example-app

2.  Install Livewire and Jetstream
    a. Add to composer.json  "laravel/jetstream": "^3.2",
        Or
        composer require laravel/jetstream
    b.  php artisan jetstream:install livewire
    c.  npm i && run dev
    d.  php artisan vendor:publish --tag=jetstream-views    // Publilsh Jetstream

3.  Edit package.json scripts
    "scripts": {
        "dev": "npm run development",
        "development": "mix",
        "watch": "mix watch",
        "watch-poll": "mix watch -- --watch-options-poll=1000",
        "hot": "mix watch --hot",
        "prod": "npm run production",
        "production": "mix --production",
        "git": "git add . && git commit -a -m `commit` && git push",
        "push": "git add . && git commit -a -m `commit` && git push",
        "clear": "php artisan optimize:clear",
        "clearlog": "sudo truncate -s 0 ./storage/logs/laravel.log"
    },

    Migrate from Vite to webpack
    Run 
    npm install --save-dev laravel-mix 
    npm pkg delete type
    
8.  Create Database and edit .env accordingly


composer require ramsey/uuid

    <!-- Spatie for roles -->
        1.  composer require spatie/laravel-permission

        3.  Run 
                php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

        4.  Create Roles to start
                Copy WorldController from Webrentals
                Edit 
                    use App\Http\Controllers\Worldcontroller;
                    Route::get('spatieData', [Worldcontroller::class, "spatieData"])->name("spatieData");
                    Route::post('imageCropPost', [Worldcontroller::class, "imageCropPost"])->name("imageCropPost");

                    In App>HTTP>Middleware>VerifyCSRFToken

                    Add "imageCropPost",
        5.  Change User Model
                class User extends Authenticatable implements MustVerifyEmail
                use Spatie\Permission\Traits\HasRoles;
                use HasRoles;
                
                protected $fillable = [
                    'phone',
                    'wallet',
                    'reward',
                    'email_verified_at',
                    'referral_code',
                    'referred_by'
                ];

                public function scopeSearch($query, $val){
                    return $query
                    ->where('email', 'like', '%'.$val.'%')
                    ->Orwhere('phone', 'like', '%'.$val.'%')
                    ->Orwhere('name', 'like', '%'.$val.'%');
                }
        6.  Change user migrations
                $table->string('phone')->unique();
                $table->integer('wallet')->default(0);
                $table->integer('reward')->default(0);
                $table->mediumText('referral_code')->unique();
                $table->string('referred_by')->nullable();
            
        7.  Change app > actions > fortify > CreateNewUser
            use Spatie\Permission\Models\Role;
            use Cookie;
            use HasRoles;
            use Ramsey\Uuid\Uuid;

            Validator::make($input, [
                'phone' =>  ['required', 'numeric', 'digits:10', 'unique:users'],
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
                'phone'                         => $input['phone'],
                'wallet'                        => 0,
                'reward'                        => 0,
                'referral_code'                 => 'ChefPoint-'.$uuid,
                'referred_by'                   => $referred_by_id,
            ])->assignRole('user');

        8.  Edit views > auth > register
            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="formInput" type="number" name="phone" :value="old('phone')" required />
                @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
    <!-- Spatie for roles -->

10. Create home Page
        php artisan make:livewire pages.home
        php artisan make:livewire pages.single
        php artisan make:livewire parts.header
        php artisan make:livewire parts.footer
11. Change web.php
        use Illuminate\Support\Facades\Route;
        use Illuminate\Foundation\Auth\EmailVerificationRequest;
        use Illuminate\Http\Request;

        use App\Http\Livewire\Pages\Home;

        Route::get('/', Home::class)->name('home');


        // For Email Verification
        Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('auth')->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect('/');
        })->middleware(['auth', 'signed'])->name('verification.verify');

        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

12. Change app>providers> RouteServiceProvider
        public const HOME = '/';
        
13. Delete views > navigation.blade and remove form app.blade

<!-- Image Intervention -->
    composer require intervention/image
        php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
<!-- Image Intervention -->

<!-- Jenssegers\Optimus\Optimus -->
    composer require jenssegers/optimus
<!-- Jenssegers\Optimus\Optimus -->

<!-- Notifications -->
    php artisan make:notification DeepakNotifications
    Copy file from Biznet app > Notifications
    
    php artisan notifications:table
<!-- Notifications -->

<!-- Excel Upload and download -->
    https://docs.laravel-excel.com/3.1/getting-started/installation.html
    composer require maatwebsite/excel

    php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
    This will create a new config file named config/excel.php
<!-- Excel Upload and download -->

<!-- Spatie Sluggable -->
    https://github.com/spatie/laravel-sluggable
    composer require spatie/laravel-sluggable   

<!-- Spatie Sluggable -->

<!-- IP Based Location -->
    https://www.larablocks.com/package/stevebauman/location
    composer require stevebauman/location

    Add the service provider in config/app.php:
    Stevebauman\Location\LocationServiceProvider::class,

    Add the alias in your config/app.php file:
    'Location' => Stevebauman\Location\Facades\Location::class,

    Publish the config file:
    php artisan vendor:publish --provider="Stevebauman\Location\LocationServiceProvider"
<!-- IP Based Location -->

<!-- Log Viewer -->
    composer require rap2hpoutre/laravel-log-viewer
<!-- Log Viewer -->

<!-- Basic Installation -->