<?php

function check(string $data): bool
{
    if (empty($data) || strlen($data) === 1) {
        return false;
    }

    $dataLength = strlen($data);
    $stack = [];
    $current = null;
    $last = null;
    for ($i = 0; $i < $dataLength; $i++) {
        $current = $data[$i];
        if ($current === "[" || $current === "(" || $current === "{") {
            $stack[] = $current;
            $last = $current;
        } elseif (
            $current === "]" || $current === ")" || $current === "}") {
            if ($last) {
                if (($current === "]" && $last === "[") || ($current === ")" && $last === "(") || ($current === "}" && $last === "{")) {
                    unset($stack[count($stack) - 1]);
                    $last = count($stack) > 0 ? $stack[count($stack) - 1] : null;
                } else {
                    return false;
                }
            }
        }
    }
    return count($stack) === 0;
}

var_dump(check("[({})]"));
