<?php


class TemplateManager {
    
    private $values = array();
    public $html;
    
    public function getTemplate($tplName) {
        if(empty($tplName) || !file_exists($tplName)) {
            return false;
        } else {
            $this->html = join('', file($tplName));
        }
    }
    
    public function setValue($key, $var) {
        $key = '{'.$key.'}';
        $this->values[$key] = $var;
    }
    
    public function parseTemplate() {
        foreach ($this->values as $find => $replace) {
            $this->html = str_replace($find, $replace, $this->html);
        }
    }
}
