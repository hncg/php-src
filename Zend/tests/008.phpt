--TEST--
define() tests
--FILE--
<?php

try {
    var_dump(define(array(1,2,3,4,5), 1));
} catch (TypeError $e) {
    echo "TypeError: ", $e->getMessage(), "\n";
}

var_dump(define("TRUE", 1));
var_dump(define(" ", 1));
var_dump(define("[[[", 2));
var_dump(define("test const", 3));
var_dump(define("test const", 3));
var_dump(define("test", array(1)));
var_dump(define("test1", fopen(__FILE__, 'r')));

try {
var_dump(define("test2", new stdclass));
} catch (TypeError $exception) {
    echo $exception->getMessage() . "\n";
}

var_dump(constant(" "));
var_dump(constant("[[["));
var_dump(constant("test const"));

echo "Done\n";
?>
--EXPECTF--
TypeError: define(): Argument #1 ($constant_name) must be of type string, array given

Notice: Constant TRUE already defined in %s on line %d
bool(false)
bool(true)
bool(true)
bool(true)

Notice: Constant test const already defined in %s on line %d
bool(false)
bool(true)
bool(true)
define(): Argument #2 ($value) cannot be an object, stdClass given
int(1)
int(2)
int(3)
Done
