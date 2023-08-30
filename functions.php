<?php
class functions{
    public function sanitaization($input)
    {
        return trim(HTMLSPECIALCHARS(htmlentities($input)));
    }
}