<?php

namespace UbertechZa\FilamentTreeEnhanced\Concern;

use UbertechZa\FilamentTreeEnhanced\Components\Tree;
use UbertechZa\FilamentTreeEnhanced\Contract\HasTree;

trait BelongsToTree
{
    protected ?Tree $tree = null;

    public function tree(Tree $tree): static
    {
        $this->tree = $tree;

        return $this;
    }

    public function getTree(): ?Tree
    {
        return $this->tree;
    }

    public function getLivewire(): ?HasTree
    {
        return $this->tree?->getLivewire();
    }
}
