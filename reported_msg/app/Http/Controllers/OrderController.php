<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 
     * 
     */

     public function saveOrder(Request $request){

        $validated = $request->validate([
            'user_id' => 'required|integer',
            'event_id' => 'required|string',
            'order_id' => 'required|string',
            'amount' => 'required|integer',
            'timestamp' => 'required',
            'status' => 'required|string'
        ]);
        $order = Order::create($validated);

        return response()->json([
            'message' => 'Order Added Successfully',
            'order' => $order
        ], Response:: HTTP_CREATED);

        // return response()->json($order, 201);

     }

}
