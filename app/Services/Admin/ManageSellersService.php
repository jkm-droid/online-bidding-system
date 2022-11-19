<?php

namespace App\Services\Admin;

use App\Constants\AppConstants;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageSellersService
{
    public function createNewSeller($request)
    {
        $request->validate([
            'full_name'=>'required|min:8|string',
            'email'=>'required|email|unique:sellers',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:sellers',
            'location'=>'required|string|min:3'
        ]);

        Seller::create([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'location' =>  $request['location'],
        ]);

        return redirect()->route('admin.seller')
            ->with('success', 'Created successfully');
    }

    public function getSellers()
    {
        $sellers = Seller::paginate(AppConstants::$pagination);

        return view('admin.sellers.index', compact('sellers'));
    }

    public function showEditSellerForm($seller_id)
    {
        $seller = Seller::where('id',$seller_id)->first();

        return view('admin.sellers.edit')
            ->with('seller', $seller);
    }

    public function editSellerDetails($request, $sellerId)
    {
        $request->validate([
            'full_name'=>'required|min:8|string',
            'email'=>'required|email|unique:sellers',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:sellers',
            'location'=>'required|string|min:3'
        ]);

        Db::table('sellers')->where('id',$sellerId)->update([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'location' =>  $request['location'],
        ]);

        return redirect()->route('admin.seller')
            ->with('success', 'Updated successfully');
    }
}
