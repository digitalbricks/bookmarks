<?php
class Bookmarks{

    private $c_name = "bookmarks";
    private $c_lifetime = 3600;
    private $json = "";

    /**
     * Set the bookmark cookie with an empty array if not exists
     * @return void 
     */
    function __construct() {
        if(!isset($_COOKIE[$this->c_name])){
            $inital = json_encode(array());
            setcookie($this->c_name,$inital,time()+$this->c_lifetime,'/');       
        }
        $this->json = $_COOKIE[$this->c_name];
    }

    /**
     * Get the bookmarks from cookie as PHP array
     * @return array 
     */
    public function get(){
        if($this->json!=""){
            $content =  json_decode($this->json,true); // the 'true' argument is important for getting an array!
            if(is_array($content) AND !is_object($content)){
                return $content;
            } 
        } 
        return array();
    }

    /**
     * Adds an entry to the bookmarks (and the cookie)
     * @param mixed $data item to add
     * @return boolean 
     */
    public function add($data){
        $cdata = $this->get();
        if(is_array($cdata)){
            if(!in_array($data,$cdata)){
                $cdata[] = $data;
                if($this->set($cdata)){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Removes an item from the bookmarks (an the cookie)
     * @param mixed $value item to remove
     * @return boolean 
     */
    public function remove($value){
        $cdata = $this->get();
        $key = array_search($value,$cdata);
        unset($cdata[$key]);
        if($this->set($cdata)){
            return true;
        }
        return false;
    }

    /**
     * Gets the number of items on bookmark list
     * @return int 
     */
    public function count(){
        return intval(count($this->get()));
    }

    public function is_allready_there(int $id){
        if(in_array($id,$this->get())){
            return true;
        }
        return false;
    }

    /**
     * Sets the cookie
     * @param array $data PHP of data to set
     * @return boolean 
     */
    private function set(array $data){
        $newdata = stripslashes(json_encode($data));
        if(setcookie($this->c_name,$newdata,time()+$this->c_lifetime,'/')){
            $this->json = $newdata; // update local data
            return true;
        }
        return false;
    }

}


