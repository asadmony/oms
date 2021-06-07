<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Role\Agent;
use App\Models\Role\Dealer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class DealerRoleController extends Controller
{
    public function allAgents(Request $request, Dealer $dealer)
    {
        menuSubmenu('dashboard', 'allAgents');

        $agents = $dealer->agents()->orderBy('name')->paginate(1000);

        return view('dealer.agents.allAgents', [
            'dealer' => $dealer,
            'rolesAll' => $agents,
            'type' => 'agent',
        ]);
    }

    public function newAgentPost(Request $request, Dealer $dealer)
    {

        $validation = Validator::make($request->all(), [

            "user" => "required|exists:users,id",
            'title' => 'required|string',
            'title_bn' => 'required|string',
        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        $a = Agent::where('user_id', $request->user)->where('dealer_id', $dealer->id)->first();
        if ($a) {
            return back()->with('error', 'This user already agent.');
        }

        $agent = new Agent;

        $agent->user_id = $request->user;
        $agent->addedby_id = Auth::id();
        $agent->editedby_id = Auth::id();

        $agent->name = ['en' => $request->title, 'bn' => $request->title_bn];

        $agent->depo_id = $dealer->depo_id;
        $agent->division_id = $dealer->division_id;
        $agent->district_id = $dealer->district_id;
        $agent->distributor_id = $dealer->distributor_id;
        $agent->dealer_id = $dealer->id;
        $agent->upazila_id = $dealer->upazila_id;
        $agent->address = $request->address ?: null;
        $agent->contact_numbers = $request->contact_numbers ?: null;
        $agent->active = $request->active ? true : false;

        $agent->save();

        return back()->with('success', "New Agent Successfully Created.");
    }

    public function agentEdit(Request $request, Dealer $dealer, Agent $agent)
    {
        menuSubmenu('dashboard', 'allAgents');

        return view('dealer.agents.agentEdit', [
            'dealer' => $dealer,
            'agent' => $agent,
            'type' => 'agent',
        ]);
    }

    public function agentEditPost(Request $request, Dealer $dealer, Agent $agent)
    {
        $validation = Validator::make($request->all(), [

            "user" => "required|exists:users,id",
            'title' => 'required|string',
        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        if ($agent->user_id != $request->user) {
            $a = Agent::where('user_id', $request->user)->where('dealer_id', $dealer->id)->first();
            if ($a) {
                return back()->with('error', 'This user already agent.');
            }

            $agent->user_id = $request->user;
        }

        $agent->editedby_id = Auth::id();
        $agent->name = ['en' => $request->title, 'bn' => $request->title_bn];
        $agent->address = $request->address ?: null;
        $agent->contact_numbers = $request->contact_numbers ?: null;
        $agent->active = $request->active ? true : false;

        $agent->save();

        return back()->with('success', "Agent Successfully Updated.");
    }
}
