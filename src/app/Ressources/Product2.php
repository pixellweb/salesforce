<?php
namespace Citadelle\Salesforce\app\Ressources;


class Product2 extends Ressource
{


    /**
     * @param $source_id
     * @param $type
     * @return boolean
     */
    public function hasStock($vin, $code_societe_source)
    {
        $response = $this->api->get("data/v47.0/query?q=select+id,+Tech_Produit_Disponible__c+from+Product2+where+Chassis_Concession__c+='".$vin.'_'.str_pad($code_societe_source, 3, '0', STR_PAD_LEFT)."'");

        return isset($response['records'][0]['Tech_Produit_Disponible__c']) and $response['records'][0]['Tech_Produit_Disponible__c'] === true;
    }

}
