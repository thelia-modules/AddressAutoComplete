<?php

namespace AddressAutoComplete\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use AddressAutoComplete\AddressAutoComplete;

class ConfigurationForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder->add(
            "maps_places_api_key",
            "text",
            [
                "data" => AddressAutoComplete::getConfigValue("maps_places_api_key"),
                "label"=>Translator::getInstance()->trans("API key for Maps places", [], AddressAutoComplete::DOMAIN_NAME),
                "label_attr" => ["for" => "maps_places_api_key"],
                "required" => true
            ]
        );
    }

    public function getName()
    {
        return "addressautocomplete_configuration_form";
    }
}
