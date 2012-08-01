<?php

namespace aop\advice;

interface IAdvice {
    public function getKindOfAdvice();
    public function __invoke(\AopJoinpoint $aop);
}
