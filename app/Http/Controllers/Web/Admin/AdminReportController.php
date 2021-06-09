<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\SaleCommission;
use App\Models\ShipmentReturn;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, Request $request)
    {
        menuSubmenu('report', $type);
        $srs = Agent::all();
        $shops = EcommerceSource::all();
        if($type == 'order'){
            $orders = EcommerceOrder::where(function ($query) use ($request)
            {
                if ($request->time == 'today') {
                    $query->where('pending_at', '<=', now())->where('pending_at', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('pending_at', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('pending_at', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('pending_at', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('pending_at', '<=', now()->parse($request->to))->where('pending_at', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('pending_at', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('pending_at', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
                if ($request->status) {
                    $query->where('order_status', $request->status);
                }
            })->latest()->get();

            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'shops' => $shops,
                'orders' => $orders,
                'input' => $request->all(),
            ]);
        }elseif($type == 'collection'){
            $collections = EcommercePaymentCollection::where(function ($query) use ($request)
            {
                if ($request->time == 'today') {
                    $query->where('trans_date', '<=', now())->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('trans_date', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('trans_date', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('trans_date', '<=', now()->parse($request->to))->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('trans_date', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get();
            
            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'shops' => $shops,
                'collections' => $collections,
                'input' => $request->all(),
            ]);
        }elseif($type == 'return'){
            $returns = ShipmentReturn::where(function ($query) use ($request)
            {
                if ($request->time == 'today') {
                    $query->where('return_at', '<=', now())->where('return_at', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('return_at', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('return_at', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('return_at', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('return_at', '<=', now()->parse($request->to))->where('return_at', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('return_at', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('return_at', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get();
            
            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'shops' => $shops,
                'returns' => $returns,
                'input' => $request->all(),
            ]);
        }elseif($type == 'product'){
            $allProducts = EcommerceProduct::where('status', 'published')->get();
            $products = EcommerceProduct::where('status', 'published')->where(function ($query) use ($request){
                if ($request->products) {
                    $query->whereIn('id', $request->products);
                }
            })->whereHas('sales', function ($query) use ($request){
                if ($request->time == 'today') {
                    $query->where('created_at', '<=', now())->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('created_at', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('created_at', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('created_at', '<=', now()->parse($request->to))->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('created_at', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->paginate(50)->load('sales', 'returns');
            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'shops' => $shops,
                'products' => $products,
                'allProducts' => $allProducts,
                'input' => $request->all(),
            ]);
        }elseif($type == 'sr'){
            $agents = Agent::whereIn('id',$request->sr ?? [])->get();
            $collections = EcommercePaymentCollection::where(function ($query) use ($request)
            {
                if ($request->time == 'today') {
                    $query->where('trans_date', '<=', now())->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('trans_date', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('trans_date', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('trans_date', '<=', now()->parse($request->to))->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('trans_date', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get();
            $products = EcommerceProduct::where('status', 'published')->where(function ($query) use ($request){
                if ($request->products) {
                    $query->whereIn('id', $request->products);
                }
            })->whereHas('sales', function ($query) use ($request){
                if ($request->time == 'today') {
                    $query->where('created_at', '<=', now())->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('created_at', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('created_at', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('created_at', '<=', now()->parse($request->to))->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('created_at', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get()->load('sales', 'returns');
            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'agents' => $agents,
                'shops' => $shops,
                'collections' => $collections,
                'products' => $products,
                'input' => $request->all(),
            ]);
        }elseif($type == 'shop'){
            $sources = EcommerceSource::whereIn('id',$request->shop ?? [])->get();
            $collections = EcommercePaymentCollection::where(function ($query) use ($request)
            {
                if ($request->time == 'today') {
                    $query->where('trans_date', '<=', now())->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('trans_date', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('trans_date', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('trans_date', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('trans_date', '<=', now()->parse($request->to))->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('trans_date', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('trans_date', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get();
            $products = EcommerceProduct::where('status', 'published')->where(function ($query) use ($request){
                if ($request->products) {
                    $query->whereIn('id', $request->products);
                }
            })->whereHas('sales', function ($query) use ($request){
                if ($request->time == 'today') {
                    $query->where('created_at', '<=', now())->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'yesterday'){
                    $query->where('created_at', '>=', now()->subDays(1));
                }elseif($request->time == 'last_7_days'){
                    $query->where('created_at', '>=', now()->subDays(7));
                }elseif($request->time == 'last_month'){
                    $query->where('created_at', '>=', now()->subDays(30));
                }elseif ($request->from && $request->to) {
                    $query->where('created_at', '<=', now()->parse($request->to))->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->from){
                    $query->where('created_at', '>=', now()->parse($request->from));
                }elseif($request->to){
                    $query->where('created_at', '<=', now()->parse($request->to));
                }else{
                }
                if ($request->sr) {
                    $query->whereIn('agent_id', $request->sr);
                }
                if ($request->shop) {
                    $query->whereIn('source_id', $request->shop);
                }
            })->latest()->get()->load('sales', 'returns');
            return view('admin.report.index',[
                'type' => $type,
                'srs' => $srs,
                'sources' => $sources,
                'shops' => $shops,
                'collections' => $collections,
                'products' => $products,
                'input' => $request->all(),
            ]);
        }else{
            return redirect()->back();
        }

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
    public function edit($id)
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

    public function commissionList(SaleCommission $com)
    {
        menuSubmenu('commissions', 'all');
        $commissions = $com->latest()->paginate(50);
        return view('admin.ecommerce.commission.index', [
            'commissions' => $commissions,
        ]);
    }
}
