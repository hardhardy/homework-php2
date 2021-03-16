<?php

function add($x, $y) {
    return $x + $y;
}

if (add(2, 3) == 5) {
    echo "add ok";
} else {
    echo "add error";
}