<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller{

    use PasswordValidationRules;

    public function profile(Request $request){
        return view('profile.view', [
            'user' => $request->user(),
        ]);
    }

    public function updateSeller(Request $request){
        $request->validate([
            'logo' => ['nullable', 'image', 'dimensions:min_width=200,min_height=200'],
            'banner' => ['nullable', 'image', 'dimensions:min_width=200,min_height=200'],
            'store_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|numeric|starts_with:8',
        ]);

        $seller = Seller::where('user_id', $request->user()->id)->first();
        if($seller == null){
            $seller = new Seller;
            $seller->user_id = $request->user()->id;
        }

        $seller->store_name = $request->store_name;
        $seller->address = $request->address;
        $seller->phone_number = $request->phone_number;

        if($request->file('logo')){
            $image = Image::make($request->file('logo'));
            $dim = min($image->width(), $image->height(), 500);

            $logo = Str::random(64).'.jpg';
            Storage::disk('public')->put("logos/$logo", $image->fit($dim)->encode('jpg', 80));

            $seller->logo = $logo;
        }

        if($request->file('banner')){
            $image = Image::make($request->file('banner'));
            $dim = min($image->width(), $image->height(), 600);

            $banner = Str::random(64).'.jpg';
            Storage::disk('public')->put("banners/$banner", $image->fit($dim, $dim/3)->encode('jpg', 80));

            $seller->banner = $banner;
        }

        $seller->save();

        return redirect()->route('profile')->with([
            'success' => 'Data penjual telah diperbarui.'
        ]);
    }

    public function updateBuyer(Request $request){
        $request->validate([
            'address' => 'required|string',
            'phone_number' => 'required|numeric|starts_with:8',
        ]);

        $buyer = Buyer::where('user_id', $request->user()->id)->first();
        if($buyer == null){
            $buyer = new Buyer;
            $buyer->user_id = $request->user()->id;
        }

        $buyer->address = $request->address;
        $buyer->phone_number = $request->phone_number;
        $buyer->save();

        return redirect()->route('profile')->with([
            'success' => 'Data pembeli telah diperbarui.'
        ]);
    }
}
