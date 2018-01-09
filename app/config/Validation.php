<?php
/*
 * info validation
 *
 * */
function validate($var,$type){
    if ($type == "name"){
        if (preg_match("/[^a-z-A-Z ]/i", $var)) {
            return $var;
        }
        return false;
    }
    if ($type == "userName"){
        if (preg_match("/[^a-z-A-Z0-9]/i", $var)) {
            return $var;
        }
        return false;
    }
    if ($type == "password"){
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,25}$/",$var)){
            return $var;
        }
        return false;
    }
    if ($type == "email"){
        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$var)){
            return $var;
        }
        return false;
    }
    if ($type == "address"){
        if (preg_match("/[^a-z-A-Z\ 0-9]/i", $var)) {
            return $var;
        }
        return false;
    }
    if ($type == "message"){
        if (preg_match("/[^a-z-A-Z\ 0-9_-]/i", $var)) {
            return $var;
        }
        return false;
    }
    if ($type == "userMail"){
        if (preg_match("/[^a-z-A-Z\ 0-9_@.].{2,20}$/i", $var)) {
            return $var;
        }
        return false;
    }
    return null;
}
/**
 *
 */