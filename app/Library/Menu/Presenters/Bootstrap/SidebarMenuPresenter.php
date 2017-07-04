<?php

namespace App\Library\Menu\Presenters\Bootstrap;

use App\Library\Menu\Presenters\Presenter;

class SidebarMenuPresenter extends Presenter
{
    /**
     * {@inheritdoc }.
     */
    public function getOpenTagWrapper()
    {
        return '[';
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return ']';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '{
                "title": "'.$item->title.'",
                "icon": "'.$item->getIcon().'",
                "href": "'.$item->getUrl().'"
            },';
    }

    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param string $state
     *
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc }.
     */
    public function getDividerWrapper()
    {
        return '';
    }

    /**
     * {@inheritdoc }.
     */
    public function getHeaderWrapper($item)
    {
        return '';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return'{
            "title": "'.$item->title.'",
            "icon": "'.$item->getIcon().'",
            "href": "",
            "spread": false,
            "children": ['.$this->getChildMenuItems($item).']
        },';
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param \App\Library\Menu\MenuItem $item
     *
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {

        return '';
    }
}
