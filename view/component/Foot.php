<?php

require_once'./interface/ITemplate.php';
class Foot implements ITemplate {
    static public function render($values = array('scripts'=>array())) {
        $foot = Foot::createScriptTags($values['scripts']);
        $foot .= "</body></html>";
        return $foot;
    }
    static public function createScriptTags($scripts = array()){
        $tags = "";
        foreach ($scripts as $script) {
            $tags.="<script src='./js/{$script}.js'></script>";
        }
        return $tags;
    }
}