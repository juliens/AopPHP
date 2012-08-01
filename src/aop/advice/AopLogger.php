<?php

namespace aop\advice;

class AopLogger implements IAdvice {

    private $_logger = null;

    private $_timer = false;

    private $_args = null;

    private $_return = true;

    public function __construct (array $options = array ()) {
        if (isset ($options['logger'])) {
            $this->_logger = $options['logger'];
        }
        if (isset ($options['timer']) && $options['timer']) {
            $this->_timer = true;
        }

        if (isset ($options['args'])) {
            if (!is_array($options['args'])) {
                $options['args'] = explode(';', $options['args']);
            }
            $this->_args = $options['args'];
        }
        if (isset ($options['return'])) {
            $this->_return = $options['return'];
        }
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

        $message= sprintf ("%s en %f", $call, $time);
        $log = array ();
        if ($this->_timer) {
            $log['timer'] = $time;
        }
        if ($this->_args==null) {
            $log['args'] = $aop->getArguments();
        }
        if ($this->_return) {
            $log['return'] = $aop->getReturnedValue();
        }
        if ($this->_logger!=null) {
            $this->_logger->addInfo($message,$log);
        } else {
            echo $message." ".var_export($log, true);
        }

    }

}
