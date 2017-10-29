<?php


class Stock
{
    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function getStock($bookID){
        $stock = $this->_db->get('stock',array('BookID','=',$bookID))->first();
        return (int)$stock->Quantity;
    }

    public function getBookDiscount($bookID){
        $stock = $this->_db->get('stock',array('BookID','=',$bookID))->first();
        return (int)$stock->Discount;
    }

    public function modifyBookDiscount($bookID,$discount){
        $stock = $this->_db->get('stock',array('BookID','=',$bookID))->first();
        if(is_numeric($discount) && $discount >= 0){
            if($this->_db->update('stock',$stock->StockID,array('Discount'=>$discount)))
                throw new Exception('Unable to modify discount');
            else
                return true;
        }

        return false;
    }

    public function modifyBookQuantity($bookID,$quantity){
        $stock = $this->_db->get('stock',array('BookID','=',$bookID))->first();
        if(is_numeric($quantity) && $quantity >= 0){
            if(!$this->_db->update('stock',$stock->StockID,array('Quantity'=>$quantity)))
                throw new Exception('Unable to modify quantity');
            else
                return true;
        }

        return false;
    }

    public function insertStock($bookID,$discount,$quantity){
        if(is_numeric($bookID) && (is_numeric($discount) && $discount>=0) && (is_numeric($quantity) && $quantity>=0) ){
            if(!$this->_db->insert('Stock',array('BookID'=>$bookID,'Discount'=>$discount,'Quantity'=>$quantity)))
                throw new Exception('Unable to insert stock');
            else
                return true;
        }

        return false;
    }
}