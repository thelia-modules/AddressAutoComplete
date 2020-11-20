<?php

namespace AddressAutoComplete\Controller;

use AddressAutoComplete\AddressAutoComplete;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Translation\Translator;

class ConfigurationController extends BaseAdminController
{
    public function viewAction()
    {
        if (null !== $response = $this->checkAuth([AdminResources::MODULE], 'AddressAutoComplete', AccessManager::VIEW)) {
            return $response;
        }

        return $this->render("addressautocomplete/module-configuration");
    }

    public function saveAction()
    {
        if (null !== $response = $this->checkAuth([AdminResources::MODULE], 'AddressAutoComplete', AccessManager::UPDATE)) {
            return $response;
        }

        $form = $this->createForm('addressautocomplete_configuration_form');

        try {
            $data = $this->validateForm($form)->getData();

            $excludeData = [
                'success_url',
                'error_url',
                'error_message'
            ];

            foreach ($data as $key => $value) {
                if (!in_array($key, $excludeData)) {
                    AddressAutoComplete::setConfigValue($key, $value);
                }
            }
        } catch (\Exception $e) {
            $this->setupFormErrorContext(
                Translator::getInstance()->trans(
                    "Error",
                    [],
                    AddressAutoComplete::DOMAIN_NAME
                ),
                $e->getMessage(),
                $form
            );
            return $this->viewAction();
        }

        return $this->generateSuccessRedirect($form);
    }
}