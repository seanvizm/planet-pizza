<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Pizza;
use App\Models\Order;

class PizzaController extends Controller
{
    public function index(){
        //$pizzas=Pizza::all();
        $pizzas=Pizza::latest()->get();

        return view('pizzas.index',[
            'pizzas'=> $pizzas
        ]);
    }

    public function about()
    {
        return view('pizzas.about');
    }

    public function cart()
    {
        return view('pizzas.cart');
    }

    public function addToCart($id, Request $request)
    {
        $product = Pizza::findOrFail($id);
        $toppings = $request->get('toppings', []);
        $quantity = $request->get('quantity', 1);

        $cart = session()->get('cart', []);

        // Calculate price based on toppings
        $price = (float) $product->price;
        $toppingNames = [];
        
        if ($product->type === 'custom' && !empty($toppings)) {
            // Validate maximum 4 toppings
            if (count($toppings) > 4) {
                return redirect()->back()->with('error', 'Maximum 4 toppings allowed!');
            }
            
            // Get topping details
            $toppingModels = \App\Models\Topping::whereIn('id', $toppings)->get();
            foreach ($toppingModels as $topping) {
                $price += (float) $topping->price;
                $toppingNames[] = $topping->name;
            }
        }

        // Create unique cart key for custom pizzas with different toppings
        $cartKey = $id;
        if (!empty($toppings)) {
            sort($toppings); // Sort to ensure same toppings create same key
            $cartKey = $id . '_' . implode('_', $toppings);
        }

        $pizzaName = $product->pizza_name;
        if (!empty($toppingNames)) {
            $pizzaName .= ' (+ ' . implode(', ', $toppingNames) . ')';
        }

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "name" => $pizzaName,
                "quantity" => $quantity,
                "price" => $price,
                "image" => $product->image,
                "toppings" => $toppingNames
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Pizza added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout()
    {
        return view('pizzas.checkout');
    }


    public function show($id){

        $pizza=Pizza::findOrFail($id);

        return view('pizzas.show', ['pizza' => $pizza]);
    }

    public function create(){
        return view('pizzas.create');
    }


    public function menu(){

        //!!! to display your images dont forget to type php artisan storage:link,
        //it makes it possible to access your storage folder from your root public folder

        $pizza = Pizza::latest()->get();

        return view('pizzas.menu', [
            'pizza' => $pizza
        ]);
    }


    public function store(Request $request){


        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();

        $path = $image->storeAs('public/images', $image_name);

        $pizza = new Pizza();

        $pizza->pizza_name = request('pizza_name');
        $pizza->pizza_description = request('pizza_description');
        $pizza->image = $image_name;
        $pizza->price = request('price');

        $pizza->save();

        return redirect('/') ->with('mssg', 'successful');
    }

    public function destroy($id)
    {
        $pizza = Pizza::findOrFail($id);
        $pizza -> delete();

        return redirect('/pizzas');
    }


    public function paypalOrder(Request $request)
    {
        try {
            // Log payment details
            \Log::info('=== PAYMENT RECEIVED ===');
            \Log::info('Payment Method: ' . strtoupper($request->payment_method ?? 'unknown'));
            \Log::info('Transaction ID: ' . $request->transaction_id);
            \Log::info('Amount: £' . $request->amount);
            \Log::info('Customer: ' . $request->first_name . ' ' . $request->last_name);
            \Log::info('Email: ' . $request->email);
            \Log::info('Contact: ' . $request->contact_no);
            \Log::info('Address: ' . $request->address);
            \Log::info('City: ' . $request->city);
            \Log::info('State: ' . $request->state);
            \Log::info('Zip: ' . $request->zip);
            \Log::info('Status: ' . $request->payment_status);
            \Log::info('Cart Items: ' . json_encode($request->cart_items));
            \Log::info('Timestamp: ' . now()->toDateTimeString());
            \Log::info('========================');

            $order = new Order();

            $order->name = $request->first_name . ' ' . $request->last_name;
            $order->email = $request->email;
            $order->contact_no = $request->contact_no;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->address = $request->address;
            $order->ref = $request->transaction_id;
            $order->cart_items = json_encode($request->cart_items);
            $order->total_price = $request->amount;
            $order->payment_method = $request->payment_method ?? 'unknown';
            $order->payment_status = $request->payment_status;

            $order->save();

            \Log::info('Order saved to database with ID: ' . $order->id);

            // Clear the cart after successful payment
            session()->forget('cart');
            session()->save(); // Force save the session
            \Log::info('Cart cleared after successful payment');

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            \Log::error('=== PAYMENT ERROR ===');
            \Log::error('Error: ' . $e->getMessage());
            \Log::error('Payment Method: ' . ($request->payment_method ?? 'unknown'));
            \Log::error('Transaction ID: ' . ($request->transaction_id ?? 'N/A'));
            \Log::error('====================');

            return response()->json([
                'success' => false,
                'message' => 'Failed to process order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
