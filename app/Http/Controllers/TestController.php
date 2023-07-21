<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function getDatas()
    {
        $datas = Customer::join('orders', 'orders.customer_id', '=', 'customers.id')
            ->get(['orders.employee_id', 'orders.order_date', 'customers.customer_name', 'customers.contact_name', 'customers.address', 'customers.city']);
        // Log::info($datas);
        return $datas;
    }
    public function saveDatas(Request $request)
    {
        log::info($request);

        $requestData = $request->all();
        if (count($requestData) > 0) {
            $customers = new Customer();
            $customers->customer_name = $request['customer_name'];
            $customers->contact_name = $request['contact_name'];
            $customers->address = $request['address'];
            $customers->city = $request['city'];
            $customers->postal_code = $request['postal_code'];
            $customers->country = $request['country'];
            $customers->created_at = Carbon::now();
            $customers->updated_at = Carbon::now();
            $customers->save();
        }
        return response()->json(['result' => true, 'message' => "New Customer Created"]);
    }
    public function saveOrderDatas(Request $request)
    {
        log::info($request);

        $requestData = $request->all();
        if (count($requestData) > 0) {
            $orders = new Order();
            $orders->customer_id = $request['customer_id'];
            $orders->employee_id = $request['employee_id'];
            $orders->order_date = $request['order_date'];
            $orders->shipper_id = $request['shipper_id'];
            $orders->created_at = Carbon::now();
            $orders->updated_at = Carbon::now();
            $orders->save();
        }
        return response()->json(['result' => true, 'message' => "New Ordre is Created"]);
    }
}
