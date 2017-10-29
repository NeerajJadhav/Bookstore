<?php


class Reviews
{
    private $_db;

    public function __construct(){
        $this->_db=DB::getInstance();
    }

    public function getReviews($bookId){
        $allReviews = $this->_db->get('reviews',array('BookID','=',$bookId))->results();

        return $allReviews;
    }

    public function setReview($bookId,$customerId,$review,$rating){
        $this->_db->insert('reviews',array(
            'BookID'=> $bookId,
            'UserID'=>$customerId,
            'Review'=>$review,
            'Rating'=>$rating
        ));
    }

    public function getAvgRating($bookId){
        $allReviews = $this->_db->get('reviews',array('BookID','=',$bookId))->results();
        $ratingCount = 0;
        $rate = 0;
        foreach ($allReviews as $review=>$value){
            $rate += (int)$value->Ratings;
            $ratingCount++;
        }
        return round($rate/$ratingCount,1);
}
}