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
 * Action class for PIM module delete emergency contacts
 *
 */
class deleteEmergencyContactsAction extends basePimAction {

    /**
     * Delete employee emergencyContacts
     *
     * @param int $empNumber Employee number
     *
     * @return boolean true if successfully deleted, false otherwise
     */
    public function execute($request) {

        $empNumber = $request->getParameter('empNumber', false);
    	$this->form = new EmployeeEmergencyContactsDeleteForm(array(), array('empNumber' => $empNumber), true);
        
    	$this->form->bind($request->getParameter($this->form->getName()));        
        
        if (!$this->IsActionAccessible($empNumber)) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        
        if ($this->form->isValid()) {
                
                if (!$empNumber) {
                    throw new PIMServiceException("No Employee ID given");
                }
                $emergencyContactsToDelete = $request->getParameter('chkecontactdel', array());

                if ($emergencyContactsToDelete) {
                    $service = new EmployeeService();
                    $count = $service->deleteEmployeeEmergencyContacts($empNumber, $emergencyContactsToDelete);
                    $this->getUser()->setFlash('viewEmergencyContacts.success', __(TopLevelMessages::DELETE_SUCCESS));
                }
        }

        $this->redirect('pim/viewEmergencyContacts?empNumber=' . $empNumber);
    }

}
