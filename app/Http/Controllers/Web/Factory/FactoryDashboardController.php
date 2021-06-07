<?php

namespace App\Http\Controllers\Web\Factory;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\ProductReplacement;
use App\Models\Shipment;
use Illuminate\Http\Request;

class FactoryDashboardController extends Controller
{
    public function index()
    {
        $orderCount = EcommerceOrder::whereNotIn('order_status', ['pending','canceled'])->count();
        $shipmentCount = Shipment::count();
        $inComOrderCount = EcommerceOrder::where('completed', 0)->whereNotIn('order_status', ['pending','canceled'])->count();
        $replacementCount = ProductReplacement::count();
        return view('factory.dashboard', [
            'orderCount' => $orderCount,
            'shipmentCount' => $shipmentCount,
            'inComOrderCount' => $inComOrderCount,
            'replacementCount' => $replacementCount,
        ]);
    }
}
