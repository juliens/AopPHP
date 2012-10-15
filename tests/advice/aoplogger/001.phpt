--TEST--
AopLogger without options
--FILE--
<?php
    require_once('./src/aop/advice/IAdvice.php');
    require_once('./src/aop/advice/AopLogger.php');

$aoplogger = new aop\advice\aoplogger();

$aop->logger

?>
--EXPECT--

