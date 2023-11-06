<?php

if(!function_exists('dd')){
    function dd($e){
        var_dump($e);
        die();
    }
}

if(!function_exists('redirect')){
    function redirect($path){
        header("Location:$path");
    }
}



if(!function_exists('e')){
    function e($string){
        return htmlspecialchars($string);
    }
}

if(!function_exists('setFlashMessage')){
function setFlashMessage($message, $title, $type, $confirm_text) {
    $_SESSION['flash_message'] = [
        'message' => $message,
        'title' => $title,
        'type' => $type,
        'confirm_text' => $confirm_text
    ];
}
}

function clearFlashMessage()
{
    unset($_SESSION['flash_message']);
}