<?php

/**
 * Created by PhpStorm.
 * User: niraj
 * Date: 07-Dec-2016
 * Time: 04:10 PM
 */
class PurchaseHistory
{

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function getHistory($userID){

    }

    public function setHistory($userID,$items){

    }
}