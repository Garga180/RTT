<?php

namespace App\Http\Controllers;

use App\Models\CheckCart;
use App\Models\Checkout;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('profile.partials.place-order-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'house_number' => 'nullable|string|max:10',
        ]);

        $userId = Auth::id();

        DB::beginTransaction();

        // Kosár tartalom lekérdezése Eloquent modellel
        $cartItems = CheckCart::where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'A kosár üres, nem lehet rendelést leadni.');
        }

        // Rendelés létrehozása
        $totalPrice = $cartItems->sum(fn($item) => $item->product->ItemPrice * $item->quantity);

        $checkout = Checkout::create([
            'user_id' => $userId,
            'name' => $request->input('name'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
            'street' => $request->input('street'),
            'house_number' => $request->input('house_number'),
            'total_price' => $totalPrice
        ]);

        // Rendelés tételek hozzáadása
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $checkout->id,
                'product_id' => $item->product->id,
                'product_name' => $item->product->ItemName, // Ha van ilyen adat a termékben
                'price' => $item->product->ItemPrice,
                'quantity' => $item->quantity,
            ]);
        }

        // Kosár ürítése
        CheckCart::where('user_id', $userId)->delete();

        DB::commit();

        return redirect('/dashboard')->with('success', 'Rendelés sikeresen leadva!');
    }
}
