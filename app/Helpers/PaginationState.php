<?php

namespace app\Helpers;

use App\Helpers\Contracts\PaginationStateContract;

class PaginationState implements PaginationStateContract
{

    private $paginationPage;
    private $paginationItemsPerPage;

    public function setPaginationPage($page)
    {
        $this->paginationPage = $page;
        session(['paginationPage' => $this->paginationPage]);
    }

    public function getPaginationPage()
    {
        return session('paginationPage');
    }

    public function setPaginationItemsPerPage($number)
    {
        $this->paginationItemsPerPage = $number;
        session(['paginationItemsPerPage' => $this->paginationItemsPerPage]);
    }

    public function getPaginationItemsPerPage()
    {
        if(session('paginationItemsPerPage')){
            return session('paginationItemsPerPage');
        } else {
            return 4;
        }
    }
}
