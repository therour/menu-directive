<?php

namespace Therour\MenuDirective;

use Illuminate\Http\Request;

class BootstrapMenuBuilder extends MenuBuilder
{
    /**
     * Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a builder instance.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Render a divider
     *
     * @return string
     */
    public function renderDivider()
    {
        return '<hr class="mx-0 my-2">';
    }

    /**
     * Render a sidebar heading
     *
     * @param string $title
     * @return string
     */
    public function renderHeading(string $title)
    {
        return '<span class="mt-2 mb-1 border-bottom pb-2 h6 border-secondary">'.$title.'</span>';
    }

    /**
     * Render a menu with defined attribute.
     *
     * @param \Therour\MenuDirective\Menu $menu
     * @return string
     */
    public function renderMenu(Menu $menu)
    {
        return '<a href="'.$menu->getHref().'"
class="nav-link'.($menu->isActive($this->request) ? ' active' : '').'"
role="tab" aria-selected="'.($menu->isActive($this->request) ? 'true' : 'false').'">'.$menu->getTitle().'</a>';
    }

    public function renderDropdown(Dropdown $dropdown)
    {
        return '<a href="#" data-toggle="collapse" class="nav-link'.($dropdown->isActive($this->request) ? '' : ' collapsed').'"
data-target="#'.$dropdown->getId().'" aria-expanded="'.($dropdown->isActive($this->request) ? 'true' : 'false').'">'.$dropdown->getTitle().'</a>
<div id="'.$dropdown->getId().'" class="collapse'.($dropdown->isActive($this->request) ? ' show' : '').'" aria-labelledby="label-'.$dropdown->getId().'">
  <div style="border-left: 2px solid" class="border-primary">
  '.$dropdown->getChildren()->map(function ($child) {
            return $child->getType() == Menu::HEADING ?
        $this->renderDropdownHeading($child->getTitle()) :
        $this->renderDropdownMenu($child);
        })->implode('').'
  </div>
</div>';
    }

    public function renderDropdownHeading(string $title)
    {
        return '<small class="pl-3 text-muted">'.$title.'</small>';
    }

    public function renderDropdownMenu(Menu $menu)
    {
        return $this->renderMenu($menu);
    }
}
