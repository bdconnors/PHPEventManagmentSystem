<?php
interface IRequest{
    public function getBody();
    public function getParsedUrl();
    public function getPath();
    public function query($param);
    public function getQuery();
    public function hasParam($param);
    public function getJSONBody();
}