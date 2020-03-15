<?php


class Validation {
    private Sanitization $sanitization;
    public function __construct(Sanitization $sanitization) {
        $this->sanitization = $sanitization;
    }

    public function validateAlpha($value) {
        $valid = true;
        $value = $this->sanitization->sanitize($value);
        $reg = "/^[A-Za-z]+$/";
        $validAlpha = preg_match($reg,$value);
        $isAttack = $this->attackAttempted($value);
        if(!$validAlpha || $isAttack){
            $valid = false;
        }
        return $valid;
    }
    public function validateNumber($value){
        $valid = true;
        $value = $this->sanitization->sanitize($value);
        $reg = "/^[0-9]*$/";
        $validNumber = preg_match($reg,$value);
        $isAttack = $this->attackAttempted($value);
        if(!$validNumber|| $isAttack){
            $valid = false;
        }
        return $valid;
    }
    public function validateAlphaNumeric($value){
        $valid = true;
        $reg="/^[a-z0-9]+$/i";
        $validAlphaNum = preg_match($reg,$value);
        $isAttack = $this->attackAttempted($value);
        if(!$validAlphaNum||$isAttack){
            $valid = false;
        }
        return $valid;
    }
    public function validateDate($value){
        $valid = true;
        $value = $this->sanitization->sanitize($value);
        $reg = "/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/";
        $validDate = preg_match($reg,$value);
        $isAttack = $this->attackAttempted($value);
        if(!$valid || $isAttack){
            $valid = false;
        }
        return $valid;
    }
    protected function attackAttempted($value){
        $isAttack = false;
        $scriptingAttempted = $this->scriptingAttempted($value);
        $injectionAttempted = $this->injectionAttempted($value);
        if($scriptingAttempted || $injectionAttempted){
            $isAttack = true;
        }
        return $isAttack;
    }
    protected function injectionAttempted($value){
        $injectionAttempted = false;
        $meta = $this->sqlMetaChars($value);
        $inject = $this->sqlInjection($value);
        $union = $this->sqlInjectionUnion($value);
        $select = $this->sqlInjectionSelect($value);
        $delete = $this->sqlInjectionDelete($value);
        $drop = $this->sqlInjectionDrop($value);
        $insert = $this->sqlInjectionInsert($value);
        $update = $this->sqlInjectionUpdate($value);
        if($meta|| $inject|| $union || $select|| $delete || $drop|| $insert || $update){
            $injectionAttempted = true;
        }
        return $injectionAttempted;
    }
    protected function scriptingAttempted($value){
        $scriptingAttempted = false;
        $crossSite = $this->crossSite($value);
        $crossSiteImg = $this->crossSiteImg($value);
        $crossSiteExtra = $this->crossSiteAdditional($value);
        if($crossSite || $crossSiteImg || $crossSiteExtra){
            $scriptingAttempted = true;
        }
        return $scriptingAttempted;
    }
    protected function sqlMetaChars($value) {
        $reg = "/((\%3D)|(=))[^\n]*((\%27)|(\')|(\-\-)|(\%3B)|(;))/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjection($value) {
        $reg = "/\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionUnion($value) {
        $reg = "/((\%27)|(\'))union/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionSelect($value) {
        $reg = "/((\%27)|(\'));\s*select/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionInsert($value) {
        $reg = "/((\%27)|(\'));\s*insert/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionDelete($value) {
        $reg = "/((\%27)|(\'));\s*delete/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionDrop($value) {
        $reg = "/((\%27)|(\'));\s*drop/i";
        return preg_match($reg,$value);
    }
    protected function sqlInjectionUpdate($value) {
        $reg = "/((\%27)|(\'));\s*update/i";
        return preg_match($reg,$value);
    }
    protected function crossSite($value) {
        $reg = "/((\%3C)|<)((\%2F)|\/)*[a-z0-9\%]+((\%3E)|>)/i";
        return preg_match($reg,$value);
    }
    protected function crossSiteImg($value) {
        $reg = "/((\%3C)|<)((\%69)|i|(\%49))((\%6D)|m|(\%4D))((\%67)|g|(\%47))[^\n]+((\%3E)|>)/i";
        return preg_match($reg,$value);
    }
    protected function crossSiteAdditional($value) {
        $reg = "/((\%3C)|<)[^\n]+((\%3E)|>)/i";
        return preg_match($reg,$value);
    }

}