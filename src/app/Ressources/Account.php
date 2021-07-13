<?php
namespace Citadelle\Salesforce\app\Ressources;


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
     * @return mixed
     */
    public function post($datas)
    {
        $datas = $datas + [
            "ID_SITE" => config('citadelle.salesforce.id_site'),
            "CODE_SOCIETE" => config('citadelle.salesforce.code_societe'),
            "Nom" => "",
            "Prenom" => "",
            "Civilite" => "",
            "AdresseEmail" => "",
            "CodePostal" => "",
            "Ville" => "",
            "Adresse" => "",
            "mobile" => "",
            "ID_CLIENT_SITE" => ""
        ];

        //dd($datas);

        return $this->api->post('apexrest/AccountManager/v1.0/', [
            'acct' => $datas
        ]);
    }

}
