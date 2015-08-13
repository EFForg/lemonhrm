<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorporateDirectoryWebServiceHelperTest
 *
 * @author nirmal
 */
class CorporateDirectoryWebServiceHelperTest extends PHPUnit_Framework_TestCase {
    protected $corporateDirectoryWebServiceHelper;
    
    public function setUp(){
        $this->corporateDirectoryWebServiceHelper = new CorporateDirectoryWebServiceHelper();
    }
    
    /**
     * @covers CorporateDirectoryWebServiceHelper::getEmployeeDirectoryService
     */
    public function testGetEmployeeDirectoryService(){
        $employeeDirectoryService = $this->corporateDirectoryWebServiceHelper->getEmployeeDirectoryService();
        $this->assertTrue($employeeDirectoryService instanceof EmployeeDirectoryService);
    }
    
    /**
     * @covers CorporateDirectoryWebServiceHelper::getCorporateDirectoryEmployeeDetailsAsArray
     */
    public function testGetCorporateDirectoryEmployeeDetailsAsArrayWithoutLoationsAndSubunits(){
        $employee = new Employee();
        $employee->setEmpNumber(1);
        $employee->setFirstName('testEmpFirstName');
        $employee->setLastName('testEmpLastName');
        
        $count = 1;
        
        $employees = array(
            $employee
        );
        
        $employeeDirectoryServiceMock = $this->getMock('EmployeeDirectoryService');
        $employeeDirectoryServiceMock->expects($this->once())
             ->method('searchEmployees')
             ->will($this->returnValue($employees));
        $employeeDirectoryServiceMock->expects($this->once())
             ->method('getSearchEmployeeCount')  
             ->will($this->returnValue($count));
        
        $this->corporateDirectoryWebServiceHelper->setEmployeeDirectoryService($employeeDirectoryServiceMock);
        
        $employeeDetails = $this->corporateDirectoryWebServiceHelper->getCorporateDirectoryEmployeeDetailsAsArray();
        $this->assertEquals(1, count($employeeDetails));
        $this->assertNull($employeeDetails[0]['location_id']);
    }
    
    /**
     * @covers CorporateDirectoryWebServiceHelper::getCorporateDirectoryEmployeeDetailsAsArray
     */
    public function testGetCorporateDirectoryEmployeeDetailsAsArrayWithLoationsAndSubunits(){
        $location = new Location();
        $location->setId(1);
        
        $locationCollection = new Doctrine_Collection('Location');
        $locationCollection->add($location);
        
        $employee = new Employee();
        $employee->setEmpNumber(1);
        $employee->setFirstName('testEmpFirstName');
        $employee->setLastName('testEmpLastName');
        $employee->setLocations($locationCollection);
        
        $count = 1;
        
        $employees = array(
            $employee
        );
        
        $employeeDirectoryServiceMock = $this->getMock('EmployeeDirectoryService');
        $employeeDirectoryServiceMock->expects($this->once())
             ->method('searchEmployees')
             ->will($this->returnValue($employees));
        $employeeDirectoryServiceMock->expects($this->once())
             ->method('getSearchEmployeeCount')  
             ->will($this->returnValue($count));
        
        $this->corporateDirectoryWebServiceHelper->setEmployeeDirectoryService($employeeDirectoryServiceMock);
        
        $employeeDetails = $this->corporateDirectoryWebServiceHelper->getCorporateDirectoryEmployeeDetailsAsArray();
        $this->assertEquals(1, count($employeeDetails));
        $this->assertNotNull($employeeDetails[0]['location_id']);
        $this->assertEquals(1, $employeeDetails[0]['location_id']);
    }
    
}
