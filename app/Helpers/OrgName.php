<?php

namespace App\Helpers;

class OrgName
{
    public static function definiteArticle(string $orgname)
    {
        if (substr($orgname, 0, 4) === "The ") {
            $parts = explode(" ", $orgname, 2);
            $orgname = $parts[1] . " (" . trim($parts[0]) . ")";
        }
        return $orgname;
    }
}
