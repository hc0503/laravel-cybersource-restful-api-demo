<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cybersource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'submitTimeUtc' => $this['submitTimeUtc'],
            'status' => $this['status'],
            'reconciliationId' => $this['reconciliationId'],
            'clientReferenceInformation' => [
                'code' => $this['clientReferenceInformation']['code'],
            ],
            'processingInformation' => $this['processingInformation'],
            'processorInformation' => [
                'approvalCode' => $this['processorInformation']['approvalCode'],
                'transactionId' => $this['processorInformation']['transactionId'],
                'networkTransactionId' => $this['processorInformation']['networkTransactionId'],
                'responseCode' => $this['processorInformation']['responseCode'],
                'avs' => [
                    'code' => $this['processorInformation']['avs']['code'],
                    'codeRaw' => $this['processorInformation']['avs']['codeRaw']
                ],
            ],
            'orderInformation' => [
                'amountDetails' => [
                    'authorizedAmount' => $this['orderInformation']['amountDetails']['authorizedAmount'],
                    'currency' => $this['orderInformation']['amountDetails']['currency']
                ]
            ],
            
        ];
    }
}
