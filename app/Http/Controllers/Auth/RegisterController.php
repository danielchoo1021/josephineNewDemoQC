<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\User;
use App\Merchant;
use App\Agent;
use App\Corporate;
use App\Affiliate;
use App\AgentLevel;
use App\State;
use App\Product;
use App\Transaction;
use App\TransactionDetail;
use App\SettingShippingFee;

use App\Http\Controllers\GlobalController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use DB, Auth, Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $countries = GlobalController::global_countries();

        $refferer_name = '';
        if(!empty(request('p'))){
            $merchant = Merchant::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.request('p').'%')->where('status', '1')->first();
            $admin = Admin::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.request('p').'%')->where('status', '1')->first();
            $user = User::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.request('p').'%')->where('status', '1')->where('lvl', '1')->first();

            if(!empty($merchant->id)){
                $refferer_name = $merchant->f_name;
            }elseif(!empty($admin->id)){
                $refferer_name = $admin->f_name;
            }elseif(!empty($user->id)){
                $refferer_name = $user->f_name;
            }
        }

        return view('auth.register', compact('countries', 'refferer_name'));
    }

    /**
     * Handle a registration request for the application.
     *
     * Overrides the default trait behaviour: instead of auto-logging the
     * new account in and redirecting straight to the homepage, we flash
     * the account's login details to the session so a success modal can
     * show them and let the user choose to proceed to login or go home.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // An already-logged-in agent/merchant/admin can use this same form to
        // register a downline on their behalf. In that case they are not the
        // one who needs to log in, so skip the "Proceed to Login" prompt.
        $assistedRegistration = Auth::guard('agent')->check()
            || Auth::guard('merchant')->check()
            || Auth::guard('admin')->check();

        $user = $this->create($request->all());

        event(new Registered($user));

        $pendingApproval = $assistedRegistration && (string) $user->status === '99';

        Session::flash('registration_success', [
            'login_id' => $user->email,
            'code' => $user->display_code . $user->display_running_no,
            'login_route' => $assistedRegistration ? null : route('login'),
            'pending_approval' => $pendingApproval,
        ]);

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'country_code' => ['required'],
            'phone' => ['required', 'unique:users', 'unique:merchants', 'unique:agents'],
            'f_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:merchants', 'unique:agents', 'unique:admins', 'unique:staff'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function MemberCode()
    {
        $user = User::select(DB::raw("COUNT(id) AS totalUser"))->first();
        $totalCount = $user->totalUser + 1;

        if(strlen($totalCount) == '1'){
            $member_id = "Mb00000".$totalCount;
        }elseif(strlen($totalCount) == '2'){
            $member_id = "Mb0000".$totalCount;
        }elseif(strlen($totalCount) == '3'){
            $member_id = "Mb000".$totalCount;
        }elseif(strlen($totalCount) == '4'){
            $member_id = "Mb00".$totalCount;
        }elseif(strlen($totalCount) == '5'){
            $member_id = "Mb0".$totalCount;
        }else{
            $member_id = "Mb".$totalCount;
        }

        return $member_id;
    }

    protected function MerchantCode()
    {
        $user = Merchant::select(DB::raw("COUNT(id) AS totalUser"))->first();
        $totalCount = $user->totalUser + 1;

        if(strlen($totalCount) == '1'){
            $member_id = "M00000".$totalCount;
        }elseif(strlen($totalCount) == '2'){
            $member_id = "M0000".$totalCount;
        }elseif(strlen($totalCount) == '3'){
            $member_id = "M000".$totalCount;
        }elseif(strlen($totalCount) == '4'){
            $member_id = "M00".$totalCount;
        }elseif(strlen($totalCount) == '5'){
            $member_id = "M0".$totalCount;
        }else{
            $member_id = "M".$totalCount;
        }

        return $member_id;
    }

    protected function create(array $data)
    {
        if(!empty(Session::get('guest_agent'))){
          $master_id = Session::get('guest_agent');
        }else{
          $master_id = (!empty($data['master_id'])) ? $data['master_id'] : 'AD000001';
        }


        $merchant = Merchant::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.$data['master_id'].'%')->where('status', '1')->first();
        $admin = Admin::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.$data['master_id'].'%')->where('status', '1')->first();
        $agent = Agent::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.$data['master_id'].'%')->where('status', '1')->first();
        $user = User::where(DB::raw('CONCAT(display_code, display_running_no)'), 'like', '%'.$data['master_id'].'%')->where('status', '1')->where('lvl', '1')->first();

        if(!empty($merchant->id)){
            $uplineDetail = $merchant;
        }

        if(!empty($admin->id)){
            $uplineDetail = $admin;
        }

        if(!empty($agent->id)){
            $uplineDetail = $agent;
        }

        if(!empty($user->id)){
            $uplineDetail = $user;
        }

        $filterPhone = ltrim($data['phone'],"0");
        $filterPhone2 = str_replace("-","",$filterPhone);
        $filterPhone3 = str_replace(" ", "", $filterPhone2);

        if($data['role'] == '1'){
            $dc = GlobalController::MemberDisplayCode();

            return User::create([
                'master_id' => $uplineDetail->code,
                'code' => $this->MemberCode(),
                'country_code' => $data['country_code'],
                'phone' => preg_replace("/^\+?{$data['country_code']}/", '',$filterPhone3),
                'f_name' => ucwords(strtolower($data['f_name'])),
                'ic' => $data['ic'],
                'email' => strtolower($data['email']),
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'password' => Hash::make($data['password']),
                'status' => '1',
                'display_code'=> $dc[0],
                'display_running_no'=> $dc[1],
                'status'=> '1'
            ]);
        }else{
            $dc = GlobalController::AgentDisplayCode();

            $newAgent = Agent::create([
                'master_id' => $uplineDetail->code,
                'code' => GlobalController::AgentCode(),
                'country_code' => $data['country_code'],
                'phone' => preg_replace("/^\+?{$data['country_code']}/", '',$filterPhone3),
                'f_name' => ucwords(strtolower($data['f_name'])),
                'ic' => $data['ic'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'email' => strtolower($data['email']),
                'agent_type'=> '2',
                'display_code'=> $dc[0],
                'display_running_no'=> $dc[1],
                'password' => Hash::make($data['password']),
                'verify_status' => '1',
                'lvl' => !empty($data['lvl']) ? $data['lvl'] : '1',
                'status' => '99',
            ]);

            $this->createRegistrationTransaction($newAgent, $data);

            return $newAgent;
        }
    }

    /**
     * When registering with the "Purchase Products" starter package flow
     * (merchant_register.blade.php's product picker + bank transfer UI),
     * create the matching pending Transaction and link it back onto the
     * agent via `register_transaction`, so it shows up in the admin
     * Transaction list and the Pending Agent "Joining Product" column,
     * and so the existing ApproveRejectMerchant approval flow can pick
     * it up exactly like a normal bank-slip order.
     *
     * @param  \App\Agent  $newAgent
     * @param  array  $data
     * @return void
     */
    protected function createRegistrationTransaction($newAgent, array $data)
    {
        // Customer-level agents skip the starter-package purchase entirely,
        // regardless of what the submitted form fields say.
        if(($data['lvl'] ?? null) == '1'){
            return;
        }

        if(($data['joining_type'] ?? null) != '2' || empty($data['selected_starter'])){
            return;
        }

        $product = Product::where(DB::raw('md5(products.id)'), $data['selected_starter'])->where('status', '1')->first();

        if(empty($product->id)){
            return;
        }

        $quantity = !empty($data['quantity']) ? (int) $data['quantity'] : 1;
        $unitPrice = !empty($product->special_price) ? $product->special_price : $product->price;
        $totalWeight = $product->weight * $quantity;
        $subTotal = $unitPrice * $quantity;
        $shippingFee = $this->calculateRegistrationShippingFee($data['country'] ?? null, $data['state'] ?? null, $totalWeight);

        $transaction = new Transaction();
        $transaction->transaction_no = GlobalController::GenerateTransactionNo();
        $transaction->user_id = $newAgent->code;
        $transaction->weight = $totalWeight;
        $transaction->sub_total = $subTotal;
        $transaction->shipping_fee = $shippingFee;
        $transaction->grand_total = $subTotal + $shippingFee;
        $transaction->address_name = $newAgent->f_name;
        $transaction->address = $data['address'] ?? null;
        $transaction->postcode = $data['postcode'] ?? null;
        $transaction->city = $data['city'] ?? null;
        $transaction->state = $data['state'] ?? null;
        $transaction->country = $data['country'] ?? null;
        $transaction->country_code = $newAgent->country_code;
        $transaction->phone = $newAgent->phone;
        $transaction->email = $newAgent->email;
        $transaction->register_product = 1;
        $transaction->bank_id = $data['bank_id'] ?? null;
        $transaction->cdm_bank_id = $data['cdm_bank_id'] ?? null;

        if(!empty($data['bank_slip']) && $data['bank_slip'] instanceof \Illuminate\Http\UploadedFile){
            $files = $data['bank_slip'];
            $name = $files->getClientOriginalName();
            $exp = explode(".", $name);
            $file_ext = end($exp);
            $name = md5($name.date('Y-m-d H:i:s')).'.'.$file_ext;
            $files->move(GlobalController::get_image_path("uploads/bank_slip/".$newAgent->code."/"), $name);
            $transaction->bank_slip = "uploads/bank_slip/".$newAgent->code."/".$name;
        }

        $transaction->status = 98;
        $transaction->save();

        $transactionDetail = new TransactionDetail();
        $transactionDetail->transaction_id = $transaction->id;
        $transactionDetail->product_id = $product->id;
        $transactionDetail->item_code = $product->item_code;
        $transactionDetail->product_code = $product->product_code;
        $transactionDetail->unit_weight = $product->weight;
        $transactionDetail->product_name = $product->product_name;
        $transactionDetail->unit_price = $unitPrice;
        $transactionDetail->costing_price = $product->costing_price;
        $transactionDetail->quantity = $quantity;
        $transactionDetail->get_point = $product->get_point;
        $transactionDetail->save();

        $newAgent->register_transaction = $transaction->transaction_no;
        $newAgent->save();
    }

    /**
     * Same lookup used by AjaxController@GetRegisterPayment for the live
     * price preview, kept server-side here so the stored shipping fee
     * can't be tampered with via the submitted form fields.
     *
     * @param  string|null  $country
     * @param  string|null  $state
     * @param  float  $totalWeight
     * @return float
     */
    protected function calculateRegistrationShippingFee($country, $state, $totalWeight)
    {
        if(empty($country)){
            return 0;
        }

        if($country == '160'){
            $area = (!in_array($state, ['11', '12', '15'])) ? 'west' : 'east';

            $shipping_fees = SettingShippingFee::where('area', $area)
                                                ->where('weight', '<=', ceil($totalWeight))
                                                ->orderBy('weight', 'desc')
                                                ->first();
        }else{
            $shipping_fees = SettingShippingFee::where('country_id', $country)
                                                ->where('weight', '<=', ceil($totalWeight))
                                                ->orderBy('weight', 'desc')
                                                ->first();
        }

        return !empty($shipping_fees->shipping_fee) ? $shipping_fees->shipping_fee : 0;
    }

    protected function MerchantDisplayCode($agent_lvl_code)
    {
        $user = Merchant::select(DB::raw("COUNT(id) AS totalUser"))->where('display_code', $agent_lvl_code)->first();
        $totalCount = $user->totalUser + 1;

        if(strlen($totalCount) == '1'){
            $member_id = "00000".$totalCount;
        }elseif(strlen($totalCount) == '2'){
            $member_id = "0000".$totalCount;
        }elseif(strlen($totalCount) == '3'){
            $member_id = "000".$totalCount;
        }elseif(strlen($totalCount) == '4'){
            $member_id = "00".$totalCount;
        }elseif(strlen($totalCount) == '5'){
            $member_id = "0".$totalCount;
        }else{
            $member_id = $totalCount;
        }

        return array($agent_lvl_code, $member_id);
    }

    protected function MemberDisplayCode($member_lvl_code)
    {
        $user = User::select(DB::raw("COUNT(id) AS totalUser"))->where('display_code', $member_lvl_code)->first();
        $totalCount = $user->totalUser + 1;

        if(strlen($totalCount) == '1'){
            $member_id = "00000".$totalCount;
        }elseif(strlen($totalCount) == '2'){
            $member_id = "0000".$totalCount;
        }elseif(strlen($totalCount) == '3'){
            $member_id = "000".$totalCount;
        }elseif(strlen($totalCount) == '4'){
            $member_id = "00".$totalCount;
        }elseif(strlen($totalCount) == '5'){
            $member_id = "0".$totalCount;
        }else{
            $member_id = $totalCount;
        }

        return array($member_lvl_code, $member_id);
    }
}
