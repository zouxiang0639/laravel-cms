<?php

namespace App\Library\Menu\Presenters\Bootstrap;


class tabMenuPresenter extends NavbarPresenter
{

    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return '<ul class="layui-tab-title site-demo-title" style="margin-bottom: 10px">';
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return '</ul>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li '.$item->getAttributes().'><a href="'.$item->getUrl().'">'.$item->title.'</a></li>';
    }



    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return $this->getChildMenuItems($item);
    }


}
