<?php

use \Cookie as Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Deep\Ecom\Models\Cart;
use Deep\Ecom\Models\Order;
use Deep\Coupon\Models\Coupon;
use Deep\Ecom\Models\Sku;
use Deep\Ecom\Models\Product;
use Deep\Ecom\Models\CartSku;
use Deep\Ecom\Models\OrderSku;
use Deep\Address\Models\Address;

use Deep\Admin\Models\PhonepePayment;

use Deep\Ecom\Models\Shipping;
use Deep\Ecom\Models\OrderShipping;
use Deep\Ecom\Mail\OrderMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use \Mpdf\Mpdf as PDF;

use Deep\Admin\Models\Adminsetting;

use Deep\PaymentGateway\Models\CartShipping;
use Deep\PaymentGateway\Models\TaxCollected;

    function shippingOptions(){
        $check = Adminsetting::where([ ['type', 'Basic'], ['name', 'Shipping'] ])->first();
        if( !$check ){ return null; }

        $data = Adminsetting::active()->where('type', $check->id )->get();
        return $data;
    }

    function inventory_check(){
        $data = Product::get();
        foreach( $data as $i ){
            $total_sku_inventory = 0;
            foreach( $i->all_sku as $j ){
                $total_sku_inventory += $j->inventory;
            }

            Product::where('id', $i->id)->update([
                'total_sku_inventory'   => $total_sku_inventory
            ]);
        }
    }

    function reset_all_products(){
        $check          =   Product::get();
        if( !$check ){ return; }

        foreach( $check as $i ){
            updateProductDetails( $i->id );
        }
    }

    function updateProductDetails( $id ){
        $check          =   Product::where('id', $id )->first();

        if( !$check ){ return; }

        $total_sku_inventory                    =   0;
        $max_discount_percent                   =   0;
        $max_discount_amount                    =   0;
        $min_sale_price                         =   $check->sku->min('sale');
        $max_sale_price                         =   0;

        $average_rating                          =   $check->reviews()->where('status', 1)->avg('rating');

        if( $check->sku && count( $check->sku ) ){
            foreach( $check->sku as $i ){
                $total_sku_inventory += (int)$i['inventory'];

                $sale = $i->activeSale();
                $salePrice = $i->sale;
                if ($sale) {
                    if( $sale->type == "Percent Based" ){
                        if( $sale->discount > $max_discount_percent ){
                            $max_discount_percent       =   $sale->discount;
                        }

                        $discount_in_amount        =   $sale->discount * $i->sale / 100;

                        if( $discount_in_amount > $max_discount_amount ){
                            $max_discount_amount       =   $discount_in_amount;
                        }
                    }

                    if( $sale->type == "Amount Based" ){
                        $discount_in_percent        =   $sale->discount * 100 / $i->sale;

                        if( $discount_in_percent > $max_discount_percent ){
                            $max_discount_percent       =   $discount_in_percent;
                        }

                        if( $sale->discount > $max_discount_amount ){
                            $max_discount_amount       =   $sale->discount;
                        }
                    }

                    $salePrice = $sale->calculateSalePrice($i->sale);

                    $min_sale_price     = $salePrice < $min_sale_price ? $salePrice : $min_sale_price;
                    $max_sale_price     = $salePrice > $max_sale_price ? $salePrice : $max_sale_price;
                }
            }
        }

        Product::where('id', $id )->update([
            'total_sku_inventory'           =>  $total_sku_inventory,
            'max_discount_percent'          =>  $max_discount_percent,
            'max_discount_amount'           =>  $max_discount_amount,
            'min_sale_price'                =>  $min_sale_price,
            'max_sale_price'                =>  $max_sale_price,
            'average_rating'                =>  $average_rating,
        ]);
    }

    function update_review( $model, $model_id, $id ){
        $check                  =   Review::where('id', $id)->active()->get();
        $average_rating = 0;
        if( $check && count( $check ) ){
            $average_rating         =   $check->sum('rating') / count( $check );
        }

        if( $model == 'Product' ){
            Product::where('id', $model_id)->update([ 'average_rating' => $average_rating ]);
        }
    }

// Add or Update in Cart
    function addOrCreateCart( $sku_id, $quantity, $action ){
        try {
            $sku_id = decode( $sku_id );
            
            $checkCartData = checkCart();
            if($checkCartData){
                $cart_id = $checkCartData['cart_id'];
                $cartCode = $checkCartData['cartCode'];
            }

            if($cart_id){
                updateCartProduct($cart_id, $sku_id, $quantity, $action );
                // $count      =   CartSku::where([ ['cart_id', $cart_id] ])->sum('quantity');
            }else{
                $cart_id = createCart($cartCode, $sku_id, $quantity );
                // $count      =   1;
            }

            return $cart_id;
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function createCart($cartCode, $sku_id, $quantity ){
        try {
            $billing_address_id = null;
            $shipping_address_id = null;
            if( Auth::check() ){
                $check = Order::where( 'user_id', Auth::user()->id )->orderBy('id', 'desc')->first();

                $billing_address_id = $check && $check->billing_address_id ? $check->billing_address_id : null;
                $shipping_address_id = $check && $check->shipping_address_id ? $check->shipping_address_id : null;
            }
            
            $entry = Cart::create([
                "user_id"                   =>  Auth::check() ? Auth::user()->id : null,
                "billing_address_id"        =>  $billing_address_id,
                "shipping_address_id"       =>  $shipping_address_id,
                "paymode"                   =>  "online"
            ]);
            
            updateCartProduct( $entry->id, $sku_id, $quantity, "increment" );

            return $entry->id;
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function updateCartProduct( $cart_id, $sku_id, $quantity, $action ){
        try {
            $check = CartSku::where([ ['cart_id', $cart_id], ['sku_id', $sku_id] ])->first();

            if($check){
                if($action === 'increment'){
                    CartSku::where('id', $check->id)->increment('quantity', $quantity);
                }elseif($check->quantity == 1 ){
                    CartSku::where('id', $check->id)->delete();
                }else{        
                    CartSku::where('id', $check->id)->decrement('quantity');
                }
            }else{
                $sku          =   Sku::where('id', $sku_id)->first();

                if( $sku ){
                    CartSku::create([
                        'cart_id'           =>  $cart_id,
                        'product_id'        =>  $sku->product_id,
                        'sku_id'            =>  $sku_id,
                        'quantity'          =>  $quantity,
                    ]);
                }
            }
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function checkCart(){
        try {
            $cartCode = Cookie::get('cartCode');

            if( Auth::check() ){
                $check = Cart::where('user_id', Auth::user()->id )->first();

                if( $check ){
                    $cartCode = encode( $check->id );
                    Cookie::queue( 'cartCode', $cartCode );
                    return [ 'cart_id' => $check->id, 'cartCode' => $cartCode ];
                }
            }
            
            if( $cartCode ){
                $check = Cart::where('id', decode($cartCode) )->first();
                if( $check ){
                    return [ 'cart_id' => $check->id, 'cartCode' => $cartCode ];
                }
            }

            // Condition
                // No Auth Or Auth with no Cart
                // No Cookie Or Cookie With No cart
            // Condition

            $last_id = optional( Cart::orderBy('id', 'DESC')->first() )->id;
            $cartCode = $last_id ? encode( $last_id ) : encode( 1 );

            Cookie::queue( 'cartCode', $cartCode );

            return [ 'cart_id' => NULL, 'cartCode' => $cartCode ];
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function incrementQuantity($id){
        $check = CartSku::where('id', decode($id) )->increment('quantity');
    }

    function decrementQuantity($id){
        $check = CartSku::where('id', decode($id) )->first();

        if( $check ){
            if( $check->quantity >1 ){
                CartSku::where('id', decode($id) )->decrement('quantity');
            }else{
                CartSku::where('id', decode($id) )->delete();
            }
        }
    }

    function deleteSku($id){ CartSku::where('id', decode($id) )->delete(); }
// Add or Update in Cart

// For Cart Page
    function updateCart( $array = [] ){
        try {
            $checkCartData = checkCart();
            if($checkCartData){
                $cart_id = $checkCartData['cart_id'];
                $cartCode = $checkCartData['cartCode'];
            }

            if( $cart_id ){
                $check = Cart::where('id', $cart_id )->first();
                if( $check ){
                    if( Auth::check() && !$check->user_id ){ $array['user_id'] = Auth::user()->id; }
                    if( Auth::check() &&  $check->address_id && !($check->address)->user_id  ){
                        Address::where('id', $check->address_id)->update([ 'user_id' => Auth::user()->id ]);
                    }

                    Cart::where('id', decode( $cartCode ))->update($array);
                }
            }
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function getCartCount(){
        try {
            $count = null;

            if (Auth::check()) {
                $count = CartSku::whereHas('cart', function ($query) { $query->where('user_id', Auth::user()->id); })->sum('quantity');
            }
            
            if( !$count ){
                $cartCode = Cookie::get('cartCode');
                
                if ($cartCode) {
                    $cartId = decode($cartCode);
                    $count = CartSku::whereHas('cart', function ($query) use ($cartId) { $query->where('id', $cartId); })->sum('quantity');
                }
            }
            
            return $count;
            
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function getCartData($id = null){
        try {
            $cart = null;

            if( $id ){
                $cart = Cart::where('id', decode($id) )->first();
            }            

            if ( !$cart && Auth::check() ) {
                $cart = Cart::where('user_id', Auth::user()->id)->first();
            }
            
            if( $cart && Auth::check() && !$cart->user_id ){
                Cart::where('id', $cart->id )->update([
                    'user_id'           =>  Auth::user()->id
                ]);

                $array = Cart::where([ ['user_id', Auth::user()->id], ['id', '!=', $cart->id ] ])->pluck('id')->toArray();

                Cart::whereIn('id', $array)->delete();
                CartSku::whereIn('cart_id', $array)->delete();
            }

            if( !$cart ){
                $cartCode = Cookie::get('cartCode');
                if ($cartCode) {
                    $cart = Cart::where('id', decode($cartCode))->first();
                }
            }

            return $cart;
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function getCartTotal(){
        try {
            $cart = getCartData();

            $total = 0;
            if( $cart ){
                foreach( $cart->sku as $i ){
                    $salePrice = optional($i->sku)->sale;
                    $sale = optional($i->sku)->activeSale();
                    if ($sale) {
                        $salePrice = $sale->calculateSalePrice($salePrice);
                    }

                    $total+= $salePrice * $i->quantity;
                }
            }

            return $total;
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function getStateShippingCharges( $shipping_address_id, $weight ){
        $shipping_charges   =   0;
        $address            =   Address::where('id', $shipping_address_id)->first();

        if( !$weight || !optional(optional(optional($address)->state)->zone)->pricing || !count( optional(optional(optional($address)->state)->zone)->pricing ) ){
            return $shipping_charges;
        }

        $pricing            =   optional(optional($address->state)->zone)->pricing;
        
        $applicableRate = $pricing->where('weight', '<=', $weight)->sortByDesc('weight')->first();
        if ( $applicableRate ) {
            $shipping_charges = ($weight / $applicableRate->weight ) * $applicableRate->rate;
        }

        if( !$applicableRate && optional(optional($address->state)->zone)->default_rate ){
            $shipping_charges = optional(optional($address->state)->zone)->default_rate;
        }

        return $shipping_charges;
    }
// For Cart Page

// User
    function updateAddressInCart($id){
        try {
            $cartCode = Cookie::get('cartCode');
            if( $cartCode ){
                $check = Cart::where('id', decode( $cartCode ))->first();
                Cart::where('id', decode( $cartCode ))->update([
                    'address_id'    =>  $id  
                ]);
            }
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function updateUserId(){
        try {
            $cartCode = Cookie::get('cartCode');
            if($cartCode && Auth::check()){
                $check = Cart::where('id', decode($cartCode) )->first();

                if( $check && !$check->user_id ){
                    Cart::where('id', decode( $cartCode ))->update([
                        'user_id'       =>  Auth::user()->id,
                    ]);
                }
            }
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }
// User

// Order
    function getOrderDetails($id){
        try {
            $order = Order::findOrFail( decode($id) );
            return $order;
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function placeOrder( $cart_id = null ){
        try {
            return DB::transaction(function () use( $cart_id ){
                if( !$cart_id ){
                    $checkCartData = checkCart();
                    if($checkCartData){
                        if( $checkCartData['cart_id'] ){
                            $cart_id = $checkCartData['cart_id'];
                        }
                        $cartCode = $checkCartData['cartCode'];
                    }
                }
                
                if( $cart_id ){
                    $cart = Cart::findOrFail( $cart_id );

                    if( !$cart ){ \Log::warning("000 Cart Not Found"); return null; }

                    $entry = Order::create([
                        'user_id'                   =>  $cart->user_id,
                        'billing_address_id'        =>  $cart->billing_address_id,
                        'shipping_address_id'       =>  $cart->shipping_address_id,
                        'paymode'                   =>  $cart->paymode,
                        'weight'                    =>  $cart->weight,
                        'total'                     =>  $cart->total,
                        'payable_amount'            =>  $cart->payable_amount,
                        'shipping_charges'          =>  (int)$cart->shipping_charges,
                        'cod_charges'               =>  (int)$cart->cod_charges,
                        'discount_value'            =>  (int)$cart->discount_value,
                        'additional_discount'       =>  (int)$cart->additional_discount,
                        'user_remarks'              =>  null,
                        'admin_remarks'             =>  null,
                        'status'                    =>  "Ordered"
                    ]);

                    if( $cart->shipping ){
                        OrderShipping::create([
                            'order_id'                      =>  $entry->id,
                            'aggregator'                    =>  optional($cart->shipping)->aggregator,
                            'rate'                          =>  optional($cart->shipping)->rate,
                            'cod_charges'                   =>  optional($cart->shipping)->cod_charges,
                            'courier_name'                  =>  optional($cart->shipping)->courier_name,
                            'delivery_postcode'             =>  optional($cart->shipping)->delivery_postcode,
                            'weight'                        =>  optional($cart->shipping)->weight,
                            'total'                         =>  optional($cart->shipping)->total,
                            'cod'                           =>  $cart->paymode == "cod" ? 1 : 0,
                            'paymode'                       =>  $cart->paymode,
                            'order_created'                 =>  0,
                        ]);
                        
                        CartShipping::where( 'cart_id', $cart->id )->delete();
                    }

                    $total_tax = 0; $total_cgst = 0; $total_sgst = 0; $total_igst = 0;

                    $unit_discount = 0;
                    if( $cart->discount_value && $cart->discount_value > 0 ){
                        $unit_discount          = $cart->discount_value / $cart->sku->sum('quantity');
                    }

                    foreach( $cart->sku as $i ){
                        $tax = 0;
                        $tax_rate = 0;
                        
                        $tax_rate       =   optional(optional(optional($i->sku)->product)->tax)->rate/100;
                        
                        $sale_value          =   ($i->sku->sale - $unit_discount ) * $i->quantity;

                        $cgst = 0; $sgst = 0; $igst = 0;
                        $tax            =   round(  ( $sale_value * $tax_rate ) / ( 1+ $tax_rate ), 2 );
                        
                        $total_tax          +=  $tax;
                        if( optional($cart->shipping_address)->state_id == config('deep.haryana_id') ){
                            $igst               =   $tax;
                            $total_igst         +=  $igst;
                        }else{
                            $cgst               =   $tax/2;   
                            $sgst               =   $tax/2;   
                            $total_cgst         +=  $cgst;
                            $total_sgst         +=  $sgst;
                        }

                        $salePrice = optional($i->sku)->sale;
                        $sale = optional($i->sku)->activeSale();
                        if ($sale) {
                            $salePrice = $sale->calculateSalePrice($salePrice);
                        }

                        OrderSku::create([
                            'order_id'              =>  $entry->id,
                            'product_id'            =>  $i->product_id,
                            'sku_id'                =>  $i->sku_id,
                            'quantity'              =>  $i->quantity,
                            'status'                =>  "Ordered",
                            'cgst'                  =>  $cgst,
                            'sgst'                  =>  $sgst,
                            'igst'                  =>  $igst,
                            'sale'                  =>  $salePrice,
                        ]);
                        
                        Sku::where( 'id', $i->sku_id )->decrement( 'inventory', $i->quantity );
                        Product::where( 'id', $i->product_id )->decrement( 'total_sku_inventory', $i->quantity );
                        Product::where( 'id', $i->product_id )->increment( 'sold', $i->quantity );
                    }

                    TaxCollected::create([
                        'model'             =>  'Product',
                        'model_id'          =>  $entry->id,
                        'cgst'              =>  $total_cgst,
                        'sgst'              =>  $total_sgst,
                        'igst'              =>  $total_igst,
                        'total'             =>  $total_tax
                    ]);
                    
                    delete_cookie('cartCode');
                    // Cart::where('id', $cart_id )->delete();
                    // CartSku::where('cart_id', $cart_id )->delete();
                    // save_flat_cookie( 'order_id', encode( $entry->id ) );
                    init_action([ 'model' => "Ecom", 'model_id' => $entry->id ]);

                    return $entry->id;

                }else{ \Log::warning('cart_id not found'); return null; }
            }, 3);
        } catch (\Exception $e) { \Log::warning($e->getMessage()); return null; }
    }
// Order

// Coupon
    function applyCoupon($coupon){
        try {
            $discountValue = 0;
            $today = \Carbon\Carbon::now()->format('Y-m-d');

            $offer = Coupon::active()->where([ ['code', $coupon] ])->first();
            if( !$offer){ removeDiscount(); return [ "status" => false, "message" => "Coupon is Invalid" ]; }

            // if( $offer->coupon_type == "Buy One Get One" ){
            //     $check = checkForB1G1( $offer->id );

            //     if( !$check ){
            //         return [ "status" => false, "message" => "Coupon not applicable to added products" ];
            //     }
            // }

            if( ( $offer->coupon_type == "For User" || $offer->usage_type == "Single" ) && !Auth::check() ){
                removeDiscount(); return [ "status" => false, "message" => "Login To Apply Coupon" ];
            }

            if( $offer->coupon_type == "For User" ){
                $check          =   DB::table('coupon_user')->where([ ['coupon_id', $offer->id], ['user_id', Auth::user()->id] ])->exists();

                if( !$check ){ removeDiscount(); return [ "status" => false, "message" => "Coupon is Invalid" ]; }

                if( $offer->usage_type == "Single" ){
                    $check2          =   DB::table('single_coupon_useds')->where([ ['coupon_id', $offer->id], ['user_id', Auth::user()->id] ])->exists();

                    if( $check2 ){ removeDiscount(); return [ "status" => false, "message" => "This has Coupon has already been used" ]; }
                }
            }

            $cart = getCartData();
            $applicableTotal = 0;
            if( $cart && $cart->sku && count( $cart->sku ) ){
                foreach( $cart->sku as $i ){
                    $salePrice = optional($i->sku)->sale;
                    $sale = optional($i->sku)->activeSale();
                    if ($sale) {
                        $salePrice = $sale->calculateSalePrice($salePrice);
                    }

                    $applicableTotal+= $salePrice * $i->quantity;
                }
            }else{
                return [ "status" => false, "message" => "No Cart Item Found" ];
            }

            if( $applicableTotal == 0 ){
                removeDiscount(); return [ "status" => false, "message" => "Applicable total is 0" ];
            }

            if( $offer->sales > $applicableTotal ){
                removeDiscount(); return [ "status" => false, "message" => "Applicable Total of Rs ". $applicableTotal . " is less than ".$offer->sales ];
            }

            if( $offer->type == "Amount Based"){
                $discountValue =    (int)$offer->discount;
            }

            if( $offer->type == "Percent Based"){
                $discountValue =    (int)$applicableTotal * (int)$offer->discount /100;
            }

            $checkCartData = checkCart();
            if($checkCartData){
                $cart_id = $checkCartData['cart_id'];
                $cartCode = $checkCartData['cartCode'];
            }

            if( $cartCode ){
                Cart::where('id', decode($cartCode))->update([
                    'offer_id'              =>  $offer->id,
                    'discountValue'         =>  $discountValue,
                ]);
            }

            return [ "status" => true, "message" => "Coupon applied successfully" ];
        } catch (\Exception $e) { \Log::warning($e->getMessage()); }
    }

    function checkForB1G1( $offer_id ){
        $buy = DB::table('buy_one_get_ones')->where('coupon_id', $offer_id)->distinct()->pluck('buy_id')->toArray();

        $cartCode = Cookie::get('cartCode');
        if( $cartCode && count($buy) ){
            $products = CartSku::where('cart_id', decode($cartCode))->distinct()->pluck('product_id')->toArray();
            $commonElements = array_intersect($products, $buy);

            if ( empty($commonElements) ) {
                return false;
            }else{
                return true;
            }
        }

        return false;
    }

    function removeDiscount(){
        $checkCartData = checkCart();
        if($checkCartData){
            $cart_id = $checkCartData['cart_id'];
            $cartCode = $checkCartData['cartCode'];
        }

        if( $cartCode ){
            Cart::where( 'id', decode($cartCode) )->update([
                'offer_id'              =>  null,
                'discountValue'         =>  null
            ]);
        }
    }
// Coupon

// Ship Rocket
    function getShiprocketToken(){
        return null;

        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'email' => 'XXXXXXXXXXXXXXXX',
            'password' => 'coderBhai588'
        ]);

        if( $response && $response->status() == 200){
            $resData = $response->json();
            return $resData['token'];
            
        }
    }
// Ship Rocket

// Invoice
    function invoice( $order_id ) {
        try {
            $gift_one_of_these = [];
            $title = config('deep.brand').optimus_encode( decode( $order_id ) );
            $documentFileName = $title.".pdf";

            $order = getOrderDetails( $order_id );

            if( optional($order->offer)->coupon_type == "Buy One Get One" ){
                $gift_one_of_these    = DB::table('buy_one_get_ones as bogo')->where('coupon_id', $order->offer_id)->distinct()
                                                ->leftJoin('products as p', 'p.id', 'bogo.get_id')->pluck('p.name')->toArray();
            }

            $services       =   config('deep.services');

            $data = [
                'title'                         =>  $title,
                'order'                         =>  $order,
                'services'                      =>  $services,
                'gift_one_of_these'             =>  $gift_one_of_these
            ];

            $document = new PDF([
                'tempDir' => '/tmp',
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_header' => '10',
                'margin_footer' => '5',
                'margin_top' => '5',
                'margin_bottom' => '5',
            ]);

            // $header = '<table style="width: 100%"><tbody><tr><td><a href="/"><img src="'. config("deep.logo") .'" style="width: 40px"></a></td><td style="text-align:right"><p style="text-align:right"><a href="'. config("deep.site") .'"" style="text-align:right">'. config("deep.site") .'"</a></p></td></tr></tbody></table>';
            // $header = '<table style="width: 100%;"><tbody><tr><td style="text-align: center"><a href="/"><img src="'. config("deep.logo") .'" style="width: 80px;"></a></td></tr></tbody></table>';
            $footer = '<div style="margin: 10px 0"></div><table style="width: 100%"><tbody><tr><td><a href="/">'. config("deep.brand") .' </a></td><td style="text-align:right">'. config("deep.email") .' / '. config("deep.phone") .'</td></tr></tbody></table>';
            // $document->SetHTMLHeader($header);
            $document->SetFooter($footer);

            $document->WriteHTML(view('PDF.order', $data));
            $tempFilePath = '/tmp/' . $title. '.pdf';
            $document->Output($tempFilePath, 'F');

            return $tempFilePath;
        } catch (Exception $e) { \Log::warning("Error In invoice ". $e->getMessage());
            return null;
        }
    }
// Invoice