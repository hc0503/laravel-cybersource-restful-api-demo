<?php

namespace App\Http\Controllers\API;

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Helpers/ExternalConfiguration.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Http\Resources\Cybersource as CybersourceResource;

use CyberSource\Model\Ptsv2paymentsClientReferenceInformation;
use CyberSource\Model\Ptsv2paymentsProcessingInformation;
use CyberSource\Model\Ptsv2paymentsPaymentInformationCard;
use CyberSource\Model\Ptsv2paymentsPaymentInformation;
use CyberSource\Model\Ptsv2paymentsOrderInformationAmountDetails;
use CyberSource\Model\Ptsv2paymentsOrderInformationBillTo;
use CyberSource\Model\Ptsv2paymentsOrderInformation;
use CyberSource\Model\CreatePaymentRequest;
use CyberSource\ExternalConfiguration;
use CyberSource\ApiClient;
use CyberSource\Api\PaymentsApi;
use Cybersource\ApiException;

class CybersourceController extends BaseController
{
    protected $flag;
    /**
     * 
     */
    public function __contruct(Request $request)
    {
        $this->flag = false;
    }

    /**
     * 
     */
    public function postCheckout(Request $request)
    {
        $validated = $this->validate($request, [
            'number' => ['required', 'int'],
            'expiration_month' => ['required', 'int'],
            'expiration_year' => ['required', 'int'],
            'total_amount' => ['required'],
            'currency' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'address1' => ['required'],
            'locality' => ['required'],
            'administrative_area' => ['required'],
            'postal_code' => ['required'],
            'country' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required']
        ]);
        $this->flag === true ? $capture = true : $capture = false;
        
        $clientReferenceInformationArr = [
            "code" => 'TC50171_3'
        ];
        $clientReferenceInformation = new Ptsv2paymentsClientReferenceInformation($clientReferenceInformationArr);
    
        $processingInformationArr = [
            "capture" => $capture
        ];
        $processingInformation = new Ptsv2paymentsProcessingInformation($processingInformationArr);
    
        $paymentInformationCardArr = [
            "number" => $validated['number'],
            "expirationMonth" => $validated['expiration_month'],
            "expirationYear" => $validated['expiration_year']
        ];
        $paymentInformationCard = new Ptsv2paymentsPaymentInformationCard($paymentInformationCardArr);
    
        $paymentInformationArr = [
            "card" => $paymentInformationCard
        ];
        $paymentInformation = new Ptsv2paymentsPaymentInformation($paymentInformationArr);
    
        $orderInformationAmountDetailsArr = [
            "totalAmount" => $validated['total_amount'],
            "currency" => $validated['currency']
        ];
        $orderInformationAmountDetails = new Ptsv2paymentsOrderInformationAmountDetails($orderInformationAmountDetailsArr);
    
        $orderInformationBillToArr = [
            "firstName" => $validated['first_name'],
            "lastName" => $validated['last_name'],
            "address1" => $validated['address1'],
            "locality" => $validated['locality'],
            "administrativeArea" => $validated['administrative_area'],
            "postalCode" => $validated['postal_code'],
            "country" => $validated['country'],
            "email" => $validated['email'],
            "phoneNumber" => $validated['phone_number']
        ];
        $orderInformationBillTo = new Ptsv2paymentsOrderInformationBillTo($orderInformationBillToArr);
    
        $orderInformationArr = [
            "amountDetails" => $orderInformationAmountDetails,
            "billTo" => $orderInformationBillTo
        ];
        $orderInformation = new Ptsv2paymentsOrderInformation($orderInformationArr);
    
        $requestObjArr = [
            "clientReferenceInformation" => $clientReferenceInformation,
            "processingInformation" => $processingInformation,
            "paymentInformation" => $paymentInformation,
            "orderInformation" => $orderInformation
        ];
        $requestObj = new CreatePaymentRequest($requestObjArr);
    
        $commonElement = new ExternalConfiguration();
        $config = $commonElement->ConnectionHost();
        $merchantConfig = $commonElement->merchantConfigObject();
    
        $api_client = new ApiClient($config, $merchantConfig);
        $api_instance = new PaymentsApi($api_client);
    
        try {
            $apiResponse = $api_instance->createPayment($requestObj);
    
            return $this->sendResponse(new CybersourceResource($apiResponse[0]), 'Successfully.');
        } catch (ApiException $e) {
            return $this->sendError($e->getMessage(), $e->getResponseBody());
        }
    }
}
