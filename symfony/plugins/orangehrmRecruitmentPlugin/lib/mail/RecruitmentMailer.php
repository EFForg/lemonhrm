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
 *
 */

/**
 * Recruitment Mail observer
 */
class RecruitmentMailer implements ohrmObserver {

    protected $emailService;

    /**
     * Get email service instance
     * @return EmailService
     */
    public function getEmailService() {
        if (empty($this->emailService)) {
            $this->emailService = new EmailService();
        }
        return $this->emailService;
    }

    public function setEmailService(EmailService $emailService) {
        $this->emailService = $emailService;
    }

    public function listen(sfEvent $event) {

        $logger = Logger::getLogger('recruitment.recruitmentmailer');
        $logger->debug('Email event triggered.');

        $eventData = $event->getParameters();

        $emailType = 'recruitment.apply';
        $recipientRole = array('hiring_manager');
        $performerRole = null;
        $this->getEmailService()->sendEmailNotifications($emailType, $recipientRole, $eventData,
                strtolower($performerRole));
                
    }
}
