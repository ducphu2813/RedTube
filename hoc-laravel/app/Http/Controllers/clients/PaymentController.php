<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\PaymentHistory;
use App\Models\PremiumPackage;
use App\Models\PremiumRegistration;
use App\Models\UserMembership;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function toPaymentPage(Request $request){

        $data = $request->all();

        unset($data['_token']);

        if($data['flag'] == 'premium'){
            //lấy gói premium theo id

            $data['premium'] = PremiumPackage::getPackageById($data['pack_id']);

        }
        else{
            $data['membership'] = Membership::getMembershipById($data['pack_id']);
        }

        $request->session()->put('data', $data);

    }

    public function showPayment( Request $request)
    {
        $data = $request->session()->get('data');

        //xóa dữ liệu trong session
        $request->session()->forget('data');

        return view('payment.payment-page', [
            'flag' => $data['flag'],
            'premium' => $data['premium'] ?? null,
            'membership' => $data['membership'] ?? null,
            'pack_id' => $data['pack_id'],
        ]);
    }

    public function handlePayment(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        if($data['flag'] == 'premium'){

            //lấy gói premium theo id

            $premium = PremiumPackage::getPackageById($data['pack_id']);

            //lưu vào premium registration
            $newData = [
                'user_id' => session('loggedInUser'),
                'package_id' => $data['pack_id'],
                'start_date' => date('Y-m-d H:i:s'),
                'end_date' => date('Y-m-d H:i:s', strtotime('+'.$premium->duration.' days')),
            ];

            PremiumRegistration::createPremiumRegistration($newData);

        }
        else{
            $membership = Membership::getMembershipById($data['pack_id']);

            //lưu vào user membership
            $newData = [
                'user_id' => session('loggedInUser'),
                'membership_id' => $data['pack_id'],
                'start_date' => date('Y-m-d H:i:s'),
                'end_date' => date('Y-m-d H:i:s', strtotime('+'.$membership->duration.' days')),
            ];

            UserMembership::createUserMembership($newData);
        }

        //lưu lịch sử thanh toán
        $paymentData = [
            'user_id' => session('loggedInUser'),
            'payment_date' => date('Y-m-d H:i:s'),
            'amount' => $data['amount'],
            'full_name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
        ];
        PaymentHistory::createPaymentHistory($paymentData);

        return response()->json([
            'status' => 'success',
            'message' => 'Thanh toán thành công',
            'data' => $data
        ]);
    }


}
