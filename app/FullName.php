<?php

namespace App;

trait FullName
{
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
