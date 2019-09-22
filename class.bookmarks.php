<?php
class Bookmarks{

    private $c_name = 'bookmarks';
    private $c_lifetime = 3600;

    /**
     * Set the bookmark cookie with an empty array if not exists
     * @return void 
     */
    function __construct() {
        if(!isset($_COOKIE[$this->c_name])){
            $inital = serialize(array());
            setcookie($this->c_name,$inital,time()+$this->c_lifetime,'/');         
        }     
    }

    /**
     * Get the bookmarks from cookie as PHP array
     * @return array 
     */
    public function get(){
        if(isset($_COOKIE[$this->c_name])){
            $content =  unserialize($_COOKIE[$this->c_name]);
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
                    // update $_COOKIE (for usage until new request)
                    // making sure the get() method will return the up-to-date values
                    $_COOKIE[$this->c_name] = serialize($cdata);
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
            // update $_COOKIE (for usage until new request)
            // making sure the get() method will return the up-to-date values
            $_COOKIE[$this->c_name] = serialize($cdata);
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
        $newdata = serialize($data);
        if(setcookie($this->c_name,$newdata,time()+$this->c_lifetime,'/')){
            return true;
        }
        return false;
    }

}


