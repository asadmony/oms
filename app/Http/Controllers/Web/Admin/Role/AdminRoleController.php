<?php

namespace App\Http\Controllers\Web\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Location\District;
use App\Models\Location\Division;
use App\Models\Location\Upazila;
use App\Models\Role\Agent;
use App\Models\Role\Dealer;
use App\Models\Role\Depo;
use App\Models\Role\Distributor;
use App\Models\Role\MyRole;
use App\Models\SrCommission;
use App\Models\User;
use App\Models\WebsiteBalance;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRoleController extends Controller
{

    // public function depoDistDealerAutoAdd(Request $request)
    // {
    //     if($request->type == 'depo')
    //     {
    //         for ($i=0; $i < 20; $i++) {

    //             $j = $i + 1;

    //             $depo = new Depo;
    //             // $depo->user_id = $request->user;
    //             $depo->addedby_id = Auth::id();
    //             $depo->editedby_id = Auth::id();
    //             $depo->division_id = rand(1,8);
    //             $depo->name = 'Temporary Depo Name '.$j;
    //             $depo->address =  null;
    //             $depo->contact_numbers =  null;
    //             $depo->active = true;
    //             $depo->save();
    //         }

    //         return back()->with('success', 'Depo successfully saved');
    //     }

    //     if($request->type == 'distributor')
    //     {
    //         for ($i=0; $i < 64; $i++) {

    //             $j = $i + 1;

    //             $dis = District::find($j);
    //             $depo = Depo::where('division_id', $dis->division_id)->first();

    //             if($dis and $depo)
    //             {
    //                 $distributor = new Distributor;
    //                 // $distributor->user_id = $request->user;
    //                 $distributor->addedby_id = Auth::id();
    //                 $distributor->editedby_id = Auth::id();
    //                 $distributor->name = 'Temporary Distributor Name '.$j;
    //                 $distributor->depo_id = $depo->id;
    //                 $distributor->division_id = $depo->division_id;
    //                 $distributor->district_id = $dis->id;
    //                 $distributor->address = $request->address ?: null;
    //                 $distributor->contact_numbers = $request->contact_numbers ?: null;
    //                 $distributor->active = true;
    //                 $distributor->save();
    //             }

    //         }

    //         return back()->with('success', 'Distributor successfully saved');
    //     }

    //     if($request->type == 'dealer')
    //     {
    //         for ($i=0; $i < 579; $i++) {

    //             $j = $i + 1;

    //             $upazila = Upazila::find($j);
    //             $distributor = Distributor::where('district_id', $upazila->district_id)->first();

    //             if($distributor and $upazila)
    //             {
    //                 $dealer = new Dealer;
    //                 // $dealer->user_id = $request->user;
    //                 $dealer->addedby_id = Auth::id();
    //                 $dealer->editedby_id = Auth::id();
    //                 $dealer->name = 'Temporary Dealer Name '.$j;

    //                 $dealer->depo_id = $distributor->depo_id;
    //                 $dealer->division_id = $distributor->division_id;
    //                 $dealer->district_id = $distributor->district_id;
    //                 $dealer->distributor_id = $distributor->id;
    //                 $dealer->upazila_id =  $upazila->id;

    //                 $dealer->address = $request->address ?: null;
    //                 $dealer->contact_numbers = $request->contact_numbers ?: null;
    //                 $dealer->active = true;

    //                 $dealer->save();
    //             }

    //         }

    //         return back()->with('success', 'Dealer successfully saved');
    //     }

    //     if($request->type == 'agent')
    //     {
    //         for ($i=0; $i < 579; $i++)
    //         {
    //             $j = $i + 1;
    //             // $upazila = Upazila::find($j);
    //             $dealer = Dealer::where('upazila_id', $j)->first();

    //             if($dealer)
    //             {
    //                  for ($k=1; $k < 6; $k++)
    //                  {

    //                     $agent = new Agent;
    //                     // $agent->user_id = $request->user;
    //                     $agent->addedby_id = Auth::id();
    //                     $agent->editedby_id = Auth::id();
    //                     $agent->name = 'Temporary Agent Name '.$j. '-'. $k;

    //                     $agent->depo_id = $dealer->depo_id;
    //                     $agent->division_id = $dealer->division_id;
    //                     $agent->district_id = $dealer->district_id;
    //                     $agent->distributor_id = $dealer->distributor_id;
    //                     $agent->dealer_id = $dealer->id;
    //                     $agent->upazila_id =  $dealer->upazila_id;
    //                     $agent->address = $request->address ?: null;
    //                     $agent->contact_numbers = $request->contact_numbers ?: null;
    //                     $agent->active = true;
    //                     $agent->save();
    //                  }
    //             }
    //         }
    //         return back()->with('success', 'Agent successfully saved');
    //     }

    //     if($request->type == 'market')
    //     {
    //         for ($i=0; $i < 579; $i++)
    //         {
    //             $j = $i + 1;
    //             $dealer = Dealer::where('upazila_id', $j)->first();

    //             if($dealer)
    //             {
    //                  for ($k=1; $k < 6; $k++)
    //                  {

    //                     $market = new Market;
    //                     $market->addedby_id = Auth::id();
    //                     $market->editedby_id = Auth::id();
    //                     $market->name = 'Temporary Market Name '.$j. '-'. $k;

    //                     $market->depo_id = $dealer->depo_id;
    //                     $market->division_id = $dealer->division_id;
    //                     $market->district_id = $dealer->district_id;
    //                     $market->distributor_id = $dealer->distributor_id;
    //                     $market->dealer_id = $dealer->id;
    //                     $market->upazila_id =  $dealer->upazila_id;
    //                     $market->agent_id = $k;
    //                     $market->address = $request->address ?: null;
    //                     $market->active = true;
    //                     $market->save();
    //                  }
    //             }
    //         }
    //         return back()->with('success', 'Market successfully saved');
    //     }
    // }

    public function selectNewRole(Request $request)
    {
        $users = User::where('email', 'like', '%' . $request->q . '%')
        // ->orWhere('username', 'like', '%'.$request->q.'%')
        // ->orWhere('name', 'like', '%'.$request->q.'%')
            ->orWhere('mobile', 'like', '%' . $request->q . '%')
            ->select(['id', DB::raw('IFNULL(email, mobile) as email')])
        // ->select(['id','email','mobile'])
            ->take(30)->get();
        if ($users->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $users;
            }
        } else {
            if ($request->ajax()) {
                return $users;
            }
        }
    }

    public function userSearchAjax(Request $request)
    {
        $users = User::withoutGlobalScopes()->where('email', 'like', $request->q . '%')
            ->orWhere('username', 'like', $request->q . '%')
        // ->orWhere('name', 'like', $request->q.'%')
            ->orWhere('mobile', 'like', '%' . $request->q . '%')
            ->latest()
            ->take(40)
            ->get();

        if ($request->ajax()) {
            return Response()->json(['page' => view('admin.users.ajax.usersTbody', ['usersAll' => $users])->render()]);
        }
    }

    public function adminAddNewPost(Request $request)
    {
        if (isset($request->new_user_mobile)) {
            $validation = Validator::make($request->all(), [
                "new_user_mobile" => "required|string|max:255|unique:users,mobile",
                "nid" => "required|string|max:255",
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                "user" => "required|exists:users,id",
            ]);
        }
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        if ($request->new_user_mobile) {
            $randPass = rand(100000,999999);
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->new_user_mobile,
                'nid' => $request->nid ?? null,
                'password_temp' => $randPass,
                'password' => Hash::make($randPass),
                'addedby_type' => 'App\Models\User',
                'addedby_id' => auth()->user()->id,
            ]);
        }
        elseif($request->user){
            $user = User::find($request->user);
        }else{
            return redirect()->back()->with('error', 'Please, Fillup the form correctly.');
        }

        if ($user) {
            if (!$user->isAdmin()) {
                $user->myroles()->create([
                    'role_name' => 'admin',
                    'role_value' => 'Admin',
                    'nid' => $user->nid ?? null,
                    'addedby_id' => Auth::id(),
                ]);

                if (!$user->isCommonAdmin()) {

                    $user->myroles()->create([
                        'role_name' => 'common',
                        'role_value' => 'Admin',
                        'addedby_id' => Auth::id(),
                    ]);
                }

                return back()->with('success', 'New Admin Successfully Created.');
            } else {
                return back()->with('error', 'This User Already Admin.');
            }
        }
    }

    public function factoryAddNewPost(Request $request)
    {
        if (isset($request->new_user_mobile)) {
            $validation = Validator::make($request->all(), [
                "new_user_mobile" => "required|string|max:255|unique:users,mobile",
                "nid" => "required|string|max:255",
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                "user" => "required|exists:users,id",
            ]);
        }
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        if ($request->new_user_mobile) {
            $randPass = rand(100000,999999);
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->new_user_mobile,
                'nid' => $request->nid ?? null,
                'password_temp' => $randPass,
                'password' => Hash::make($randPass),
                'addedby_type' => 'App\Models\User',
                'addedby_id' => auth()->user()->id,
            ]);
        }
        elseif($request->user){
            $user = User::find($request->user);
        }else{
            return redirect()->back()->with('error', 'Please, Fillup the form correctly.');
        }
        if ($user) {
            if (!$user->isFactory()) {

                $user->myroles()->create([
                    'role_name' => 'factory',
                    'role_value' => 'Factory',
                    'nid' => $user->nid ?? null,
                    'addedby_id' => Auth::id(),
                ]);

                // if (!$user->isCommonAdmin()) {

                //     $user->roles()->create([
                //         'role_name' => 'common',
                //         'role_value' => 'Admin',
                //         'addedby_id' => Auth::id(),
                //     ]);
                // }

                return back()->with('success', 'New Factory Successfully Created.');
            } else {
                return back()->with('error', 'This User Already a Factory Person.');
            }
        }
    }

    public function adminsAll(Request $request)
    {
        menuSubmenu('roles', 'adminsAll');
        $usersAll = MyRole::has('user')->where('role_name', 'admin')->latest()->paginate(20);

        return view('admin.roles.adminsAll', [
            'usersAll' => $usersAll,
        ]);
    }
    public function factoryAll(Request $request)
    {
        menuSubmenu('roles', 'factoryAll');
        $usersAll = MyRole::has('user')->where('role_name', 'factory')->latest()->paginate(20);


        return view('admin.roles.factoryAll', [
            'usersAll' => $usersAll,
        ]);
    }

    public function adminDelete(MyRole $role, Request $request)
    {
        if ($role->user->id == Auth::id()) {
            return back()->with('error', 'Your Admin Role can not be deleted by yourself.');
        }

        $user = $role->user;
        $role->delete();
        $user->myroles()
            ->where('role_name', 'common')
            ->where('role_value', 'Admin')
            ->delete();

        return back()->with('success', 'Admin Successfully Deleted.');

    }

    public function factoryDelete(MyRole $role, Request $request)
    {
        if ($role->user->id == Auth::id()) {
            return back()->with('error', 'Your Admin Role can not be deleted by yourself.');
        }

        $user = $role->user;
        $role->delete();
        $user->myroles()
            ->where('role_name', 'common')
            ->where('role_value', 'Factory')
            ->delete();

        return back()->with('success', 'Admin Successfully Deleted.');

    }

    public function rolesAll(Request $request)
    {
        if ($request->type == 'depo') {
            $usersAll = Depo::orderBy('id')->paginate(100);

            $divisions = Division::orderBy('name')->get();

            menuSubmenu('roles', 'depo');
            
            return view('admin.roles.rolesAll', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
                'divisions' => $divisions,
            ]);

        }

        if ($request->type == 'distributor') {
            $usersAll = Distributor::orderBy('id')->paginate(100);

            $depos = Depo::all();

            $districts = District::orderBy('division_id')->get();

            menuSubmenu('roles', 'distributor');

            return view('admin.roles.rolesAll', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
                'depos' => $depos,
                'districts' => $districts,
            ]);

        }

        if ($request->type == 'dealer') {
            $usersAll = Dealer::orderBy('id')->paginate(100);

            $distributors = Distributor::all();

            $upazilas = Upazila::orderBy('district_id')->get();

            menuSubmenu('roles', 'dealer');

            return view('admin.roles.rolesAll', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
                'distributors' => $distributors,
                'upazilas' => $upazilas,
            ]);

        }

        // if($request->type == 'subdealer')
        // {
        //     $usersAll = Subdealer::has('user')->latest()->paginate(20);

        //     $dealers = Dealer::all();

        //     $thanas = Upazila::orderBy('division_id')
        //     ->orderBy('district_id')
        //     ->get();

        //     menuSubmenu('roles', 'subdealer');

        //     return view('admin.roles.rolesAll',[
        //         'rolesAll'=> $usersAll,
        //         'type' => $request->type,
        //         'dealers' => $dealers,
        //         'thanas' => $thanas
        //     ]);

        // }

        if ($request->type == 'agent') {
            $usersAll = Agent::orderBy('id')->paginate(200);

            $dealers = Dealer::all();

            menuSubmenu('roles', 'agent');

            $categories = EcommerceCategory::where('active', 1)->get();
            return view('admin.roles.rolesAll', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
                'dealers' => $dealers,
                'categories' => $categories,
            ]);

        }

        return back();
    }

    //b
    public function roleAddNewPost(Request $request)
    {
        $type = $request->type;
        if (isset($request->new_user_mobile)) {
            $validation = Validator::make($request->all(), [
                "new_user_mobile" => "required|string|max:255|unique:users,mobile",
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                "user" => "required|exists:users,id",
            ]);
        }
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        if ($request->new_user_mobile) {
            $randPass = rand(100000,999999);
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->new_user_mobile,
                'nid' => $request->nid ?? null,
                'password_temp' => $randPass,
                'password' => Hash::make($randPass),
                'addedby_type' => 'App\Models\User',
                'addedby_id' => auth()->user()->id,
            ]);
        }
        elseif($request->user){
            $user = User::find($request->user);
        }else{
            return redirect()->back()->with('error', 'Please, Fillup the form correctly.');
        }
        if ($type == 'depo') {
            $validation = Validator::make($request->all(), [
                'division' => "required|exists:divisions,id",
                'title' => 'required|string',
                "nid" => "required|string",
            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $depo = new Depo;
            $depo->user_id = $user->id;
            $depo->addedby_id = Auth::id();
            $depo->editedby_id = Auth::id();
            $depo->division_id = $request->division;
            $depo->nid = $request->nid ?: null;
            $depo->name = $request->title ?: null;
            $depo->address = $request->address ?: null;
            $depo->contact_numbers = $request->contact_numbers ?: null;
            $depo->active = $request->active ? true : false;
            $depo->save();

            return back()->with('success', "New {$type} Successfully Created.");
        }

        if ($type == 'distributor') {

            $validation = Validator::make($request->all(), [
                'district' => "required|exists:districts,id",
                'title' => 'required|string',
                'depo' => 'required|exists:depos,id',
                "nid" => "required|string",
            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $depo = Depo::find($request->depo);

            $dis = District::find($request->district);

            if ($dis->division_id != $depo->division_id) {
                return back()->with('error', 'Please, select the district correctly and try again');
            }

            $distributor = new Distributor;
            $distributor->user_id = $user->id;
            $distributor->addedby_id = Auth::id();
            $distributor->editedby_id = Auth::id();
            $distributor->name = $request->title ?: null;
            $distributor->depo_id = $request->depo;
            $distributor->division_id = $depo->division_id;
            $distributor->district_id = $dis->id;
            $distributor->nid = $request->nid ?: null;
            $distributor->address = $request->address ?: null;
            $distributor->contact_numbers = $request->contact_numbers ?: null;
            $distributor->active = $request->active ? true : false;
            $distributor->save();

            return back()->with('success', "New {$type} Successfully Created.");
        }

        if ($type == 'dealer') {

            $validation = Validator::make($request->all(), [

                'upazila' => "required|exists:upazilas,id",
                'title' => 'required|string',
                'distributor' => 'required|exists:distributors,id',
                'nid' => 'required|string',

            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $distributor = Distributor::find($request->distributor);

            $upazila = Upazila::find($request->upazila);

            if ($upazila->district_id != $distributor->district_id) {
                return back()->with('error', 'Please, select the upazila correctly and try again');
            }

            $dealer = new Dealer;
            $dealer->user_id = $user->id;
            $dealer->addedby_id = Auth::id();
            $dealer->editedby_id = Auth::id();
            $dealer->name = $request->title ?: null;

            $dealer->depo_id = $distributor->depo_id;
            $dealer->division_id = $distributor->division_id;
            $dealer->district_id = $distributor->district_id;
            $dealer->distributor_id = $distributor->id;
            $dealer->upazila_id = $upazila->id;

            $dealer->nid = $request->nid ?: null;
            $dealer->address = $request->address ?: null;
            $dealer->contact_numbers = $request->contact_numbers ?: null;
            $dealer->active = $request->active ? true : false;

            $dealer->save();

            return back()->with('success', "New {$type} Successfully Created.");
        }

        if ($type == 'agent') {

            $validation = Validator::make($request->all(), [

                'title' => 'required|string',
                'dealer' => 'required|exists:dealers,id',
                "nid" => "required|string",

            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $dealer = Dealer::find($request->dealer);

            $agent = new Agent;
            $agent->user_id = $user->id;
            $agent->addedby_id = Auth::id();
            $agent->editedby_id = Auth::id();
            $agent->name = $request->title ?: null;

            $agent->depo_id = $dealer->depo_id;
            $agent->division_id = $dealer->division_id;
            $agent->district_id = $dealer->district_id;
            $agent->distributor_id = $dealer->distributor_id;
            $agent->dealer_id = $dealer->id;
            $agent->upazila_id = $dealer->upazila_id;
            $agent->nid = $request->nid ?: null;
            $agent->monthly_target = $request->monthly_target ?: null;
            $agent->address = $request->address ?: null;
            $agent->contact_numbers = $request->contact_numbers ?: null;
            $agent->active = $request->active ? true : false;
            $agent->save();

            foreach ($request->all() as $key => $value) {
                $cat = str_split($key, 9);
                if ($cat[0] == 'category_' && $value > 0) {
                    $categoryId = intval($cat[1]);
                    
                    $srCom = new SrCommission;
                    $srCom->user_id = $user->id;
                    $srCom->agent_id = $agent->id;
                    $srCom->category_id = $categoryId;
                    $srCom->commission = $value;
                    $srCom->addedby_id = auth()->user()->id;
                    $srCom->save();
                }
            }

            return back()->with('success', "New SR Successfully Created.");
        }

        return back();

    }

    public function roleEdit(Request $request)
    {
        $wb = WebsiteBalance::first();
        $type = $request->type;

        if ($type == 'depo') {
            $admin = Depo::find($request->role);
            $divisions = Division::orderBy('name')->get();

            return view('admin.roles.roleEdit', [
                'admin' => $admin,
                'type' => $request->type,
                'divisions' => $divisions,
                'wb' => $wb,
            ]);

        } elseif ($type == 'distributor') {
            $admin = Distributor::find($request->role);
            $depos = Depo::all();

            $districts = District::orderBy('division_id')->get();

            return view('admin.roles.roleEdit', [
                'admin' => $admin,
                'type' => $request->type,
                'depos' => $depos,
                'districts' => $districts,
                'wb' => $wb,
            ]);

        } elseif ($type == 'dealer') {
            $admin = Dealer::find($request->role);
            $distributors = Distributor::all();

            $upazilas = Upazila::orderBy('district_id')->get();

            return view('admin.roles.roleEdit', [
                'admin' => $admin,
                'type' => $request->type,
                'distributors' => $distributors,
                'upazilas' => $upazilas,
                'wb' => $wb,
            ]);
        } elseif ($type == 'agent') {
            $admin = Agent::find($request->role);
            $dealers = Dealer::all();
            $srCommissions = $admin->commissions;
            $categories = EcommerceCategory::where('active', 1)->get();
            return view('admin.roles.roleEdit', [
                'admin' => $admin,
                'type' => $request->type,
                'dealers' => $dealers,
                'wb' => $wb,
                'srCommissions' => $srCommissions,
                'categories' => $categories,
            ]);
        }
    }

    public function roleEditPost(Request $request)
    {
        $type = $request->type;
        if (isset($request->new_user_mobile)) {
            $validation = Validator::make($request->all(), [
                "new_user_mobile" => "required|string|max:255|unique:users,mobile",
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                // "user" => "required|exists:users,id",
            ]);
        }
        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');
        }

        if ($request->new_user_mobile) {
            $randPass = rand(100000,999999);
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->new_user_mobile,
                // 'email' => $request->email,
                'password_temp' => $randPass,
                'password' => Hash::make($randPass),
                'addedby_type' => 'App\Models\User',
                'addedby_id' => auth()->user()->id,
            ]);
        }
        elseif($request->user){
            $user = User::find($request->user);
        }else{
            return redirect()->back()->with('error', 'Please, Fillup the form correctly.');
        }
        if ($type == 'depo') {
            $validation = Validator::make($request->all(), [

                // "user" => "required|exists:users,id",
                'division' => "nullable|exists:divisions,id",
                'title' => 'required|string',
                'nid' => 'required|string',

            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $depo = Depo::find($request->role);
            $depo->user_id = $user->id ?: null;
            $depo->editedby_id = Auth::id();

            if (!$depo->distributors->count()) {
                $depo->division_id = $request->division;
            }

            $depo->name = $request->title ?: null;
            $depo->address = $request->address ?: null;
            $depo->nid = $request->nid ?: null;
            $depo->contact_numbers = $request->contact_numbers ?: null;
            $depo->active = $request->active ? true : false;
            $depo->save();

            return back()->with('success', "{$type} Successfully Updated.");
        }

        if ($type == 'distributor') {
            $validation = Validator::make($request->all(), [

                // "user" => "required|exists:users,id",
                'district' => "nullable|exists:districts,id",
                'depo' => 'nullable|exists:depos,id',
                'title' => 'required|string',
                'nid' => 'required|string',

            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $distributor = Distributor::find($request->role);

            if (!$distributor->dealers->count()) {

                $depo = Depo::find($request->depo);

                $dis = District::find($request->district);

                if ($dis->division_id != $depo->division_id) {
                    return back()->with('error', 'Please, select the district correctly and try again');
                }

                $distributor->depo_id = $request->depo;
                $distributor->division_id = $depo->division_id;
                $distributor->district_id = $dis->id;
            }

            $distributor->user_id = $user->id ?: null;
            $distributor->editedby_id = Auth::id();
            $distributor->name = $request->title ?: null;
            $distributor->nid = $request->nid ?: null;

            $distributor->address = $request->address ?: null;
            $distributor->contact_numbers = $request->contact_numbers ?: null;
            $distributor->active = $request->active ? true : false;
            $distributor->save();

            return back()->with('success', "{$type} Successfully Updated.");
        }

        if ($type == 'dealer') {
            $validation = Validator::make($request->all(), [

                // "user" => "required|exists:users,id",
                'upazila' => "nullable|exists:upazilas,id",
                'distributor' => 'nullable|exists:distributors,id',
                'title' => 'required|string',
                'nid' => 'required|string',

            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');

            }

            $dealer = Dealer::find($request->role);

            if (!$dealer->agents->count()) {

                $distributor = Distributor::find($request->distributor);

                $upazila = Upazila::find($request->upazila);

                if ($upazila->district_id != $distributor->district_id) {
                    return back()->with('error', 'Please, select the upazila correctly and try again');
                }

                $dealer->depo_id = $distributor->depo_id;
                $dealer->division_id = $distributor->division_id;
                $dealer->district_id = $distributor->district_id;
                $dealer->distributor_id = $distributor->id;
                $dealer->upazila_id = $upazila->id;

            }

            $dealer->user_id = $user->id ?: null;
            $dealer->editedby_id = Auth::id();
            $dealer->name = $request->title ?: null;

            $dealer->address = $request->address ?: null;
            $dealer->contact_numbers = $request->contact_numbers ?: null;
            $dealer->active = $request->active ? true : false;

            $dealer->save();

            return back()->with('success', "{$type} Successfully Updated.");
        }

        if ($type == 'agent') {

            $validation = Validator::make($request->all(), [

                // "user" => "required|exists:users,id",
                'title' => 'required|string',
                'dealer' => 'required|exists:dealers,id',
                'nid' => 'required|string',
            ]);

            if ($validation->fails()) {
                return back()
                    ->withErrors($validation)
                    ->withInput()
                    ->with('error', 'Please, Fillup the form correctly.');
            }

            $dealer = Dealer::find($request->dealer);

            $agent = Agent::find($request->role);

            $agent->user_id = $user->id ?: null;
            $agent->editedby_id = Auth::id();
            $agent->name = $request->title ?: null;
            $agent->nid = $request->nid ?: null;

            $agent->division_id = $dealer->division_id;
            $agent->district_id = $dealer->district_id;
            $agent->upazila_id = $dealer->upazila_id;

            $agent->depo_id = $dealer->depo_id;
            $agent->distributor_id = $dealer->distributor_id;
            $agent->dealer_id = $dealer->id;

            $agent->monthly_target = $request->monthly_target ?: $agent->monthly_target;
            $agent->address = $request->address ?: null;
            $agent->contact_numbers = $request->contact_numbers ?: null;
            $agent->active = $request->active ? true : false;

            $agent->save();

            foreach ($request->all() as $key => $value) {
                $cat = str_split($key, 9);
                if ($cat[0] == 'category_' && $value > 0) {
                    $categoryId = intval($cat[1]);
                    $srCom = SrCommission::where('category_id', $categoryId)->where('agent_id', $agent->id)->first();
                    if (!$srCom) {
                        $srCom = new SrCommission;
                    }
                    $srCom->user_id = $user->id;
                    $srCom->agent_id = $agent->id;
                    $srCom->category_id = $categoryId;
                    $srCom->commission = $value;
                    $srCom->editedby_id = auth()->user()->id;
                    $srCom->save();
                }
            }

            return back()->with('success', "New {$type} Successfully Created.");
        }

        return back();

    }

    public function rolesAllType(Request $request)
    {
        $type = $request->type;

        // if($type == 'depo')
        // {
        //     menuSubmenu('roles', 'depo');

        //     $admins = Depo::orderBy('division_id')->get();
        // }
        // elseif($type == 'distributor')
        // {
        //     menuSubmenu('roles', 'distributor');

        //     $admins = Distributor::orderBy('division_id')->get();
        // }
        // elseif($type == 'dealer')
        // {
        //     menuSubmenu('roles', 'dealer');

        //     $admins = Dealer::orderBy('division_id')->get();
        // }
        // elseif($type == 'agent')
        // {
        //     menuSubmenu('roles', 'agent');

        //     $admins = Agent::orderBy('division_id')->get();
        // }

        $divisions = Division::all();

        return view('admin.roles.rolesAllType', [
            // 'admins' => $admins,
            'type' => $type,
            'divisions' => $divisions,
        ]);
    }

    public function paymentAddToRole(Request $request)
    {
        $type = $request->type;

        $validation = Validator::make($request->all(), [

            'amount' => 'required|numeric|min:1',

        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');

        }

        $wb = WebsiteBalance::first();
        $amount = $request->amount;

        if ($wb < $amount) {
            return back()->with('error', 'Sorry, balance unavailable.');
        }

        if ($type == 'depo') {
            $depo = Depo::find($request->role);
            $pb = $depo->balance;
            $depo->balance = $pb + $amount;
            $depo->editedby_id = Auth::id();
            $depo->save();

            $wb->system_balance = $wb->system_balance - $amount;
            $wb->save();

            $rp = $depo->roleToPayments()->create([
                'from' => 'system',
                'previous_balance' => $pb,
                'transfer_amount' => $amount,
                'current_balance' => $depo->balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'system_balance',
                'payment_status' => 'completed',
                'roleby_id' => $wb->id,
                'roleby_type' => WebsiteBalance::class,
                'note' => $request->description ?: null,
            ]);

        } elseif ($type == 'distributor') {
            $dist = Distributor::find($request->role);
            $pb = $dist->balance;
            $dist->balance = $pb + $amount;
            $dist->editedby_id = Auth::id();
            $dist->save();

            $wb->system_balance = $wb->system_balance - $amount;
            $wb->save();

            $rp = $dist->roleToPayments()->create([
                'from' => 'system',
                'previous_balance' => $pb,
                'transfer_amount' => $amount,
                'current_balance' => $dist->balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'system_balance',
                'payment_status' => 'completed',
                'roleby_id' => $wb->id,
                'roleby_type' => WebsiteBalance::class,
                'note' => $request->description ?: null,
            ]);

        } elseif ($type == 'dealer') {
            $dealer = Dealer::find($request->role);
            $pb = $dealer->balance;
            $dealer->balance = $pb + $amount;
            $dealer->editedby_id = Auth::id();
            $dealer->save();

            $wb->system_balance = $wb->system_balance - $amount;
            $wb->save();

            $rp = $dealer->roleToPayments()->create([
                'from' => 'system',
                'previous_balance' => $pb,
                'transfer_amount' => $amount,
                'current_balance' => $dealer->balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'system_balance',
                'payment_status' => 'completed',
                'roleby_id' => $wb->id,
                'roleby_type' => WebsiteBalance::class,
                'note' => $request->description ?: null,
            ]);

        } elseif ($type == 'agent') {
            $agent = Agent::find($request->role);
            $pb = $agent->balance;
            $agent->balance = $pb + $amount;
            $agent->editedby_id = Auth::id();
            $agent->save();

            $wb->system_balance = $wb->system_balance - $amount;
            $wb->save();

            $rp = $agent->roleToPayments()->create([
                'from' => 'system',
                'previous_balance' => $pb,
                'transfer_amount' => $amount,
                'current_balance' => $agent->balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'system_balance',
                'payment_status' => 'completed',
                'roleby_id' => $wb->id,
                'roleby_type' => WebsiteBalance::class,
                'note' => $request->description ?: null,
            ]);
        }

        return back()->with('success', 'Balance Transfer successful.');

    }

    public function paymentReceiveFromRole(Request $request)
    {
        $type = $request->type;

        $validation = Validator::make($request->all(), [

            'receive_amount' => 'required|numeric|min:1',

        ]);

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Please, Fillup the form correctly.');

        }

        $wb = WebsiteBalance::first();
        $amount = $request->receive_amount;

        if ($type == 'depo') {

            $depo = Depo::find($request->role);
            $pb = $depo->balance;

            if ($pb < $amount) {
                return back()->with('error', 'Sorry, balance unavailable.');
            }

            $depo->balance = $pb - $amount;
            $depo->editedby_id = Auth::id();
            $depo->save();

            $wpb = $wb->system_balance;
            $wb->system_balance = $wpb + $amount;
            $wb->save();

            $rp = $wb->roleToPayments()->create([
                'from' => 'depo',
                'previous_balance' => $wpb,
                'transfer_amount' => $amount,
                'current_balance' => $wb->system_balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'depo_balance',
                'payment_status' => 'completed',
                'roleby_id' => $depo->id,
                'roleby_type' => Depo::class,
                'note' => $request->note ?: null,
            ]);

        } elseif ($type == 'distributor') {
            $dist = Distributor::find($request->role);
            $pb = $dist->balance;

            if ($pb < $amount) {
                return back()->with('error', 'Sorry, balance unavailable.');
            }

            $dist->balance = $pb - $amount;
            $dist->editedby_id = Auth::id();
            $dist->save();

            $wpb = $wb->system_balance;
            $wb->system_balance = $wpb + $amount;
            $wb->save();

            $rp = $wb->roleToPayments()->create([
                'from' => 'distributor',
                'previous_balance' => $wpb,
                'transfer_amount' => $amount,
                'current_balance' => $wb->system_balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'distributor_balance',
                'payment_status' => 'completed',
                'roleby_id' => $dist->id,
                'roleby_type' => Distributor::class,
                'note' => $request->note ?: null,
            ]);

        } elseif ($type == 'dealer') {
            $dealer = Dealer::find($request->role);
            $pb = $dealer->balance;

            if ($pb < $amount) {
                return back()->with('error', 'Sorry, balance unavailable.');
            }

            $dealer->balance = $pb - $amount;
            $dealer->editedby_id = Auth::id();
            $dealer->save();

            $wpb = $wb->system_balance;
            $wb->system_balance = $wpb + $amount;
            $wb->save();

            $rp = $wb->roleToPayments()->create([
                'from' => 'dealer',
                'previous_balance' => $wpb,
                'transfer_amount' => $amount,
                'current_balance' => $wb->system_balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'dealer_balance',
                'payment_status' => 'completed',
                'roleby_id' => $dealer->id,
                'roleby_type' => Dealer::class,
                'note' => $request->note ?: null,
            ]);

        } elseif ($type == 'agent') {
            $agent = Agent::find($request->role);
            $pb = $agent->balance;

            if ($pb < $amount) {
                return back()->with('error', 'Sorry, balance unavailable.');
            }

            $agent->balance = $pb - $amount;
            $agent->editedby_id = Auth::id();
            $agent->save();

            $wpb = $wb->system_balance;
            $wb->system_balance = $wpb + $amount;
            $wb->save();

            $rp = $wb->roleToPayments()->create([
                'from' => 'agent',
                'previous_balance' => $wpb,
                'transfer_amount' => $amount,
                'current_balance' => $wb->system_balance,
                'addedby_id' => Auth::id(),
                'payment_type' => 'agent_balance',
                'payment_status' => 'completed',
                'roleby_id' => $agent->id,
                'roleby_type' => Agent::class,
                'note' => $request->note ?: null,
            ]);
        }

        return back()->with('success', 'Balance Transfer successful.');

    }

    // public function roleDelete(MyRole $role, Request $request)
    // {

    //     $user = $role->user;
    //     $role->delete();
    //     $user->roleItems()->delete();

    //     return back()->with('success', 'Role Successfully Deleted.');

    // }

    // public function rolesAll()
    // {
    //     request()->session()->forget(['lsbm','lsbsm']);
    //     request()->session()->put(['lsbm'=>'roles','lsbsm'=>'rolesAll']);

    //     $roles = MyRole::has('user')
    //             ->where('role_name', 'common')
    //             ->where('role_value', '<>', 'Admin')
    //             ->latest()
    //             ->paginate(20);

    //     return view('admin.roles.rolesAll', ['rolesAll'=>$roles]);
    // }

    // public function roleAddNew()
    // {
    //     request()->session()->forget(['lsbm','lsbsm']);
    //     request()->session()->put(['lsbm'=>'roles','lsbsm'=>'roleAddNew']);

    //     $branches = Branch::all();
    //     return view('admin.roles.roleAddNew',[
    //         'branches'=> $branches
    //     ]);
    // }

    // public function roleAddNewPost(Request $request)
    // {

    //     $validation = Validator::make($request->all(),
    //     [
    //         'branch' => 'numeric',
    //         'role_value' => 'required',
    //         'items' => 'required',
    //         'email' => 'required|email'
    //     ]);
    //     if($validation->fails())
    //     {
    //         return back()
    //         ->withErrors($validation)
    //         ->withInput()
    //         ->with('error', 'Something went wrong.');
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     if($user)
    //     {

    //         if (!$user->isCommonWithoutAdmin())
    //         {

    //             if($request->items)
    //             {
    //                $r =  $user->roles()->create([
    //                     'role_name'=>'common',
    //                     'role_value'=> $request->role_value,
    //                     'branch_id' => $request->branch ?: 0,
    //                     'addedby_id'=>Auth::id()
    //                 ]);

    //                 foreach ($request->items as $item)
    //                 {
    //                     $user->roleItems()->create([
    //                         'role_id' => $r->id,
    //                         'name' => $item,
    //                         'addedby_id' => Auth::id()
    //                     ]);
    //                 }

    //                 return back()->with('success', 'New Role Successfully Created.');
    //             }
    //         }

    //         return back()->with('error', 'This user already has a role.');
    //     }
    // }

    public function searchRoles(Request $request)
    {
        if ($request->type == 'depo') {
            $usersAll = Depo::orderBy('id', 'DESC')->where(function ($query) use ($request){
                $query->where('name', 'LIKE', "%{$request->q}%")
                ->orWhere('nid', 'LIKE', "%{$request->q}%");
            })->orWhereHas('user', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            menuSubmenu('roles', 'depo');
            
            return view('admin.roles.parts.rolesTableBody', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
            ]);
        }

        if ($request->type == 'distributor') {
            $usersAll = Distributor::orderBy('id', 'DESC')->where(function ($query) use ($request){
                $query->where('name', 'LIKE', "%{$request->q}%")
                ->orWhere('nid', 'LIKE', "%{$request->q}%");
            })->orWhereHas('user', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();


            menuSubmenu('roles', 'distributor');

            return view('admin.roles.parts.rolesTableBody', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
            ]);

        }

        if ($request->type == 'dealer') {
            $usersAll = Dealer::orderBy('id', 'DESC')->where(function ($query) use ($request){
                $query->where('name', 'LIKE', "%{$request->q}%")
                ->orWhere('nid', 'LIKE', "%{$request->q}%");
            })->orWhereHas('user', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            menuSubmenu('roles', 'dealer');

            return view('admin.roles.parts.rolesTableBody', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
            ]);

        }

        if ($request->type == 'agent') {
            $usersAll = Agent::orderBy('id', 'DESC')->where(function ($query) use ($request){
                $query->where('name', 'LIKE', "%{$request->q}%")
                    ->orWhere('nid', 'LIKE', "%{$request->q}%");
            })->orWhereHas('user', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            menuSubmenu('roles', 'agent');

            return view('admin.roles.parts.rolesTableBody', [
                'rolesAll' => $usersAll,
                'type' => $request->type,
            ]);

        }
    }

    //user admin role

}
