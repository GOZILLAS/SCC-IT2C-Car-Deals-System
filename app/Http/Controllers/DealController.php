<?php

namespace App\Http\Controllers;
use App\Models\Deal;

use Illuminate\Http\Request;

class DealController extends Controller
{
    public function getDeals(){
        $deals = Deal::with('payment')->get();

        return response()->json(['deals' => $deals]);
    }  

    public function addDeals(Request $request){
        $request->validate([
            'car_name' => ['required', 'string', 'max:255'],
            'brand_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'payment_method_id' => ['required', 'exists:payments,id'],
            'deal_statuses_id' => ['required', 'exists:deal_statuses,id'],
        ]);

        $deals = Deal::create([
            'car_name' => $request->car_name,
            'brand_name' => $request->brand_name,
            'price' => $request->price,
            'payment_method_id' => $request->payment_method_id,
            'deal_statuses_id' => $request->deal_statuses_id,
        ]);

        return response()->json(['message' => 'Deal added successfully', 'deal' => $deals]);
    }

    public function editDeals(Request $request, $id){
        $request->validate([
            'car_name' => ['required', 'string', 'max:255'],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'payment_method_id' => ['required', 'exists:payment_method_id,id'],
            'deal_statuses_id' => ['required', 'exists:deal_statuses_id,id'],
        ]);

        $deals = Deal::find($id);

        if(!$deals){
            return response()->json(['message' => 'Deal not found'], 404);
        }

        $deals->update([
            'car_name' => $request->car_name,
            'brand_name' => $request->brand_name,
            'price' => $request->price,
            'payment_method_id' => $request->payment_method_id,
            'deal_statuses_id' => $request->deal_statuses_id,
        ]);

        return response()->json(['message' => 'Deal updated successfully', 'deal' => $deals ]);
    }   

    public function deleteDeals($id){
        $deals = Deal::find($id);

        if(!$deals){
            return response()->json(['message' => 'Deal not found'], 404);
        }

        $deals->delete();

        return response()->json(['message' => 'Deal deleted successfully']);
    }

}
