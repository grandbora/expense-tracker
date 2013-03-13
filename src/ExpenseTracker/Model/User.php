<?php
namespace ExpenseTracker\Model;

class User implements JsonSerializable 
{

    public function __construct(Api api) {
    }

    public function jsonSerialize() {
        return $this->array;
    }
}