<?php

namespace Therour\MenuDirective;

abstract class MenuBuilder
{
    /**
     * Create a Menu instance.
     *
     * @param array $attributes
     * @return \Therour\MenuDirective\Menu
     */
    public function makeMenu(array $attributes)
    {
        return new Menu($attributes);
    }

    /**
     * Create a Menu instance.
     *
     * @param array $attributes
     * @return \Therour\MenuDirective\Dropdown
     */
    public function makeDropdown(array $attributes, \Closure $callback)
    {
        $dropdown = new Dropdown($attributes);
        $callback($dropdown);

        return $dropdown;
    }

    /**
     * Render a divider
     *
     * @return string
     */
    abstract public function renderDivider();

    /**
     * Render a sidebar heading
     *
     * @param string $title
     * @return string
     */
    abstract public function renderHeading(string $expression);

    /**
     * Render a menu with defined attribute.
     *
     * @param array $attributes
     * @param \Therour\MenuDirective\Menu $menu
     * @return string
     */
    abstract public function renderMenu(Menu $menu);

    /**
     * Render a dropdown with defined attribute.
     *
     * @param \Therour\MenuDirective\Dropdown $dropdown
     * @return string
     */
    abstract public function renderDropdown(Dropdown $dropdown);

    /**
     * Render a dropdown heading.
     *
     * @param string $title
     * @return string
     */
    abstract public function renderDropdownHeading(string $title);

    /**
     * Render a dropdown submenu.
     *
     * @param \Therour\MenuDirective\Menu $menu
     * @return string
     */
    abstract public function renderDropdownMenu(Menu $menu);
}
