<?php

interface IResponse
{
    public function send($content);
    public function sendJSON($content);
}