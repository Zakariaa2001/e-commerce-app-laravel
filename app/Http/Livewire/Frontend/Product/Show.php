<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $product ,$productQunatnity;


    public function addToWishlist($productId) {
        if(Auth::check()) {
            if(wishlist::where('user_id', auth()->user()->id)->where('product_id',$productId)->exists()) {
                session()->flash('message', 'Product Alerdy added to wishlist');
                 $this->dispatchBrowserEvent('message', 
                ['text' => 'Product Alerdy added to wishlist',
                'type' => 'waring',
                'status' => 409
                ]);
                return false;
            }
            wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId,
            ]);
            session()->flash('message', 'Product added to wishlist succesfully');
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Product added to wishlist succesfully',
                    'type' => 'succes',
                    'status' => 200
                ]
            );
        }else {
            session()->flash('message', 'Please Login To Continue');
            $this->dispatchBrowserEvent('message', 
            ['text' => 'Please Login To Continue',
             'type' => 'info',
             'status' => 401
            ]);
            return false;
            }
        }
    public function colorSelected($productColorId) {
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->productQunatnity = $productColor->quantity == 0 ?? 'outofstock';
    }

    public function mount($product)
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.show',['product' => $this->product]);
    }
}