<?php

namespace aop\advice;

class AopTimer implements IAdvice {

    private $_logger = null;

    public function __construct ($logger = null) {
        $this->_logger = $logger;
    }

    public function getKindOfAdvice() {
        return AOP_KIND_AROUND;
    }

    public function __invoke (\AopJoinpoint $aop) {
        $time = microtime(true);
        $aop->process();
        $time = microtime(true)-$time;
        if ($aop->getKindOfAdvice() & AOP_KIND_METHOD) {
            $call = $aop->getClassName()."::".$aop->getMethodName();
        } else {
            $call = $aop->getFunctionName();
        }
        $log = sprintf ("%s en %f", $call, $time);
        if ($this->_logger!=null) {
            $this->_logger->addInfo($log);
        } else {
            echo $log;
        }
    }

}
