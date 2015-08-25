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
 * Description of LeaveEmailProcessor
 *
 */
class RecruitmentEmailProcessor implements orangehrmMailProcessor {

    protected $employeeService;
    protected $userRoleManager;
    protected $logger;

    /**
     * Get Logger instance
     * @return Logger
     */
    public function getLogger() {
        if (empty($this->logger)) {
            $this->logger = Logger::getLogger('leave.leavemailer');
        }
        return $this->logger;
    }

    public function getEmployeeService() {
        if (!($this->employeeService instanceof EmployeeService)) {
            $this->employeeService = new EmployeeService();
        }
        return $this->employeeService;
    }

    public function setEmployeeService($employeeService) {
        $this->employeeService = $employeeService;
    }

    public function getReplacements($data) {

        $replacements = array();

        // $performer = $this->getEmployeeService()->getEmployee($data['empNumber']);
        // 
        // if ($performer instanceof Employee) {
        //     $replacements['performerFirstName'] = $performer->getFirstName();
        //     $replacements['performerFullName'] = $performer->getFullName();
        // } else {
        //     $name = sfContext::getInstance()->getUser()->getAttribute('auth.firstName');
        // 
        //     $replacements['performerFirstName'] = $name;
        //     $replacements['performerFullName'] = $name;
        // 
        // }
        // 
        // if ($data['recipient'] instanceof Employee) {
        //     $replacements['recipientFirstName'] = $data['recipient']->getFirstName();
        //     $replacements['recipientFullName'] = $data['recipient']->getFullName();
        // } else if ($data['recipient'] instanceof EmailSubscriber) {
        //     $replacements['recipientFirstName'] = $data['recipient']->getName();
        //     $replacements['recipientFullName'] = $data['recipient']->getName();
        // }
        // 
        // $applicantNo = $data['days'][0]->getEmpNumber();
        // 
        // $applicant = $this->getEmployeeService()->getEmployee($applicantNo);
        // if ($applicant instanceof Employee) {
        //     $replacements['applicantFirstName'] = $applicant->getFirstName();
        //     $replacements['applicantFullName'] = $applicant->getFullName();
        // }
        // 
        // $replacements = $this->_populateLeaveReplacements($data, $replacements);
        // 
        // return $replacements;

    }

    public function getRecipients($emailName, $role, $data) {

        $recipients = array();

        switch ($role) {
            case 'hiring_manager' :
                if (isset($data['vacancy'])) {
                    $recipients = array($this->getHiringManager($data['vacancy']));
                }
                break;
            // case 'supervisor':
            //     if (isset($data['days'][0])) {
            //         $recipients = $this->getSupervisors($data['days'][0]->getEmpNumber(), $data);
            //     }
            //     break;
        }

        return $recipients;
    }
    
    protected function getHiringManager($vacancy) {
        $hiringManagerId = $vacancy->getHiringManagerId();
        if ($hiringManagerId) {
            $hiringManager = $this->getEmployeeService()->getEmployee($hiringManagerId);
        }
        return $hiringManager;
    }

    protected function getSelf($empNumber) {
        $recipients = array();
        $performer = $this->getEmployeeService()->getEmployee($empNumber);

        $to = $performer->getEmpWorkEmail();

        if (!empty($to)) {
            $recipients[] = $performer;
        }

        return $recipients;
    }

}
