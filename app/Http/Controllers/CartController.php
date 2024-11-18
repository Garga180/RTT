<?php

namespace App\Http\Controllers;

use App\Models\CheckCart;
use App\Models\StockUpdateModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;


class CartController extends Controller
{
    public function ShowCart()
    {
        $cartItems = CheckCart::where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard', ['message' => 'A kosarad üres!']);
        }

        return view('profile.partials.check-cart-form', ['cartItems' => $cartItems]);
    }

    public function update(Request $request, $cartItem)
    {
        $cartItem = CheckCart::findOrFail($cartItem);


        $quantity = $request->input('quantity');


        if ($quantity) {
            $cartItem->quantity = $quantity;
        }


        if ($request->action == 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->action == 'decrease') {

            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }
        }

        $cartItem->save();

        return redirect()->route('cart')->with('success', 'A kosár frissítve!');
    }

    public function destroy(CheckCart $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'A termék eltávolítva a kosárból.');
    }
}
