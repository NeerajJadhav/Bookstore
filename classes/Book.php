<?php


class Book
{
    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $isLoggedIn;

    public function __construct(){
        $this->_db = DB::getInstance();

    }

    public function getBook($BookID){
        return $this->_db->get('books',array($this->_db->getIDFieldName('books'),'=',$BookID))->first();

    }

    public function getAllBooks(){
        return $this->_db->query("SELECT * FROM books")->results();
    }

    public function findBook($searchString){

        if(is_numeric($searchString)){
            $isbnResult = $this->_db->get('books',array('ISBN','LIKE',$this->formatSearchString($searchString))
            )->results();
            if(count($isbnResult))
                return $this->formatResult($isbnResult);

        }else {
            $authorResult = $this->_db->get('books', array('Authors', 'LIKE', $this->formatSearchString($searchString))
            )->results();

            $titleResult = $this->_db->get('books', array('Title', 'LIKE', $this->formatSearchString($searchString))
            )->results();


            if(count($authorResult)){
                return $this->formatResult($authorResult);
            }elseif (count($titleResult)){
                return $this->formatResult($titleResult);
            }
        }
        return false;
    }

    public function formatResult($result){
            foreach ($result as $bookItem){
                $formattedResults[] =
                    array("BookID"=>$bookItem->BookID,
                        "Author"=>$bookItem->Authors,
                        "Title"=>$bookItem->Title,
                        "Price"=>$bookItem->Cost,
                        "ImageURL"=>$this->getBookCoverImageURL($bookItem->ISBN),
                        "BookStock"=>$this->getBookStock()
                    );
            }
            return $formattedResults;

    }

    private function formatSearchString($string){
        return '%'.$string.'%';
    }

    public function getBookCoverImageURL($isbn){
        $imageURL = false;
        if(is_numeric($isbn)){
            $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}";
            $response = file_get_contents($url);
            $googleBook = json_decode($response);
            if($googleBook->totalItems < 1){
                $imageURL = 'resources'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ImageUnavailable.png';
            }else{
                $imageURL = $googleBook->items[0]->volumeInfo->imageLinks->thumbnail;
            }
            return $imageURL;

        }
        return $imageURL;
    }

    private function getBookStock(){
        return 10;
    }

    public function insertBook($Title='',$Author='',$Category='',$Publisher='',$ISBN='',$Description='',$Cost=0){

        return $this->_db->insert('books',array(
            'Title'      => trim($Title),
            'Authors'    => trim($Author),
            'Category'   => trim($Category),
            'Publisher'  => trim($Publisher),
            'ISBN'       => trim($ISBN),
            'Description'=> trim($Description),
            'Cost'       => trim($Cost)
        ));
    }

    public function updateBook($BookID,$params){

        return $this->_db->update('books',$BookID,$params);
    }
}