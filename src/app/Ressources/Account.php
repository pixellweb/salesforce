<?php
namespace Citadelle\Salesforce\app\Ressources;


use Citadelle\Salesforce\app\SalesforceException;
use GuzzleHttp\Exception\GuzzleException;

class Account extends Ressource
{


    /**
     * @param $source_id
     * @param $type
     * @return mixed
     */
    public function get($id)
    {
        return $this->api->get('data/v52.0/sobjects/Account/'.$id);
    }

    /**
     * @param $datas array
     * @return string AccountId
     * @throws SalesforceException
     * @throws GuzzleException
     */
    public function post($datas) : string
    {
        $datas = $datas + [
            "Nom" => "",
            "Prenom" => "",
            "Civilite" => "",
            "AdresseEmail" => "",
            "CodePostal" => "",
            "Ville" => "",
            "Adresse" => "",
            "mobile" => "",
            "CODE_SOCIETE" => config('citadelle.salesforce.code_societe_client'),
            "ID_CLIENT_SITE" => "",
            "ID_SITE" => config('citadelle.salesforce.id_site'),
        ];

        //dd($datas);

        $response = $this->api->post('apexrest/AccountManager/v1.0', [
            'acct' => $datas
        ]);

        return $response['AccountId'];
    }

}
