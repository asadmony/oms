<?php

namespace App\Http\Controllers\Web\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Role\Depo;
use App\Models\Role\Distributor;
use Jenssegers\Agent\Facades\Agent as DeviceAgent;

class WelcomeController extends Controller
{
    protected $device;
    protected $minutes = 120;

    public function __construct()
    {
        $this->middleware(['redirectDashboard']);
        // $this->device = 'theme.'.config('app.theme').'.';
        if (DeviceAgent::isDesktop()) {
            //$this->device = 'theme.'.config('app.theme').'.';
        } else {
            $this->device = 'mobile.'; //mobile and tab will use
        }

    }

    public function welcome()
    {
        return view('ecommerce.index');
        // return view($this->device . 'ecommerce.index');
    }


    public function getUpazilaByDistributor(Distributor $distributor)
    {
        return $distributor->district->thanas;
    }
    public function getDistrictByDepo(Depo $depo)
    {
        return $depo->division->districts;
    }
}
