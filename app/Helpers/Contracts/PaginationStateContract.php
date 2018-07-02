<?php

namespace App\Helpers\Contracts;

Interface PaginationStateContract
{

    public function setPaginationPage($page);

    public function getPaginationPage();

    public function setPaginationItemsPerPage($number);

    public function getPaginationItemsPerPage();

    public function calculatePaginationPage($model_name, $order_field, $order_value);
}
