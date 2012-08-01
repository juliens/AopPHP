<?php
namespace aop;

class Aop {

    public function add ($pSelector, \aop\advice\IAdvice $pAdvice) {
        switch ($pAdvice->getKindOfAdvice()) {
            case AOP_KIND_AROUND:
                $this->add_around($pSelector, $pAdvice);
                break;
            case AOP_KIND_BEFORE:
                $this->add_before($pSelector, $pAdvice);
                break;
            case AOP_KIND_AFTER:
                $this->add_after($pSelector, $pAdvice);
                break;
        } 
    }

    public function add_around ($pSelector, $pAdvice) {
        aop_add_around($pSelector, $pAdvice);
    }
    public function add_after ($pSelector, $pAdvice) {
        aop_add_after($pSelector, $pAdvice);
    }
    public function add_before ($pSelector, $pAdvice) {
        aop_add_before($pSelector, $pAdvice);
    }

}
