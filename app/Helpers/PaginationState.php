<?php

namespace app\Helpers;

use App\Helpers\Contracts\PaginationStateContract;


class PaginationState implements PaginationStateContract
{

    private $paginationPage;
    private $paginationItemsPerPage;

    /**
     * store current pagination page number in session
     *
     * @param int $page pagination page number
     */
    public function setPaginationPage($page)
    {
        $this->paginationPage = $page;
        session(['paginationPage' => $this->paginationPage]);
    }

    /**
     * retrieve current pagination page number from session
     * @return int current page number
     */
    public function getPaginationPage()
    {
        return session('paginationPage');
    }

    /**
     * store current items per page number in session
     * @param int $number number of items to show per page
     */
    public function setPaginationItemsPerPage($number)
    {
        $this->paginationItemsPerPage = $number;
        session(['paginationItemsPerPage' => $this->paginationItemsPerPage]);
    }

    /**
     * retrieve current items per page number from session
     * @return int items per page
     */
    public function getPaginationItemsPerPage()
    {
        if(session('paginationItemsPerPage')){
            return session('paginationItemsPerPage');
        } else {
            return 4;
        }
    }

    public function calculatePaginationPage($model, $order_field, $order_value)
    {
        // given the model, we can get total number of items
        // we can get items per page from self
        // we need to get the position of this item in model->all ordered by order_field with order_value
        $collection = $model::orderBy('order_name','asc')->get();
        //$key = array_search($order_value, $collection->map->$order_field->toArray());
        $key = array_search('Zebra Club', $collection->map->order_name->toArray());
        $itemsPerPage = $this->getPaginationItemsPerPage();
        return floor($key/$itemsPerPage);
        // works in so far as a value is returned for $key, but is incorrect e.g. 66 instead of 11
    }

}
