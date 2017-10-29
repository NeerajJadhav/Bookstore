<?php

class Cart {
    private $_db,
        $_data,
	   $itemList;


    public function __construct($Cart = null) {
        $this->_db = DB::getInstance();
	   $this->_itemList = array();
    }

    public function add($bookID = '0') {

		if(strcmp($bookID, '0') !== 0){

			$title = $this->_db->action('SELECT Title', 'books', array('BookID', '=', $bookID));

//This assumes there is a Cost column in the books table.
			$price = $this->_db->action('SELECT Cost', 'books', array('BookID', '=', $bookID));

		array_push($itemList, array("id" => $bookID, "title" => $title, "price" => $price));
		$this->_db->insert('cart',array('BookID'=>$bookID,'UserID'=>1,'CartItems'=>json_encode($itemList)));
		}
	else{
	//Error, no bookID received.
	}
    }
	public function remove($bookID = '0'){
		
		if(strcmp($bookID, '0') !== 0){
			
			//remove the subarray with id key = bookID.
			foreach($this->itemList as $subKey => $subArray){
          			if($subArray["id"] == $bookID){
               			unset($this->itemList[$subKey]);
          			}
     			}
		}
		else{
		//Error, no bookID received
		}	

	}
	public function get_cart(){
	    $result = $this->_db->get('Cart',array('UserID','=',1))->first();
	    Config::debug($result);
		return ;
	}

	public function get_balance(){
		$priceColumns = array_column($this->itemList, 'price');
		$bal = array_sum($priceColumns);
		return $bal;
	}
}
?>