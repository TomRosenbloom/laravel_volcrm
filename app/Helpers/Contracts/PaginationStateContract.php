<?php

namespace App\Helpers\Contracts;

Interface PaginationStateContract
{

    public function storePaginationPage($page);

    public function retrievePaginationPage();

    public function storePaginationItemsPerPage($number);

    public function retrievePaginationItemsPerPage();

    public function calculatePaginationPage($model_name, $order_field, $order_value);
}
