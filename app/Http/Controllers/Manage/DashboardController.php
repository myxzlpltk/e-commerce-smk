<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller{

    public function index(Request $request){
        if(Gate::allows('isAdmin')){
            return view('manage.admin', [
                'stat_product' => Product::count(),
                'stat_category' => Category::count(),
                'stat_transaction' => Order::count(),
                'stat_canceled' => Order::where('status_code', Order::CANCELED)->count(),
                'sells' => $this->sells(new Order()),
                'qualities' => $this->qualities(new Order()),
            ]);
        }
        elseif(Gate::allows('isSellerHasStore')){
            return view('manage.seller', [
                'orders' => auth()->user()->seller->orders()->with(['details','buyer.user'])->whereIn('status_code', [
                    Order::ORDER_WAITING,
                ])->get(),
                'seller' => auth()->user()->seller,
                'stat_product' => auth()->user()->seller->products()->count(),
                'stat_category' => auth()->user()->seller->categories()->count(),
                'stat_transaction' => auth()->user()->seller->orders()->count(),
                'stat_canceled' => auth()->user()->seller->orders()->where('status_code', Order::CANCELED)->count(),
                'sells' => $this->sells($request->user()->seller->orders()),
                'qualities' => $this->qualities($request->user()->seller->orders()),
            ]);
        }

        return abort(404);
    }

    private function sells($query){
        $today = Carbon::today()->firstOfMonth();

        $sells = new Collection;
        for($i=0; $i<8; $i++){
            $start = $today->copy()->subMonth($i);
            $end = $start->copy()->endOfMonth();
            $sells->push(new Collection([
                'month' => $start->shortMonthName,
                'start' => $start,
                'end' => $end,
                'stat' => $query
                    ->where('status_code', Order::ORDER_COMPLETED)
                    ->where('created_at', '>=', $start)
                    ->where('created_at', '<=', $end)
                    ->sum('total')
            ]));
        }

        return $sells->reverse();
    }

    private function qualities($query){
        $today = Carbon::today()->firstOfMonth();
        $qualities = new Collection;
        for($i=0; $i<6; $i++){
            $start = $today->copy()->subMonth($i);
            $end = $start->copy()->endOfMonth();

            $success = $query->where('status_code', Order::ORDER_COMPLETED)
                ->where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->count();
            $failed = $query->where('status_code', Order::CANCELED)
                ->where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->count();
            $total = $success+$failed;
            $qualities->push(new Collection([
                'month' => $start->shortMonthName,
                'start' => $start,
                'end' => $end,
                'stat' => $total == 0 ? 0 : round($success/$total*100)
            ]));
        }

        return $qualities->reverse();
    }
}
