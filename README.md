# Laravel Menu Directive
Create a menu for navigation with blade directive

## Installation
Just install the package via composer
```
composer require therour/menu-directive
```

## Configuration
1. Publish the config file
```
php artisan vendor:publish --provider="Therour\MenuDirective\MenuDirectiveServiceProvider"
```
2. You can change the builder with your own class to match your UI in the `config/menu-directive.php` file. the example builder is defined on default config.
```php
'builder' => Therour\MenuDirective\BootstrapMenuBuilder::class,
```

## Create Menu Builder
-- WIP --

## Create menu
```php
@sidebarHeading('Heading 1') // output Heading 1

@sidebarMenu([ // Create Menu
    'title' => 'Application',
    'icon' => 'fas fa-fw fa-cubes',
    'url' => '#',
    // 'active' => '/' // define your url pattern to match for giving active class
    // by default is current url == menu's url will set the menu's class active.
])

@sidebarDropdown([ // Create Dropdown menu
    'title' => 'Dropdowns',
    'icon' => 'fas fa-fw fa-cubes',
    'active' => '/dropdowns/*' // same as menu's active url pattern
    ], function ($dropdown) {
        $dropdown->heading('Heading:'); // add heading inside dropdown
        $dropdown->menu(['title' => 'Sub Menu 1', 'url' => url('dropdowns/1')]);
        $dropdown->menu(['title' => 'Sub Menu 2', 'url' => url('dropdowns/2')]);
        $dropdown->menu(['title' => 'Sub Menu 3', 'url' => url('dropdowns/3')]);
        $dropdown->menu(['title' => 'Sub Menu 4', 'url' => url('dropdowns/4')]);
    }
)
```
