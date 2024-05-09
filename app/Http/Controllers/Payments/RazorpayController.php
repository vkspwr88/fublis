<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
use Illuminate\Http\Request;
use App\Models\Razorpay;
use App\Models\SubscriptionPlan;
use Exception;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    private Api $api;

    public function __construct(){
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

	public function checkout(Request $request, Razorpay $razorpay)
	{
		// dd($razorpay);
		if(!$razorpay){
			return to_route('pricing')->with([
				'type' => 'error',
				'message' => 'Order not found',
			]);
		}
		return view('users.pages.architects.payments.razorpay.checkout', [
			'razorpay' => $razorpay,
			'notes' => json_decode($razorpay->notes),
		]);
	}

	public function callback(Request $request, Razorpay $razorpay)
	{
		dd($request->all(), $razorpay);
		try{
            DB::beginTransaction();
            if(!$razorpay){
                return to_route('pricing')->with([
					'type' => 'error',
					'message' => 'Order not found',
				]);
            }
			$notes = json_decode($razorpay->notes);
            $this->verifySignature($razorpay->order_id, $request->razorpay_payment_id, $request->razorpay_signature);
            $details = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];
            $this->updateRazorpay($razorpay->id, $details);

			DB::commit();

            session()->forget('order_id');
            return to_route('architect.account.profile.setting.billing')->with([
				'type' => 'success',
				'message' => 'You have successfully subscribed to ' . str()->headline($notes->slug),
			]);
        }
        catch(Exception $exp){
            DB::rollBack();
            $message = $exp->getMessage();
            if($message == 'Invalid signature passed'){
                $message = 'Your payment is not confirmed. Please contact support. Reference Order Id: ' . $razorpay->order_id;
            }
            else{
                $message = 'Problem in processing the order. Please contact support. Reference Order Id: ' . $razorpay->order_id;
            }
			ErrorLogController::logErrorNew('razorpay callback', $exp);
			return to_route('pricing')->with([
				'type' => 'error',
				'message' => $message,
			]);
        }
	}

    public function getApi(){
        return $this->api;
    }

    public function create(array $details){
        return Razorpay::create($details);
    }

    public function getById(int $id){
        return Razorpay::find($id)->first();
    }

    public function getByOrderId(string $orderId){
        return Razorpay::where('order_id', $orderId)
                        ->first();
    }

    public function updateRazorpay(int $id, array $details){
        return Razorpay::where('id', $id)
                        ->update($details);
    }

    public function getPaymentDetails($orderId){
        return $this->api->order->fetch($orderId)->payments()->items[0];
    }

    public function getOrder(string $orderId){
        return $this->api->order->fetch($orderId);
    }

    public function createOrder(array $details){
        return $this->api->order->create($details);
    }

    public function verifySignature(string $razorpayOrderId, string $razorpayPaymentId, string $razorpaySignature){
        return $this->api->utility->verifyPaymentSignature(array('razorpay_order_id' => $razorpayOrderId, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_signature' => $razorpaySignature));
    }
}
