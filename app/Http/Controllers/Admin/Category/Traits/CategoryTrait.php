<?php

namespace App\Http\Controllers\Admin\Category\Traits;

use Illuminate\Support\Collection;

trait CategoryTrait
{
    /**
     * 体验卡列表属性填充
     * @param Collection $items
     * @return Collection
     */
    public function formatCategory(Collection $items)
    {
        return $items->each(function ($item) {

            $item->titleName = $item->title;

            if(empty($item->titleName) and ($page = $item->relationPage)) {
                $item->titleName = $page->title;
            }
        });
    }
}
