<?php
class Task{
    public $description;
    public $complated;

    public function isComplate()
    {
        return $this->complated;
    }
    public function complate()
    {
        $this->complated=true;
    }
}
