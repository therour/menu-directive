<?php

namespace Therour\MenuDirective;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Dropdown extends Menu
{
    /**
     * children as collection.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $children;

    protected $id;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
        $this->children = collect();
        $this->id = 'menu-dir-'. Str::random(10);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * get children.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function add(array $attributes): Menu
    {
        $this->children->push(
            $menu = new Menu($attributes)
        );

        return $menu;
    }

    public function menu(array $attributes)
    {
        return $this->add($attributes);
    }

    public function heading(string $title)
    {
        return $this->add([
            'type' => Menu::HEADING,
            'title' => $title,
        ]);
    }
}
