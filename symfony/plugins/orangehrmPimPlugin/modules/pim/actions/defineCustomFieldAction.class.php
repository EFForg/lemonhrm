<?php

/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */

/**
 * defineCustomFieldAction action
 */
class defineCustomFieldAction extends sfAction {

    protected $customFieldService;

    /**
     * Get CustomFieldsService
     * @returns CustomFieldsService
     */
    public function getCustomFieldService() {
        if (is_null($this->customFieldService)) {
            $this->customFieldService = new CustomFieldConfigurationService();
            $this->customFieldService->setCustomFieldsDao(new CustomFieldConfigurationDao());
        }
        return $this->customFieldService;
    }

    /**
     * Set Country Service
     */
    public function setCustomFieldService(CustomFieldConfigurationService $customFieldsService) {
        $this->customFieldService = $customFieldsService;
    }

    /**
     * Delete custom fields
     * @param $request
     * @return unknown_type
     */
    public function execute($request) {
        $admin = $this->getUser()->hasCredential(Auth::ADMIN_ROLE);
        
        if (!$admin) {
            $this->forward("auth", "unauthorized");
            return;
        } 
        
        $form = new CustomFieldForm(array(), array(), true);
        $customFieldsService = $this->getCustomFieldService();
        
        if ($request->isMethod('post')) {

            $form->bind($request->getParameter($form->getName()));
            if ($form->isValid()) {
                
                $fieldNum = $form->getValue('field_num');
                $customField = null;
                
                if (isset($fieldNum)) {
                    $customField = $customFieldsService->getCustomField($fieldNum);
                }
                
                if (empty($customField)) {
                    $customField = new CustomField();
                }
                
                $customField->setName($form->getValue('name'));
                $customField->setType($form->getValue('type'));
                $customField->setScreen($form->getValue('screen'));
                $customField->setExtraData($form->getValue('extra_data'));
                $customFieldsService->saveCustomField($customField);
                $this->getUser()->setFlash('success', __(TopLevelMessages::SAVE_SUCCESS));

            }
        }
        $this->redirect('pim/listCustomFields');        
    }

}