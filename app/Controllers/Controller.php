<?php
namespace app\Controllers;

class Controller {

    public function view($view = "index"):void
    {
        require_once __DIR__."/../../view/".$view.".php";
    }
}
