<?php

interface IResponse {
    public function send($content);
    public function sendJSON($content);
    public function redirect($url);
    public function sendFile($location);
    public function render(ITemplate $template);
}