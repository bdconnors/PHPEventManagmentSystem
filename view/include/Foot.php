<?php

require_once './interface/ITemplate.php';
class Foot implements ITemplate {
    public $scripts;
    public function __construct($scripts = array()){
        $this->scripts = $scripts;
    }

    public function __toString() {
        $foot = "";
        foreach ($this->scripts as $script) {
            $foot.="<script src='/js/{$script}.js'></script>";
        }
        $foot .= "</body></html>";
        return $foot;
    }
}