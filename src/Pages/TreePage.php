<?php

namespace UbertechZa\FilamentTreeEnhanced\Pages;

use Filament\Pages\Page;
use UbertechZa\FilamentTreeEnhanced\Concern\TreePageTrait;
use UbertechZa\FilamentTreeEnhanced\Contract\HasTree;

abstract class TreePage extends Page implements HasTree
{
    use TreePageTrait;

    protected string $view = 'filament-tree-enhanced::pages.tree';
}
