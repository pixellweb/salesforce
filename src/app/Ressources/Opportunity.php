<?php
namespace Citadelle\Salesforce\app\Ressources;


use Citadelle\Salesforce\app\SalesforceException;
use GuzzleHttp\Exception\GuzzleException;

class Opportunity extends Ressource
{


    /**
     * @param $client_reference_salesforce
     * @param $vin
     * @param $code_societe_source
     * @param null|string $transaction_reference
     * @param bool $is_devis
     * @return string
     * @throws SalesforceException
     * @throws GuzzleException
     */
    public function post($client_reference_salesforce, $vin, $code_societe_source, $transaction_reference = null, $is_devis = false)
    {
        $datas = [
            "ID_SALESFORCE" => $client_reference_salesforce,
            "StageName" => $is_devis ? "Offre Commerciale" : 'Closed Won',
            "VIN_VEHICULE" => $vin.'_'.str_pad($code_societe_source, 3, '0', STR_PAD_LEFT),
            "TRANSACTION_PAYBOX" => $transaction_reference,
        ];

        $response = $this->api->post('apexrest/OpportunityManager/v1.0', [
            'Oppy' => $datas
        ]);

        return $response['OppId'];
    }

}
