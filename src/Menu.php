<?php

namespace Therour\MenuDirective;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Menu
{
    const MENU = 'menu';
    const HEADING = 'heading';
    const SUBMENU = 'submenu';

    protected $title;
    protected $href;
    protected $route;
    protected $url;
    protected $icon;
    protected $active;
    protected $type = 'menu';
    protected $attributes = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->setTitle(Arr::get($attributes, 'title'));
        $this->setHref(Arr::only($attributes, ['href', 'url', 'route']));
        $this->setIcon(Arr::get($attributes, 'icon'));
        $this->setActive(Arr::get($attributes, 'active'));
        $this->setType(Arr::get($attributes, 'type', static::MENU));
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    public function setIcon(?string $icon)
    {
        $this->icon = $icon;
    }

    public function setHref(array $urls)
    {
        if (isset($urls['url'])) {
            $this->href = url($urls['url']);
        } elseif (isset($urls['route'])) {
            $this->href = route($urls['route']);
            $this->route = $urls['route'];
        }
    }

    public function setActive(?string $active)
    {
        $this->active = $active;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute(string $key)
    {
        return Arr::get($this->attributes, $key);
    }

    public function isActive(Request $request)
    {
        if ($request->url() == $this->getHref()) {
            return true;
        }
        if ($this->route && $this->active && $request->route()->named($this->active)) {
            return true;
        }
        if ($this->active && $this->isMatchWildcard($request->url(), url($this->active))) {
            return true;
        }
    }

    public function isMatchWildcard($source, $pattern)
    {
        if (substr($pattern, -1) === '*') {
            $source .= '/';
        }
        return Str::is($pattern, $source);
    }
}
