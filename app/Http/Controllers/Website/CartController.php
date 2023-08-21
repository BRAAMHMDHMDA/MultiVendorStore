<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    protected CartInterfaceRepo $cart;

    public function __construct(CartInterfaceRepo $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('website.content.cart', [
            'cart' => $this->cart,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $this->cart->add($product);

        if ($request->expectsJson()) {

            return response()->json([
                'message' => 'Item added to cart!',
            ], 201);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);

        $this->cart->update($id, $request->post('quantity'));
    }

    public function destroy($id)
    {
        $this->cart->delete($id);
    }

    public function reRenderCartMenu()
    {
        $items = $this->cart->get();
        $total = $this->cart->total();

        // re Render the CartMenu component's view and return it as HTML
        $updatedCartHtml = View::make('components.website.cart-menu', compact('items', 'total'))->render();

        return $updatedCartHtml;
    }


}