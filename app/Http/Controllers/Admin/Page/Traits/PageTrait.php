<?php

namespace App\Http\Controllers\Admin\Page\Traits;

use App\Consts\Admin\Page\PageTemplateConst;
use Illuminate\Support\Collection;

trait PageTrait
{
    /**
     * 体验卡列表属性填充
     * @param Collection $items
     * @return Collection
     */
    public function formatPage(Collection $items)
    {
        return $items->each(function ($item) {
            $item->templateTypeName = PageTemplateConst::getDesc($item->template_type);
            $item->templatePageName = PageTemplateConst::getDesc($item->template_page);
            $item->templateInfoName = PageTemplateConst::getDesc($item->template_info);
        });
    }
}
