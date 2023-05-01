<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Referal\ReferalService;
use App\Services\Voucher\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{
    private $referalService;
    private $voucherService;

    public function __construct(ReferalService $referalService, VoucherService $voucherService)
    {
        $this->referalService = $referalService;
        $this->voucherService = $voucherService;
    }

    public function index(){
        $data = User::withSum('saldo', 'amount')->with('referal.voucher.user')->find(Auth::user()->id);

        return view('landing_page.affiliate.index', compact('data'));
    }

    public function track(){
        $data = User::with('referal.voucher.user', 'referal.voucher.voucher.master_class')->find(Auth::user()->id);

        return view('dashboard.mentee.affiliate.index', compact('data'));
    }

    public function confirm(Request $request){
        $data = $this->referalService->confirm($request);

        return redirect()->route('user.affiliate.list', ['voucher_id' => $data]);
    }

    public function claimClass(Request $request){
        $this->voucherService->claimClass($request->voucher_id, $request->master_class_id);

        return ['status' => 'success', 'msg' =>'Voucher Berhasil Diklaim'];
    }
}