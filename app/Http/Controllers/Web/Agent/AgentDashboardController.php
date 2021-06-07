<?php

namespace App\Http\Controllers\Web\Agent;

use App\Http\Controllers\Controller;
use App\Models\Role\Agent;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent as DeviceAgent;

class AgentDashboardController extends Controller
{
    protected $device;
    protected $minutes = 120;
    public function __construct()
    {
        // $this->middleware('locale');
        if (DeviceAgent::isDesktop()) {
            //$this->device = 'theme.'.config('app.theme').'.';
        } else {
            $this->device = 'mobile.'; //mobile and tab will use
        }
    }

    public function dashboard(Agent $agent, Request $request)
    {
        menuSubmenu('dashboard', 'dashboard');

        // return view('mobile.agent.index');
        return view('agent.dashboard.agentDashboard', ['agent' => $agent]);
    }

    public function index()
    {
        menuSubmenu('dashboard', 'dashboard');
        return view('mobile.agent.index');
        // return view($this->device . 'agent.index');
    }
    public function ecommerceIndex(Agent $agent)
    {
        if ($agent->user_id != auth()->user()->id){
            abort(401);
        }
        $agentship = $agent->load('dealer','division','district','upazila', 'markets');
        menuSubmenu('dashboard', 'dashboard');
        
        return view('mobile.agent.index',[
            'agent' => $agentship,
        ]);
        return view($this->device . 'agent.ecommerce.index',[
            'agent' => $agentship,
        ]);
    }
}
