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
 * Description of EvaluateSearchReviewListConfigurationFactory
 *
 */
class EvaluateSearchReviewListConfigurationFactory extends ohrmListConfigurationFactory {

    private $isReviewer;

    public function __construct($isReviewer) {
        $this->isReviewer = $isReviewer;
    }

    protected function init() {

        $header2 = new DueDateHeader();
        $header3 = new ReviewPeriodHeader();
        $header4 = new ListHeader();
        $header5 = new ListHeader();
        $header6 = new ListHeader();

        if ($this->isReviewer) {
            $header1 = new ListHeader();
            $header7 = new ManagePerformanceActionHeader();

            $header1->populateFromArray(array(
                'name' => 'Employee',
                'width' => '25%',
                'isSortable' => false,
                'sortField' => null,
                'elementType' => 'label',
                'elementProperty' => array('getter' => array('getEmployee', 'getFullName')),
            ));

            $reviewStatus = array();
        $reviewStatus [ReviewStatusActivated::getInstance()->getStatusId()] = ReviewStatusActivated::getInstance()->getName();
        $reviewStatus [ReviewStatusApproved::getInstance()->getStatusId()] = ReviewStatusApproved::getInstance()->getName();
        $reviewStatus [ReviewStatusInProgress::getInstance()->getStatusId()] = ReviewStatusInProgress::getInstance()->getName();
        $reviewStatus [ReviewStatusInactive::getInstance()->getStatusId()] = ReviewStatusInactive::getInstance()->getName();

        $header6->populateFromArray(array(
            'name' => 'Status',
            'width' => '10%',
            'isSortable' => false,
            'sortField' => null,
            'filters' => array('EnumCellFilter' => array(
                    'enum' => $reviewStatus,
                    'default' => ''),
                'I18nCellFilter' => array()
            ),
            'elementType' => 'label',
            'textAlignmentStyle' => 'left',
            'elementProperty' => array('getter' => 'getStatusId'),
        ));

            $header7->populateFromArray(array(
                'name' => 'Action',
                'isSortable' => false,
                'sortField' => null,
                'elementType' => 'ManagePerformanceAction',
                'elementProperty' => array(
                    'placeholderGetters' => array('id' => 'getId'),
                    'urlPattern' => 'index.php/performance/performanceReviewProgress?id={id}'),
            ));
        } else {
            $header1 = new PerformanceEvaluationLinkHeader();
            $header7 = new ListHeader();

            $header1->populateFromArray(array(
                'name' => 'Employee',
                'width' => '20%',
                'isSortable' => false,
                'sortField' => null,
                'elementType' => 'performanceEvaluationLink',
                'elementProperty' => array(
                    'labelGetter' => array('getEmployee', 'getFullName'),
                    'placeholderGetters' => array('id' => 'getId'),
                    'urlPattern' => 'index.php/performance/reviewEvaluate/id/{id}'),
            ));


            $reviewStatus = array();
            $reviewStatus [ReviewStatusActivated::getInstance()->getStatusId()] = ReviewStatusActivated::getInstance()->getName();
            $reviewStatus [ReviewStatusApproved::getInstance()->getStatusId()] = ReviewStatusApproved::getInstance()->getName();
            $reviewStatus [ReviewStatusInProgress::getInstance()->getStatusId()] = ReviewStatusInProgress::getInstance()->getName();
            $reviewStatus [ReviewStatusInactive::getInstance()->getStatusId()] = ReviewStatusInactive::getInstance()->getName();

            $header6->populateFromArray(array(
                'name' => 'Status',
                'width' => '15%',
                'isSortable' => false,
                'sortField' => null,
                'filters' => array('EnumCellFilter' => array(
                        'enum' => $reviewStatus,
                        'default' => ''),
                    'I18nCellFilter' => array()
                ),
                'elementType' => 'label',
                'textAlignmentStyle' => 'left',
                'elementProperty' => array('getter' => 'getStatusId'),
            ));


            $reviewStatus = array();
            $reviewStatus [ReviewerReviewStatusActivated::getInstance()->getStatusId()] = ReviewerReviewStatusActivated::getInstance()->getName();
            $reviewStatus [ReviewerReviewStatusCompleted::getInstance()->getStatusId()] = ReviewerReviewStatusCompleted::getInstance()->getName();
            $reviewStatus [ReviewerReviewStatusInProgress::getInstance()->getStatusId()] = ReviewerReviewStatusInProgress::getInstance()->getName();

            $header7->populateFromArray(array(
                'name' => 'Evaluation Status',
                'width' => '15%',
                'isSortable' => false,
                'sortField' => null,
                'filters' => array('EnumCellFilter' => array(
                        'enum' => $reviewStatus,
                        'default' => ''),
                    'I18nCellFilter' => array()
                ),
                'elementType' => 'label',
                'textAlignmentStyle' => 'left',
                'elementProperty' => array('getter' => array('getReviewers', 'getFirst', 'getStatus')),
            ));
        }

        $header2->populateFromArray(array(
            'name' => 'Due Date',
            'width' => '10%',
            'isSortable' => false,
            'sortField' => null,
            'elementType' => 'DueDate',
        ));

        $header3->populateFromArray(array(
            'name' => 'Review Period',
            'width' => '20%',
            'isSortable' => false,
            'sortField' => null,
            'elementType' => 'ReviewPeriod',
        ));

        $header4->populateFromArray(array(
            'name' => 'Job Title',
            'width' => '10%',
            'isSortable' => false,
            'sortField' => null,
            'elementType' => 'label',
            'elementProperty' => array('getter' => array('getJobTitle', 'getJobTitle')),
        ));

        $header5->populateFromArray(array(
            'name' => 'Department',
            'width' => '10%',
            'isSortable' => false,
            'sortField' => null,
            'elementType' => 'label',
            'elementProperty' => array('getter' => array('getDepartment', 'getName')),
        ));




        $this->headers = array($header1, $header2, $header3, $header4, $header5, $header6, $header7);
    }

    /**
     *
     * @return string 
     */
    public function getClassName() {
        return 'EvaluationReviewList';
    }

}
