<?php

namespace App\Http\Controllers;

use App\Models\CheckCart;
use App\Models\StockUpdateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function OrderItems()
    {
        return view('profile.partials.product-order-form');
    }

    public function UpdateStock(Request $request)
    {
        $request->validate([
            'ItemName' => ['required', 'min:3', 'string', 'max:50'],
            'ItemDescription' => ['required', 'min:0', 'max:500'],
            'ItemPrice' => ['required', 'numeric', 'min:0'],
            'Quantity' => ['required', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);


        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {

                $imagePath = $image->store('images', 'public');

                $imageUrl = asset('storage/' . $imagePath);
            }
        }

        StockUpdateModel::create([
            'ItemName' => $request->post('ItemName'),
            'ItemDescription' => $request->post('ItemDescription'),
            'ItemPrice' => $request->post('ItemPrice'),
            'Quantity' => $request->post('Quantity'),
            'image_url' => $imageUrl
        ]);

        return redirect()->route('dashboard')->with('status', 'Termék sikeresen hozzáadva az adatbázisba');
    }


    public function index()
    {
        $products = StockUpdateModel::all();
        return view('profile.partials.list-and-update-products', compact('products'));
    }


    public function destroy($id)
    {
        $product = StockUpdateModel::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


    public function edit($id)
    {
        $product = StockUpdateModel::findOrFail($id);
        return view('profile.partials.edit-product', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $product = StockUpdateModel::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'quantity' => 'required|integer',
        ]);


        $product->update([
            'ItemName' => $request->name,
            'ItemPrice' => $request->price,
            'ItemDescription' => $request->description,
            'Quantity' => $request->quantity
        ]);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function Dashboardindex()
    {

        $products = StockUpdateModel::all();


        return view('dashboard', compact('products'));
    }

    public function AddToCart($productId)
    {

        $product = StockUpdateModel::find($productId);

        $cartItem = CheckCart::where('user_id', Auth::user()->id) // Auth::user()->id a bejelentkezett felhasználó ID-ja
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Ha már létezik, akkor növeljük a mennyiséget
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Ha még nem létezik, akkor új kosár elemet hozunk létre
            CheckCart::create([
                'user_id' => Auth::user()->id,  // Auth::user()->id a bejelentkezett felhasználó ID-ja
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'A termék sikeresen hozzáadva a kosaradhoz!');
    }
}
