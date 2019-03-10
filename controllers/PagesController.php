<?php

class PagesController {

    public function home() {

        view('pages.home');

    }
    public function http404() {
        Header('HTTP/1.1 404 Not Found');
        view('pages.404');
    }
    
}