<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller{

    public function index(Request $request, $type = "pending"){
        if($type == "complete"){
            $statusCodes = Order::ORDER_COMPLETED;
        }
        elseif($type == "cancel"){
            $statusCodes = Order::CANCELED;
        }
        else{
            $statusCodes = Order::ORDER_WAITING;
        }

        return view('orders.index', [
            'orders' => $request->user()->buyer
                ->orders()
                ->with(['seller','details.product'])
                ->where('status_code', $statusCodes)
                ->orderByDesc('created_at')
                ->paginate(10)
        ]);
    }

    public function create(Request $request, Seller $seller){
        if(Gate::denies('isBuyerRegistered')){
            return redirect()->route('profile')->with([
                'error' => 'Kamu harus mengisi informasi pembeli terlebih dahulu.'
            ]);
        }

        $buyer = $request->user()->buyer;
        $carts = $buyer->carts()
            ->with('product.seller')->get()
            ->filter(function (Cart $cart) use ($seller){
                return $cart->product->seller->id == $seller->id;
            });

        if($carts->isEmpty()){
            return abort(404);
        }

        try {
            DB::beginTransaction();
            $order = new Order;
            $order->buyer_id = $buyer->id;
            $order->seller_id = $seller->id;
            $order->status_code = Order::ORDER_WAITING;
            $order->save();

            foreach ($carts as $cart){
                $detail = new OrderDetail;
                $detail->order_id = $order->id;
                $detail->product_id = $cart->product->id;
                $detail->price = $cart->product->price;
                $detail->discount = $cart->product->discount;
                $detail->qty = $cart->qty;
                $detail->save();

                $cart->delete();
            }

            DB::commit();

            return redirect()->route('orders.show', $order)->with([
                'success' => 'Silahkan kamu menghubungi penjual untuk melanjutkan transaksi.'
            ]);
        } catch (\Exception $e){
            DB::rollBack();

            return redirect()->route('carts.index')->with([
                'error' => 'Terjadi kesalahan pada sistem. Coba lagi nanti.'
            ]);
        }
    }

    public function show(Request $request, Order $order){
        Gate::authorize('view', $order);

        return view('orders.show', [
            'order' => $order
        ]);
    }
}
