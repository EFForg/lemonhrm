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
 *  Employee class file
 */

/**
 * @package    orangehrm
 * @subpackage model\pim
 */
class Employee extends PluginEmployee {

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const UNMARRIED = 'Unmarried';
    const MARRIED = 'Married';
    const DIVORCED = 'Divorced';
    const OTHERS = 'Others';

    const STATE_ACTIVE = 'ACTIVE';
    const STATE_TERMINATED = 'TERMINATED';
    const STATE_NOT_EXIST = 'NOT_EXIST';

    /**
     * @ignore
     */    
    private $employeeService;

    /**
     * @ignore
     * @return type 
     */
    public function getEmployeeService() {
        if(is_null($this->employeeService)) {
            $this->employeeService = new EmployeeService();
            $this->employeeService->setEmployeeDao(new EmployeeDao());
        }
        return $this->employeeService;
    }
    
    /**
     * @ignore
     * Set up model. Calls base class Setup and adds encryption support
     * for ssn.
     */
    public function setUp() {
        parent::setup();

        if (KeyHandler::keyExists()) {
            $key = KeyHandler::readKey();
            $this->addListener(new EncryptionListener('ssn', $key));
        }
    }

    /**
     * Returns the full name of employee, (first middle last)
     *
     * @return String Full Name
     */
    public function getFullName() {

        $fullName = trim($this->firstName) . " " . trim($this->middleName);
        $fullName = trim( trim($fullName) . " " . trim($this->lastName) );

        $terminationId = $this->termination_id;
        $fullName = (!empty($terminationId)) ? $fullName." (" . __('Past Employee') . ")" : $fullName;

        return $fullName;
    }

    /**
    * Returns the first and last names of employee
    *
    * @return String
    */
    public function getFirstAndLastNames() {

        $fullName = trim($this->firstName) . " " . trim($this->lastName);

        $terminationId = $this->termination_id;
        $fullName = (!empty($terminationId)) ? $fullName." (" . __('Past Employee') . ")" : $fullName;

        return $fullName;

    }

    /**
     * Gets the names of all the supervisors of this employee as a comma separated string
     * Only the first and last name are used.
     *
     * @return String String containing comma separated list of supervisor names.
     *                Empty string if employee has no supervisors
     */
    public function getSupervisorNames() {
        $supervisorNames = array();

        foreach ($this->supervisors as $supervisor ) {
            $supervisorNames[] = trim(trim($supervisor->firstName . ' ' . $supervisor->middleName) . ' ' . $supervisor->lastName);
        }

        return implode(', ', $supervisorNames);
    }

    /**
     * Returns emergency contact with given sequence no, or null if not found.
     *
     * @param int $seqNo Sequence no
     *
     * @return EmergencyContact Emergency contact with given sequence no.
     */
    public function getEmergencyContact($seqNo) {

        $emergencyContact = null;

        foreach ($this->emergencyContacts as $contact) {
            if ($contact->seqno == $seqNo) {
                $emergencyContact = $contact;
                break;
            }
        }

        return ($emergencyContact);
    }

    /**
     * Returns dependent with given sequence no, or null if not found.
     *
     * @param int $seqNo Sequence no
     *
     * @return EmpDependent Dependent with given sequence no.
     */
    public function getDependent($seqNo) {

        $dependent = null;

        foreach ($this->dependents as $dep) {
            if ($dep->seqno == $seqNo) {
                $dependent = $dep;
                break;
            }
        }

        return ($dependent);
    }

    /**
     * Returns immigration document with given sequence no, or null if not found.
     *
     * @param int $seqNo Sequence no
     *
     * @return EmpPassport Immigration document with given sequence no.
     */
    public function getImmigrationDocument($seqNo) {

        $immigrationDocument = null;

        foreach ($this->immigrationDocuments as $doc) {
            if ($doc->seqno == $seqNo) {
                $immigrationDocument = $doc;
                break;
            }
        }

        return ($immigrationDocument);
    }

    /**
     * Returns Direct debit details with given sequence no, or null if not found.
     *
     * @param int $seqNo Sequence no
     *
     * @return EmpDirectdebit Direct debit details with given sequence no.
     */
    public function getDirectDebit($seqNo) {

        $directDebit = null;

        foreach ($this->directDebits as $dd) {
            if ($dd->seqno == $seqNo) {
                $directDebit = $dd;
                break;
            }
        }

        return ($directDebit);
    }

    /**
     * Returns education details with given code, or null if not found.
     *
     * @param int $eduCode Education code
     *
     * @return EmpEducation Education details with given code.
     */
    public function getEducation($eduCode) {

        $education = null;

        foreach ($this->education as $edu) {
            if ($edu->code == $eduCode) {
                $education = $edu;
                break;
            }
        }

        return ($education);
    }

    /**
     * Returns education details with given code, or null if not found.
     *
     * @param int $skillCode Education code
     *
     * @return EmpEducation Education details with given code.
     */
    public function getSkill($skillCode) {

        $skill = null;

        foreach ($this->skills as $sk) {
            if ($sk->code == $skillCode) {
                $skill = $sk;
                break;
            }
        }

        return ($skill);
    }

    /**
     * Returns language details with given code, or null if not found.
     *
     * @param int $langCode Language code
     * @param int $langFluency Language fluency code
     *
     * @return EmpLanguage Language details with given code.
     */
    public function getLanguage($langCode, $langFluency) {
        $language = null;

        foreach ($this->languages as $lang) {
            if (($lang->code == $langCode) && ($lang->lang_type == $langFluency)) {
                $language = $lang;
                break;
            }
        }

        return ($language);

    }


    /**
     * Returns license details with given code, or null if not found.
     *
     * @param int $licenseCode Language code
     *
     * @return Employeelicenses license details with given code.
     */
    public function getLicense($licenseCode) {
        $license = null;

        foreach ($this->languages as $lic) {
            if ($lic->code == $licenseCode) {
                $license = $lic;
                break;
            }
        }

        return ($license);
    }

    /**
     * Returns membership details with given code, or null if not found.
     *
     * @param String $membershipType Membership type code
     * @param String $membershipCode Membership code
     *
     * @return EmployeeMembership membership details with given code.
     */
    public function getMembership($membershipType, $membershipCode) {
        $membership = null;

        foreach ($this->memberships as $mem) {
            if (($mem->membship_code == $membershipCode) && ($mem->membtype_code == $membershipType)) {
                $membership = $mem;
                break;
            }
        }

        return ($membership);
    }

    /**
     * Get this employee's salary grade, or null if not available.
     *
     * @return String Salary Grade
     */
    public function getSalaryGrade() {

        $salaryGrade = null;

        if (count($this->salaryDetails) > 0) {
            $basicSalary = $this->salaryDetails[0];
            $salaryGrade = $basicSalary->salaryGrade;
        }

        return($salaryGrade);
    }


    /**
     * Get this employee's salary in the given currency
     *
     * @param String $currencyCode Currency code
     *
     * @return EmpBasicSalary
     */
    public function getSalaryForCurrency($currencyCode) {

        $empSalary = null;

        foreach ($this->salaryDetails as $sal) {

            if ($sal->currency_id == $currencyCode) {
                $empSalary = $sal;
                break;
            }
        }

        return($empSalary);
    }

    /**
     * Get the ReportTo object for the supervisor with given emp number
     *
     * @param int $supervisorEmpNumber Supervisors employee number
     *
     * @return ReportTo object
     */
    public function getSupervisorRepTo($supervisorEmpNumber) {
        $supRepTo = null;

        foreach ($this->ReportToSup as $repTo) {
            if ($supervisorEmpNumber == $repTo->supervisorId) {
                $supRepTo = $repTo;
                break;
            }
        }

        return ($supRepTo);
    }

    /**
     * Get the ReportTo object for the subordinate with given emp number
     *
     * @param int $subordinateEmpNumber Subordinate's employee number
     *
     * @return ReportTo object
     */
    public function getSubordinateRepTo($subordinateEmpNumber) {
        $subRepTo = null;

        foreach ($this->ReportToSub as $repTo) {
            if ($subordinateEmpNumber == $repTo->subordinateId) {
                $subRepTo = $repTo;
                break;
            }
        }

        return ($subRepTo);
    }

    /**
     * Get this employee's contract with given id
     *
     * @param $contractId contract ID
     *
     * @return EmpContract
     */
    public function getContract($contractId) {

        $empContract = null;

        foreach ($this->contracts as $contract) {

            if ($contract->currency_id == $contractId) {
                $empContract = $contract;
                break;
            }
        }

        return($empContract);
    }

    /**
     * Saving/Updating Employee Picture
     * @param EmpPicture $empPicture
     */
    public function setEmployeePicture(EmpPicture $empPicture) {
        if($this->getEmpNumber() != "") {
            $service             = new EmployeeService();
            $currentEmpPicture   = $service->readEmployeePicture($this->getEmpNumber());

            if($currentEmpPicture instanceof EmpPicture) {
                $currentEmpPicture->setPicture($empPicture->getPicture());
                $currentEmpPicture->setFilename($empPicture->getFilename());
                $currentEmpPicture->setFileType($empPicture->getFileType());
                $currentEmpPicture->setSize($empPicture->getSize());
            } else {
                $currentEmpPicture = $empPicture;
            }
            $service->saveEmployeePicture($currentEmpPicture);
        }
    }

    /**
     * Get year of service
     * @return unknown_type
     */
    public function getYearOfService() {
        $joinedDate = $this->getJoinedDate();

        list($Y, $m, $d) = explode("-", $joinedDate);
        $years = date("Y") - $Y;

        if (date("md") < $m . $d) {
            $years--;
        }
        return $years;
    }
    /**
     * @ignore
     * 
     * @param type $supervisorId
     * @return type 
     */
    public function isSubordinateOf($supervisorId) {
//        $this->supervisors = $this->getSupervisors();
//        foreach ($this->supervisors as $supervisor) {
//            if ($supervisor->getEmpNumber() == $supervisorId) {
//                return true;
//            }
//        }
//        return false;

        if(isset($_SESSION['isSupervisor']) && $_SESSION['isSupervisor']) {

            $empService = $this->getEmployeeService();
            $subordinates = $empService->getSubordinateList($supervisorId, true);

            foreach($subordinates as $employee) {
                if($employee->getEmpNumber() == $this->getEmpNumber()) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * get operational Country of an Employee 
     * @return OperationalCountry 
     */
    public function getOperationalCountry(){
        $employeeLocations  = $this->getLocations();
        if( $employeeLocations[0] instanceof Location){
            $operationalCountry = $employeeLocations[0]->getCountry()->getOperationalCountry();
            return $operationalCountry;
        }
        return null;
    }
    
   /**
    * Get employee state
    * 
    * @return string one of Employee::STATE_ACTIVE, Employee:STATE_TERMINATED
    */
    public function getState() {
        $state = $this->termination_id == null ? self::STATE_ACTIVE : self::STATE_TERMINATED;
        
        return $state;
    }    
}
