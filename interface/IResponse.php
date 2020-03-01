<?php

interface IResponse
{
    public function send($content);
    public function sendJSON($content);
    public function writeBody($content);
    public function sendBody();
}