<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Location\Market;
use App\Models\Role\Agent;
use Auth;
use Illuminate\Http\Request;
use Validator;

class DealerMarketController extends Controller
{
    public function allMarkets(Dealer $dealer, Request $request)
    {
        menuSubmenu('dashboard', 'allMarkets');

        $markets = $dealer->markets()->orderBy('name')->paginate(1000);
        $agents = $dealer->agents()->orderBy('name')->get();

        return view('dealer.markets.allMarkets', [
            'dealer' => $dealer,
            'markets' => $markets,
            'agents' => $agents,

        ]);
    }

    public function addNewMarketPost(Dealer $dealer, Request $request)
    {
        $validation = Validator::make($request->all(), [

            "name" => "required|min:3|max:255",
            'name_bn' => "required|min:3|max:255",
            'agent' => 'required|exists:agents,id',

        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');

        }

        $agent = Agent::find($request->agent);
        if ($agent and ($agent->dealer_id == $dealer->id)) {
            $market = new Market;

            $market->name = ['en' => $request->name, 'bn' => $request->name_bn];
            $market->depo_id = $agent->depo_id;
            $market->distributor_id = $agent->distributor_id;
            $market->dealer_id = $agent->dealer_id;
            $market->agent_id = $agent->id;

            $market->division_id = $agent->division_id;
            $market->district_id = $agent->district_id;
            $market->upazila_id = $agent->upazila_id;
            $market->active = $request->active ? true : false;
            $market->addedby_id = Auth::id();
            $market->save();

            return back()->with('success', "New Market Successfully Created.");
        }
    }

    public function marketEdit(Dealer $dealer, Request $request, Market $market)
    {
        menuSubmenu('dashboard', 'allMarkets');

        $agents = $dealer->agents()->orderBy('name')->get();

        return view('dealer.markets.marketEdit', [
            'dealer' => $dealer,
            'market' => $market,
            'agents' => $agents,
        ]);
    }

    public function marketEditPost(Request $request, Dealer $dealer, Market $market)
    {
        $validation = Validator::make($request->all(), [

            "name" => "required|min:3|max:255",
            'name_bn' => "required|min:3|max:255",
            'agent' => 'required|exists:agents,id',

        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');

        }

        if ($market->agent_id != $request->agent) {
            $agent = Agent::find($request->agent);
            if ($agent and ($agent->dealer_id == $dealer->id)) {
                $market->agent_id = $agent->id;
            }
        }

        $market->name = ['en' => $request->name, 'bn' => $request->name_bn];
        $market->active = $request->active ? true : false;
        $market->editedby_id = Auth::id();
        $market->save();

        return back()->with('success', "Market Successfully Updated.");
    }
}
