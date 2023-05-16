<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //Create new order
    public function createOrder(Request $request)
    {
        try {

            $userId = $request['user_id'];
            $productList = json_decode($request['product_list'], true);

            if (isset($userId) && isset($productList)) {

                $order = new Order;
                $order->order_date = Carbon::now();
                $order->created_at = Carbon::now();
                $order->updated_at = Carbon::now();
                $order->user_id = $userId;
                $order->save();


                if ($order->wasRecentlyCreated) {
                    $orderId = $order->id;

                    foreach ($productList['productList'] as $product) {

                        $orderItem = new OrderItem;
                        $orderItem->order_id = $orderId;
                        $orderItem->user_id = $userId;
                        $orderItem->product_id = $product['productId'];
                        $orderItem->quantity = $product['quantity'];
                        $orderItem->created_at = Carbon::now();
                        $orderItem->updated_at = Carbon::now();
                        $orderItem->save();
                    }

                    // if($){}
                    $result['order_id'] = $orderId;
                    $response['success'] = true;
                    $response['status'] = 1;
                    $response['message'] = 'create successfully';
                    $response['result'] = $result;

                    return $response;
                } else {

                    return response([
                        "success" => false,
                        "status" => 4,
                        "message" => 'could not save the order items',
                    ]);
                }
            } else {
                return response([
                    "success" => false,
                    "status" => 3,
                    "message" => 'missing input requierd',
                ]);
            }
        } catch (\Throwable $exception) {

            $response['success'] = false;
            $response['status'] = 5;
            $response['message'] = 'Something went wrong';
            $response['result'] = $exception;
            return response($response);
        }
    }

    public function getMostPopuler()
    {
        try {
            $sixMonthsAgo = now()->subMonths(6)->startOfMonth();
            $currentMonth = now()->startOfMonth();

            $query = DB::table('orders')
                ->join('orderitems', 'orders.id', '=', 'orderitems.order_id')
                ->join('products', 'orderitems.product_id', '=', 'products.id')
                ->select('products.id', 'products.product_name', DB::raw('SUM(orderitems.quantity) as total_quantity'))
                ->whereBetween('orders.created_at', [$sixMonthsAgo, $currentMonth])
                ->groupBy('products.id', 'products.product_name')
                ->orderBy('total_quantity', 'desc');

            $result = collect();

            // Iterate over the last 6 months
            for ($i = 0; $i < 6; $i++) {
                $monthStart = $currentMonth->copy()->subMonths($i)->startOfMonth();
                $monthEnd = $currentMonth->copy()->subMonths($i)->endOfMonth();

                $monthProducts = clone $query;
                $monthProducts->whereBetween('orders.created_at', [$monthStart, $monthEnd]);

                // Get the top ordered product for the month
                $topProduct = $monthProducts->first();


                if ($topProduct) {
                    $result->push($topProduct);
                }
            }

            $response['success'] = true;
            $response['status'] = 1;
            $response['message'] = 'success';
            $response['result'] = $result;
            return $result;
        } catch (\Throwable $exception) {

            $response['success'] = false;
            $response['status'] = 5;
            $response['message'] = 'Something went wrong';
            $response['result'] = $exception;
            return response($response);
        }
    }
}
