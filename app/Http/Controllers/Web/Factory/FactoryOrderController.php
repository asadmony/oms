<?php

namespace App\Http\Controllers\Web\Factory;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;

class FactoryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EcommerceOrder $order)
    {
        menuSubmenu('orders', 'confirmed');
        $orders = $order->where('order_status', 'confirmed')->where('completed', '<>', true)->latest()->paginate(20);
        return view('factory.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EcommerceOrder $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function process(EcommerceOrder $order)
    {
        if (!$order->completed) {
            if ($order->order_status == 'confirmed' || $order->order_status == 'shipped' || $order->order_status == 'collected' || $order->order_status == 'delivered' ) {      
            return view('factory.order.process', [
                'order' => $order,
            ]);
            }
        }
        return redirect()->route('factory.orders.processing');
    }
    public function processSave(EcommerceOrder $order, Request $request)
    {
        $order->order_status = 'processing';
        $order->processing_at = now();
        $order->save();

        $shipment = new Shipment;
        // $shipment->user_id = $order->user_id;
        $shipment->order_id     = $order->id;
        $shipment->depo_id      = $order->depo_id;
        $shipment->distributor_id  = $order->distributor_id;
        $shipment->dealer_id    = $order->dealer_id;
        $shipment->agent_id     =  $order->agent_id;
        $shipment->division_id  = $order->division_id;
        $shipment->district_id  = $order->district_id;
        $shipment->upazila_id   = $order->upazila_id;
        $shipment->market_id    = $order->market_id  ?? null;
        $shipment->source_id    = $order->source_id ;
        $shipment->mobile       = $order->mobile  ?? null;
        $shipment->order_status  = $order->order_status;
        $shipment->processing_at  = $order->processing_at;
        $shipment->total_quantity  = $order->total_quantity;
        $shipment->approvedby_id  = auth()->user()->id;
        $shipment->total_price  = $order->total_price;
        $shipment->save();
        $totalShipmentPrice = 0;
        $collection = 0;
        foreach ($order->items as $item) {
            $key = 'process_qty_'.$item->id;
            if (isset($request[$key]) || !empty($request[$key] || $request[$key] > 0 )) {
                $shipmentItem = new ShipmentItem;
                $shipmentItem->order_id = $item->order_id ?? null;
                $shipmentItem->order_item_id = $item->id;
                $shipmentItem->shipment_id = $shipment->id;
                $shipmentItem->product_id = $item->product_id ?? null;
                $shipmentItem->product_name = $item->product_name ?? null;
                $shipmentItem->total_quantity = $item->total_quantity ?? null;
                $shipmentItem->unit_price = $item->unit_price ?? null;
                // $shipmentItem->user_id = $item->user_id ?? null;
                $shipmentItem->seller_source_id = $item->seller_source_id ?? null;
                $shipmentItem->buyer_source_id = $item->buyer_source_id  ?? null;
                $shipmentItem->depo_id = $item->depo_id ?? null;
                $shipmentItem->distributor_id = $item->distributor_id ?? null;
                $shipmentItem->dealer_id = $item->dealer_id ?? null;
                $shipmentItem->agent_id = $item->agent_id ?? null;
                $shipmentItem->division_id = $item->division_id ?? null;
                $shipmentItem->district_id = $item->district_id ?? null;
                $shipmentItem->upazila_id = $item->upazila_id ?? null;
                $shipmentItem->market_id = $item->market_id ?? null;
                $shipmentItem->approvedby_id  = auth()->user()->id;
                $shipmentItem->shipment_quantity = $request[$key];
                $shipmentItem->returned_quantity = 0;
                $shipmentItem->processing_at = $order->processing_at;
                $shipmentItem->total_price = $item->total_price;
                $shipmentItem->shipment_amount = $shipmentItem->shipment_quantity * $shipmentItem->unit_price;

                $shop_commission = $item->source()->commissionByProduct($item->product_id);
                $shop_payment = round($shipmentItem->shipment_amount - (($shipmentItem->shipment_amount/100)*$shop_commission), 2);
                    $item->collection_amount = $shop_payment;

                $shipmentItem->collection_amount = $shop_payment;
                $shipmentItem->save();
                
                $item->total_shipped_quantity = $item->total_shipped_quantity+$shipmentItem->shipment_quantity;
                $item->save();

                $totalShipmentPrice = $totalShipmentPrice + $shipmentItem->shipment_amount;
                $collection = $collection + $shipmentItem->collection_amount;
            }

        }
        $shipment->shipment_price  = $totalShipmentPrice;
        $shipment->total_collection_amount  = $collection;
        $shipment->save();
        

        return redirect()->route('factory.orders.processing')->with('success', 'Order is put on processing.');
    }
    public function ordersProcessing(Shipment $order)
    {
        menuSubmenu('orders', 'processing');
        $orders = $order->where('order_status', 'processing')->latest()->paginate(20);
        return view('factory.order.pricessing',[
            'orders' => $orders,
        ]);
    }

    public function readyToShipSave(Shipment $shipment)
    {

        $order = $shipment->order;
        $order->order_status = 'ready_to_ship';
        $order->ready_to_ship_at = now();
        $order->save();
        
        $shipment->order_status     = $order->order_status;
        $shipment->ready_to_ship_at = $order->ready_to_ship_at;
        $shipment->save();
        
        return redirect()->route('factory.orders.readyToShip')->with('success', 'Order is set to Ready to ship.');

    }
    public function ordersReadyToShip(Shipment $order)
    {
        menuSubmenu('orders', 'readyToShip');
        $orders = $order->where('order_status', 'ready_to_ship')->latest()->paginate(20);
        return view('factory.order.readyToShip',[
            'orders' => $orders,
        ]);
    }

    public function shipSave(Shipment $shipment)
    {
        $order = $shipment->order;
        $order->order_status = 'shipped';
        $order->shipped_at = now();
        $order->save();

        $shipment->order_status     = $order->order_status;
        $shipment->shipped_at       = $order->shipped_at;
        $shipment->save();

        $allShipped = 0;
        foreach ($order->items as $item) {
            if ($item->total_quantity > $item->total_shipped_quantity) {
                $allShipped++;
            }
        }
        if ($allShipped == 0) {
            $order->completed = true;
            $order->save();
        }

        return redirect()->route('factory.orders.shipped')->with('success', 'Order is Shipped.');
    }
    public function ordersShipped(Shipment $order)
    {
        menuSubmenu('orders', 'shipped');
        $orders = $order->where('order_status', 'shipped')->latest()->paginate(20);
        return view('factory.order.shipped',[
            'orders' => $orders,
        ]);
    }
    public function ordersIncomplete(EcommerceOrder $order)
    {
        menuSubmenu('orders', 'incomplete');
        $orders = $order->whereIn('order_status', ['shipped', 'collected', 'delivered'])->where('completed', '<>', true)->latest()->paginate(20);
        return view('factory.order.incomplete',[
            'orders' => $orders,
        ]);
    }
}
