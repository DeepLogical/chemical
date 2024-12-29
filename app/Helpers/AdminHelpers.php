<?php

use \Cookie as Cookie;
use Jenssegers\Optimus\Optimus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Notifications\DeepNotifications;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Response;


use Deep\Admin\Models\Action;
use Deep\Seo\Models\Meta;
use Deep\Pages\Models\Media;
use Deep\Pages\Models\PageDetails;
use App\Models\User;
use Deep\Admin\Models\AuditLog;

use Illuminate\Support\Facades\Crypt;


function getNextUniqueNumber($prefix){ return strtoupper(uniqid($prefix)); }
function sanitizeURL($value){ return strtolower( str_replace([' ', ':', '\\', '*', '?'], '-', $value) ); }
function generateCode($value){ return strtolower( preg_replace("/[^a-zA-Z0-9]/", "", $value) ); }
function cleanURL($value){ return strtolower( str_replace([ config('deep.site'), config('deep.test_site'), 'http:127.0.0.1:8000', '\'' ], '', $value) ); }

function optimus_encode($value){ return $value ? app(Optimus::class)->encode($value) : $value; }
function optimus_decode($value){ return $value ? app(Optimus::class)->decode($value) : $value; }

function encode($value){ 
    $val                        =   optimus_encode( $value );
    $encryptedLongCode          =   Crypt::encryptString( $val );
    return $encryptedLongCode; 
}

function decode($value){ 
    $decryptedCode              =   Crypt::decryptString($value);
    $val                        =   optimus_decode( $decryptedCode );
    return $val;
}

// Common Calls
    function getAdminLinks(){
        try{

        $array = [];
        if(Auth::check()){
            if(Auth::user()->hasRole([ 'owner'])){ $array = array_merge( config('deep.ownerLinks'), config('deep.seoLinks') ); }
            if(Auth::user()->hasRole([ 'superadmin', 'admin', 'seo' ])){ $array = array_merge( config('deep.seoLinks') ); }
            if(Auth::user()->hasRole([ 'user' ])){ $array = array_merge( config('deep.userLinks') ); }
        }

        return $array;
        }catch (Exception $e) { \Log::warning("Error In getAdminLinks ".$e->getMessage() ); }
    }

    function clearUnverifiedUsers(){
        try{ 
            $fifteendaysago = date_create('15 days ago')->format('Y-m-d');
            $data = User::whereNull('email_verified_at')->where( 'created_at', '<', $fifteendaysago.' 00:00:00')->delete();

            $sixtydaysago = date_create('60 days ago')->format('Y-m-d');
            DB::table('notifications')->whereNotNull('read_at')->where( 'read_at', '<', $sixtydaysago.' 00:00:00')->delete();
        }catch (Exception $e) { \Log::warning("Error In clearUnverifiedUsers ".$e->getMessage() ); }
    }

    function addOrUpdateMeta( $url, $title, $description, $metaId ){
        try{ 
            DB::transaction(function () use( $url, $title, $description, $metaId ) {
                if($metaId){
                    Meta::where(['id' => $metaId])->update([
                        'url'           => $url,
                        'title'         => $title,
                        'description'   => $description
                    ]);
                }else{
                    Meta::updateOrCreate(['url' => $url], [
                        'url'           => $url,
                        'title'         => $title,
                        'description'   => $description
                    ]);
                }
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In addOrUpdateMeta ".$e->getMessage() ); }
    }

    function changeStatus($table, $column, $id, $status){
        try{    
            DB::table($table)->where( 'id', decode($id) )->update([
                $column =>  decode($status) ? 0 : 1
            ]);

            return  "Entry  Updated succesfully";
        }catch (Exception $e) { \Log::warning("Error In changeStatus ".$e->getMessage() ); }
    }

    function pivotEntry($table, $id, $array, $parent, $child){
        try{ 
            DB::table($table)->where($parent, $id)->delete();
            if (count($array) > 0) {
                foreach ($array as $i) {
                    DB::table($table)->insert([
                        $parent => $id,
                        $child => intVal($i),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }catch (Exception $e) { \Log::warning("Error In pivotEntry ".$e->getMessage() ); }
    }

    function createAuditLog($model){
        $user_id = auth()->id();
        $changes = $model->getDirty();

        $auditLogData = [
            'model_id' => $model->id,
            'model_type' => get_class($model),
            'user_id' => $user_id,
        ];

        $auditLogChanges = [];

        foreach ($changes as $field => $newValue) {
            $oldValue = $model->getOriginal($field);
            $auditLogChanges[] = [
                'field_name' => $field,
                'old_value' => $oldValue,
                'new_value' => $newValue,
            ];
        }
        
        $auditLogData['changes'] = json_encode($auditLogChanges);
        
        AuditLog::create($auditLogData);
    }

    function getHP( $model, $model_id, $h, $p ){
        $heading = null; $paragraph = null;
    
        if( !$model || !$model_id ){ return ['h' => $heading, 'p' => $paragraph ]; }
    
        $check          =   PageDetails::where([ ['model', $model], ['model_id', $model_id] ])->first();
            
        if( $check ){
            if( $check->$h && $check->$p ){
                $heading              =   $check->$h;
                $paragraph            =   $check->$p;
            }else{
                $heading              =   optional(optional(optional($check->sport)->page)->details)->$h;
                $paragraph            =   optional(optional(optional($check->sport)->page)->details)->$p;
            }
        }
    
        return ['h' => $heading, 'p' => $paragraph ];
    }
// Common Calls

// Media
    function imagePath( $type ){
        $data = [
            [ "type" => "uploads", "path" => 'uploads', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "infographics", "path" => 'infographics', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "achievements", "path" => 'achievements', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "author", "path" => 'author', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "team", "path" => 'team', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "page", "path" => 'page', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "client", "path" => 'client', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "brands", "path" => 'brands', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "service", "path" => 'service', "regular_width" => 600, "regular_height" => 600, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "technology", "path" => 'technology', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "testimonials", "path" => 'testimonials', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "banner-slider", "path" => 'banner', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "banner-slider-mobile", "path" => 'banner/mobile', "regular_width" => null, "regular_height" => null, "small" => false, "thumbnail" => false, "dimension" => [] ],
            [ "type" => "blog", "path" => 'blog', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "news", "path" => 'news', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "podcast", "path" => 'podcast', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "grade", "path" => 'grade', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "board", "path" => 'board', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "coursemeta", "path" => 'coursemeta', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "coursespecial", "path" => 'coursespecial', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "instructor", "path" => 'instructor', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "course", "path" => 'course', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "teacher", "path" => 'teacher', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
            [ "type" => "product", "path" => 'product', "regular_width" => null, "regular_height" => null, "small" => true, "thumbnail" => true, "dimension" => [ "small-height" => 150, "small-width" => 350, "thumb-height" => 42, "thumb-width" => 100 ] ],
        ];

        $row = $data[ array_search($type, array_column( $data, "type" )) ];

        return $row;
    }

    function addOrUpdateSingleImage( $image, $type, $alt, $url, $media_id ){
        try{
            return $result = DB::transaction(function () use( $image, $type, $alt, $url, $media_id ) {
                if($url == '/'){
                    $url = 'home';
                }else{
                    $url = sanitizeURL($url);
                }
    
                $check = imagePath( $type );
                $path = 'storage/'.$check["path"].'/';
    
                $newAlt = $alt;
    
                if($media_id){
                    $xx = Media::where('id', $media_id)->first();
                    $deleteImage = $xx->media;
    
                    file::delete( public_path($path.$deleteImage) );
                    if( $check["thumbnail"] ){ file::delete( public_path($path."thumbnail/".$deleteImage) ); }
                    if( $check["small"] ){ file::delete( public_path($path."small/".$deleteImage) ); }
    
                    $newAlt = $xx->alt;
                }
    
                $fileName = checkFileName( $path, $url.'.'.$image->extension() );
    
                resizeAndStore( $image, $fileName, $type );
    
                $entry = Media::updateOrCreate(['id' => $media_id], [
                    'media' =>  $fileName,
                    'alt' =>    $newAlt,
                    'path' =>  '/'.$path.$fileName
                ]);
    
                return $entry->id;
            }, 3);
        }catch (Exception $e) {             
            \Log::warning("Error In addOrUpdateSingleImage ".$e->getMessage() ); }
    }
    
    function resizeAndStore($image, $fileName, $type){
        try{
            $check = imagePath( $type );
            $path = 'public/'.$check["path"];
    
            
            if( !$check['regular_width'] || !$check['regular_height'] ){
                $image->storeAs($path, $fileName);
            }else{
                Image::make($image->path())->fit($check['regular_width'], $check['regular_height'], function ($constraint) {
                    $constraint->aspectRatio(); $constraint->upsize();
                })->save(storage_path('app/'.$path.'/').$fileName);
            }
    
            if( count( $check['dimension'] ) ){
                if( $check['small'] ){
                    Image::make($image->path())->fit($check['dimension']['small-width'], $check['dimension']['small-height'], function ($constraint) {
                        $constraint->aspectRatio(); $constraint->upsize();
                    })->save(storage_path('app/'.$path.'/small/').$fileName);
                }
    
                if( $check['thumbnail'] ){
                    Image::make($image->path())->fit($check['dimension']['thumb-width'], $check['dimension']['thumb-height'], function ($constraint) {
                        $constraint->aspectRatio(); $constraint->upsize();
                    })->save(storage_path('app/'.$path.'/thumbnail/').$fileName);
                }
            }
    
        }catch (Exception $e) { \Log::warning("Error In resizeAndStore ".$e->getMessage() ); }    
    }
    
    function checkFileName($path, $imageName){
        try{ 
            $image      =    strtolower($imageName);
            $image      =    cleanURL( $image );
    
            if( file_exists($path.$image) ){
                $fileName = time().'-'.$image;
            }else{
                $fileName = $image;
            }
    
            return $fileName;
        }catch (Exception $e) { \Log::warning("Error In checkFileName ".$e->getMessage() ); }
    }

    function addMultipleImages( $images, $type, $alt ){
        try{
            return $result = DB::transaction(function () use($images, $type, $alt) {
                $mediaArray = [];
    
                $check = imagePath( $type );
                $path = 'storage/'.$check["path"].'/';
                
    
                foreach ($images as $key=>$i){
                    $fileName = 'PradeepClasses'.time().'-'.$key.'.'.$i->extension();
                    resizeAndStore( $i, $fileName, $type );
                    
                    $entry = Media::create([ 
                        'media' =>  $fileName,
                        'alt' =>    $alt,
                        'path' =>  '/'.$path.$fileName
                    ]);
    
                    array_push( $mediaArray, $entry->id );
                }
    
                return $mediaArray;
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In addMultipleImages ".$e->getMessage() ); }
    }
    
    function uploadPDF( $image, $type, $alt, $url, $media_id ){
        try{
            return $result = DB::transaction(function () use( $image, $type, $alt, $url, $media_id ) {
                $url = sanitizeURL($url);
                if( $type == 'courseMaterial' ){ $path = 'storage/course-material/';  }
    
                if($media_id){
                    $xx = Media::where('id', $media_id)->first();
                    file::delete( public_path($path.$xx->media) );
                    $newAlt = $xx->alt;
                }else{
                    $newAlt = $alt;
                }
    
                $fileName = strtolower($url.'-'.time().'.'.$image->extension());
                if( $type == 'courseMaterial' ){ 
                    $image->storeAs('/course-material', $fileName);
                }
    
                $entry = Media::updateOrCreate(['id' => $media_id], [
                    'media' =>  $fileName,
                    'alt' =>    'The PDF',
                    'path' =>  '/'.$path.$fileName
                ]);
                
                return $entry->id;
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In uploadPDF ".$e->getMessage() ); }
    }

    function downloadFile( $filename ){
        try{
            $file_path = storage_path() . '/app/uploads/'. $filename;
            if (file_exists($file_path)) {
                return Response::download($file_path, $filename, [
                    'Content-Length: ' . filesize($file_path)
                ]);
            }
            return null;
        }catch (Exception $e) { \Log::warning("Error In downloadFile ".$e->getMessage() ); }
    }

    function simpleUpload( $image, $delete = null ){
        try{
            return $result = DB::transaction(function () use( $image, $delete ) {
                $fileName = time().'.'.$image->extension();
                $image->storeAs( "/uploads/", $fileName );

                $filePath = storage_path("/uploads/". $delete);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                
                return $fileName;
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In simpleUpload ".$e->getMessage() ); }
    }
// Media

// Notifications
    function sendNotifications( $type, $id = null ){
        try{ 
            $users = User::role([ 'owner', 'admin' , 'seo'])->get();
            if($type == 'contactForm'){ $details = [ 'message' => 'Form filled on Contact Page', 'url' => route('adminContact') ]; }
            if($type == 'subscriptionForm'){ $details = [ 'message' => 'A User Subscribed', 'url' => route('adminSubscription') ]; }
            if($type == 'blogComment'){ $details = [ 'message' => 'Comment filled on Blog', 'url' => route('adminComments') ]; }
            
            if( $type == 'careerForm' ){ $details = [ 'message' => 'Job Application posted', 'url' => route('adminJoinUs') ]; }
            if( $type == 'registration' ){ $details = [ 'message' => 'User registered', 'url' => route('adminUsers') ]; }
            
            Notification::send($users, new DeepNotifications($details));
        }catch (Exception $e) { \Log::warning("Error In sendNotifications ".$e->getMessage() ); }
    }

    function sendNotificationsToUser($type, $user_id_array, $id= null){
        try{ 
            $users = User::whereIn('id', $user_id_array)->get();
            if( $type == 'message' ){ $details = [ 'message' => 'You have a message', 'url' => route('messagesList') ]; }

            Notification::send($users, new DeepNotifications($details));
        }catch (Exception $e) { \Log::warning("Error In sendNotificationsToUser ".$e->getMessage() ); }
    }

    function clearNotifications($model){
        try{
            foreach (Auth::user()->unreadNotifications as $i) { 
                if($i->data['url'] == $model){
                    $i->markAsRead();
                }
            }
        }catch (Exception $e) { \Log::warning("Error In clearNotifications ".$e->getMessage() ); }   
    }
// Notifications
// Scopes
    function mine($query){ return $query->where('user_id', Auth::user()->id); }
    function active($query){ return $query->where('status', 1); }
    function verified($query){ return $query->where('verified', 1); }
    function dateRange($query, $start, $end){
        if($start && $end){ $query = $query->whereBetween('created_at', [$start , $end ]); }
        return $query;
    }

    function dateSpecific($query, $date){
        if($date){ $query = $query->whereDate('created_at', '=', $date); }
        return $query;
    }
// Scopes