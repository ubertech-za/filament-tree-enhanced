<?php

namespace UbertechZa\FilamentTreeEnhanced\Concern\Actions;

use UbertechZa\FilamentTreeEnhanced\Components\Tree;

interface HasTree
{
    public function tree(Tree $tree): static;
}
