<?php

namespace app\Helpers;

use App\Helpers\Contracts\PaginationPageContract;

class PaginationPage implements PaginationPageContract
{

    private $paginationPage;

    public function setPaginationPage($page)
    {
        $this->paginationPage = $page;
        session(['paginationPage' => $this->paginationPage]);
    }

    public function getPaginationPage()
    {
        return session('paginationPage');
    }

}
