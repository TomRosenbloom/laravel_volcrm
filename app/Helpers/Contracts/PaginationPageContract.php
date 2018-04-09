<?php

namespace App\Helpers\Contracts;

Interface PaginationPageContract
{

    public function setPaginationPage($page);

    public function getPaginationPage();

}
