<?php

namespace app\Helpers;

use App\Helpers\Contracts\PaginationStateContract;

use Illuminate\Support\Facades\Log;

class PaginationState implements PaginationStateContract
{

    private $paginationPage;
    private $paginationItemsPerPage;

    /**
     * store current pagination page number in session
     *
     * @param int $page pagination page number
     */
    public function storePaginationPage($page)
    {
        $this->paginationPage = $page;
        session(['paginationPage' => $this->paginationPage]);
    }

    /**
     * retrieve current pagination page number from session
     * @return int current page number
     */
    public function retrievePaginationPage()
    {
        return session('paginationPage');
    }

    /**
     * store current items per page number in session
     * @param int $number number of items to show per page
     */
    public function storePaginationItemsPerPage($number)
    {
        $this->paginationItemsPerPage = $number;
        session(['paginationItemsPerPage' => $this->paginationItemsPerPage]);
    }

    /**
     * retrieve current items per page number from session
     * @return int items per page
     */
    public function retrievePaginationItemsPerPage()
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
        $collection = $model::orderBy($order_field,'asc')->get();
        //$key = array_search($order_value, $collection->map->$order_field->toArray());
        $key = array_search($order_value, $collection->map->$order_field->toArray());
        $itemsPerPage = $this->getPaginationItemsPerPage();
        // this calculation not quite right e.g. per page 6, items 75 gives 12, should be 13
        Log::debug('per page: ' . $itemsPerPage . ' key ' . $key);
        return floor($key/$itemsPerPage);
    }

}
