<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\SaleCommission;
use App\Models\WebsiteBalance;
use Illuminate\Support\Facades\Artisan;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $totalOrderCount    = EcommerceOrder::count();
        $totalSales         = SaleCommission::sum('total_price');
        $totalCollections   = EcommercePaymentCollection::sum('paid_amount');
        $systemBalance      = WebsiteBalance::first()->system_balance;
        return view('admin.dashboard.dashboard',[
            'totalOrderCount' => $totalOrderCount,
            'totalSales' => $totalSales,
            'totalCollections' => $totalCollections,
            'systemBalance' => $systemBalance,
        ]);
    }

    public function getChartData()
    {
        // dd(now()->subMonths(1)->format('M'));
        $pendingOrderCount      = EcommerceOrder::where('order_status', 'pending')->count();
        $confirmedOrderCount    = EcommerceOrder::where('order_status', 'confirmed')->count();
        $processingOrderCount   = EcommerceOrder::where('order_status', 'processing')->count();
        $readyToShipOrderCount  = EcommerceOrder::where('order_status', 'ready_to_ship')->count();
        $shippedOrderCount      = EcommerceOrder::where('order_status', 'shipped')->count();
        $collectedOrderCount    = EcommerceOrder::where('order_status', 'collected')->count();
        $deliveredOrderCount    = EcommerceOrder::where('order_status', 'delivered')->count();
        $canceledOrderCount     = EcommerceOrder::where('order_status', 'canceled')->count();
        $orderChartData = [
                'labels' => [
                    'Pending', 
                    'Confirmed',
                    'Prcessing', 
                    'Ready To Ship', 
                    'Shipped', 
                    'Collected', 
                    'Delivered', 
                    'Canceled', 
                ],
                'datasets' => [
                    [
                        'data' => [$pendingOrderCount,$confirmedOrderCount,$processingOrderCount,$readyToShipOrderCount,$shippedOrderCount,$collectedOrderCount,$deliveredOrderCount,$canceledOrderCount],

                        'backgroundColor' => [ '#d2d6de','#00c0ef',  '#3c8dbc', '#ffeeaa', '#f39c12', '#f56954','#00a65a', '#FF0000'],
                    ]
                ],
            ];

        $thisMonthSale      = SaleCommission::whereMonth('created_at', now()->month)->sum('total_price');
        $thisMonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->month)->sum('paid_amount');
        $prev1MonthSale     = SaleCommission::whereMonth('created_at', now()->subMonths(1)->month)->sum('total_price');
        $prev1MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(1)->month)->sum('paid_amount');
        $prev2MonthSale     = SaleCommission::whereMonth('created_at', now()->subMonths(2)->month)->sum('total_price');
        $prev2MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(2)->month)->sum('paid_amount');
        $prev3MonthSale     = SaleCommission::whereMonth('created_at', now()->subMonths(3)->month)->sum('total_price');
        $prev3MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(3)->month)->sum('paid_amount');
        $prev4MonthSale     = SaleCommission::whereMonth('created_at', now()->subMonths(4)->month)->sum('total_price');
        $prev4MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(4)->month)->sum('paid_amount');
        $prev5MonthSale     = SaleCommission::whereMonth('created_at', now()->subMonths(5)->month)->sum('total_price');
        $prev5MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(5)->month)->sum('paid_amount');

        $paymentChartData = [
            'labels'  => [now()->subMonths(5)->format('M'),now()->subMonths(4)->format('M'),now()->subMonths(3)->format('M'),now()->subMonths(2)->format('M'), now()->subMonths(1)->format('M'), now()->format('M')],
            'datasets' => [
                [
                'label'               => 'Monthly Sales',
                'backgroundColor'     => 'rgba(60,141,188,0.9)',
                'borderColor'         => 'rgba(60,141,188,0.8)',
                'pointRadius'         => false,
                'pointColor'          => '#3b8bba',
                'pointStrokeColor'    => 'rgba(60,141,188,1)',
                'pointHighlightFill'  => '#fff',
                'pointHighlightStroke'=> 'rgba(60,141,188,1)',
                'data'                => [ $prev5MonthSale, $prev4MonthSale, $prev3MonthSale, $prev2MonthSale, $prev1MonthSale,$thisMonthSale]
                ],
                [
                'label'               => 'Monthly Payment Collection',
                'backgroundColor'     => 'rgba(210, 214, 222, 1)',
                'borderColor'         => 'rgba(210, 214, 222, 1)',
                'pointRadius'         => false,
                'pointColor'          => 'rgba(210, 214, 222, 1)',
                'pointStrokeColor'    => '#c1c7d1',
                'pointHighlightFill'  => '#fff',
                'pointHighlightStroke'=> 'rgba(220,220,220,1)',
                'data'                => [ $prev5MonthCollection, $prev4MonthCollection, $prev3MonthCollection, $prev2MonthCollection, $prev1MonthCollection,$thisMonthCollection]
                ],
            ],
        ];

        $data = [
            'orderChartData'    => $orderChartData,
            'paymentChartData'  => $paymentChartData,
        ];

        return response()->json($data, 200);
    }
}
