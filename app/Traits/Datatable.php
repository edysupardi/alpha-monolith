<?php

namespace App\Traits;
use DataTables;

trait Datatable {

    protected $page         = 1;
    protected $skip         = 0;
    protected $pageSize     = 10;
    protected $orderField   = 'id';
    protected $orderState   = 'ASC';

    public function of($source, \Illuminate\Http\Request $request = null){
        $request = $request == null ? app('request') : $request;

        $start = $request->has('page') ? $request->page : $this->page;
        $start = $start > 0 ? $start - 1 : $this->page;
        $length = $request->has('page_size') ? $request->page_size : $this->pageSize;
        $pagination = [
            'start' => ($start * $length),
            'length' => $length,
        ];
        $request->merge($pagination);

        if($request->has('search')){
            if(!$request->has('search.value'))
                $request->merge([
                    'search' => [
                        'value' => $request->search
                    ]
                ]);
        }

        if(!$request->has('columns')) {
            $columns = [];
            if(method_exists($this, 'getColumns')){
                $list = $this->getColumns();
                foreach ($list as $k => $v) {
                    $columns[$k]=[
                        'searchable' => array_key_exists('searchable', $v) ? (bool) $v['searchable'] : true,
                        'orderable' => array_key_exists('orderable', $v) ? (bool) $v['orderable'] : true,
                        'name' => array_key_exists('name', $v) ? $v['name'] : '',
                    ];
                }
            }

            if(count($columns) == 0 && $this->fillable && is_array($this->fillable) && count($this->fillable) > 0){
                $list = $this->fillable;
                foreach ($list as $k => $v) {
                    $columns[$k]=[
                        'searchable' => true,
                        'orderable' => true,
                        'name' => $v,
                    ];
                }
            }

            if(count($columns) > 0)
                $request->merge(['columns' => $columns]);
        }

        // ordering
        $orderState = $request->has('order_state') ? $request->order_state : $this->orderState;
        if($request->has('order')){
            $source->orderBy($request->order, $orderState);
        }

        $result = (array)DataTables::eloquent($source)->make(true)->getData();
        $result['records_filtered'] = $result['recordsFiltered'];
        $result['records_total'] = $result['recordsTotal'];
        unset($result['recordsFiltered']);
        unset($result['recordsTotal']);

        return $this->paginationUrl($request, $result);
    }

    function paginationUrl($request, $result){
        $nextUrl    = "";
        $prevUrl    = "";
        $firstUrl   = "";
        $lastUrl    = "";

        $this->page = $request->has('page') ? $request->page : $this->page;
        $this->skip = $this->page > 0 ? $this->page - 1 : $this->page;
        $this->pageSize = $request->has('page_size') ? $request->page_size : $this->pageSize;
        $this->orderField = $request->has('order') ? $request->order : $this->primaryKey;
        $this->orderState = $request->has('order_state') ? $request->order_state : $this->orderState;

        $this->takeSize   = $this->skip * $this->pageSize;

        $urlParam = [];
        if($request->has('page'))
            $urlParam['page'] = $request->page;
        if($request->has('page_size'))
            $urlParam['page_size'] = $request->page_size;
        if($request->has('order'))
            $urlParam['order'] = $this->orderField;
        if($request->has('order_state'))
            $urlParam['order_state'] = $this->orderState;
        if($request->has('search')){
            $urlParam['search'] = $request->search['value'];
        }

        $route = $this->datatableRoute;

        if($result['records_filtered'] > ($this->takeSize + $this->pageSize) && $result['records_filtered'] > $this->pageSize){
            $urlParam['page'] = $this->page + 1;
            $nextUrl = $route .'?'. http_build_query($urlParam);

            $urlParam['page'] = ceil($result['records_filtered'] / $this->pageSize);
            $lastUrl = $route .'?'. http_build_query($urlParam);
        }

        if($this->page > 1){
            $urlParam['page'] = $this->page - 1;
            $prevUrl = $route .'?'. http_build_query($urlParam);

            $urlParam['page'] = 1;
            $firstUrl = $route .'?'. http_build_query($urlParam);
        }

        if(!empty($firstUrl))
            $result['first_url'] = $firstUrl;
        if(!empty($prevUrl))
            $result['prev_url']  = $prevUrl;
        if(!empty($nextUrl))
            $result['next_url']  = $nextUrl;
        if(!empty($lastUrl))
            $result['last_url']  = $lastUrl;

        return $result;
    }
}
