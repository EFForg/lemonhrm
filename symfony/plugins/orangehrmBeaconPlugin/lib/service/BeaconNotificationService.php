<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BeaconNotificationService
 *
 * @author chathura
 */
class BeaconNotificationService extends BaseService {

    private $beaconNotificationDao;

    protected function getBeaconNotificationDao() {
        if (is_null($this->beaconNotificationDao)) {
            $this->beaconNotificationDao = new BeaconNotificationDao();
        }
        return $this->beaconNotificationDao;
    }
    
    public function setBeaconNotificationDao($beaconNotificationDao) {
        $this->beaconNotificationDao = $beaconNotificationDao;
    }

    public function deleteNotificationByName($name) {
        return $this->getBeaconNotificationDao()->deleteNotificationByName($name);
    }

    public function getNotificationByName($name) {
        return $this->getBeaconNotificationDao()->getNotificationByName($name);
    }

    public function getRandomNotification() {
        return $this->getBeaconNotificationDao()->getRandomNotification();
    }

    public function sanitizeNotificationSection($notificationSection) {
        $dom = new DOMDocument();
        $dom->loadHTML($notificationSection);
        $script = $dom->getElementsByTagName('script');

        $remove = array();
        foreach ($script as $item) {
            $remove[] = $item;
        }

        foreach ($remove as $item) {
            $item->parentNode->removeChild($item);
        }

        return $dom->saveHTML();
    }

}
