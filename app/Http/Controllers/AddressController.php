<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('user.checkout')->with("address", $address);
    }

    public function create(StoreAddressRequest $request)
    {
        $address = Address::create([
            "name" => $request->input(('name')),
            "phone" => $request->input(('phone')),
            "address" => $request->input(('address')),
            "city" => $request->input(('city')),
            "note" => $request->input(('note')),
            "user_id" => auth()->user()->id
        ]);

        return redirect()->back()->with(['success' => 'Address added successfully'], ['address' => $address]);
    }

    public function delete($id)
    {
        Address::find($id)->delete();
        return redirect()->back()->with(['success' => 'Address deleted successfully']);
    }
}

