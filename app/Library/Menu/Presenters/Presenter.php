<?php

namespace App\Library\Menu\Presenters;

use App\Library\Menu\MenuItem;

abstract class Presenter
{
    /**
     * Get open tag wrapper.
     *
     * @return string
     */
    abstract function getOpenTagWrapper();

    /**
     * Get close tag wrapper.
     *
     * @return string
     */
    abstract function getCloseTagWrapper();

    /**
     * Get menu tag without dropdown wrapper.
     *
     * @param MenuItem $item
     *
     * @return string
     */
    abstract function getMenuWithoutDropdownWrapper($item);


    /**
     * Get divider tag wrapper.
     *
     * @return string
     */
    abstract function getDividerWrapper();

    /**
     * Get header dropdown tag wrapper.
     *
     * @param MenuItem $item
     *
     * @return string
     */
    abstract function getHeaderWrapper($item);

    /**
     * Get menu tag with dropdown wrapper.
     *
     * @param MenuItem $item
     *
     * @return string
     */
    abstract function getMenuWithDropDownWrapper($item);

    /**
     * Get multi level dropdown menu wrapper.
     *
     * @param MenuItem $item
     *
     * @return string
     */
    abstract function getMultiLevelDropdownWrapper($item);

    /**
     * Get child menu items.
     *
     * @param MenuItem $item
     *
     * @return string
     */
    public function getChildMenuItems(MenuItem $item)
    {

        $results = '';
        foreach ($item->getChilds() as $child) {
            if ($child->hidden()) {
                continue;
            }
            
            if ($child->hasSubMenu()) {
                $results .= $this->getMultiLevelDropdownWrapper($child);
            } elseif ($child->isHeader()) {
                $results .= $this->getHeaderWrapper($child);
            } elseif ($child->isDivider()) {
                $results .= $this->getDividerWrapper();
            } else {
                $results .= $this->getMenuWithoutDropdownWrapper($child);
            }
        }

        return $results;
    }
}
