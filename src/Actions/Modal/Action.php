<?php

namespace UbertechZa\FilamentTreeEnhanced\Actions\Modal;

use UbertechZa\FilamentTreeEnhanced\Concern\Actions\HasTree;
use UbertechZa\FilamentTreeEnhanced\Concern\BelongsToTree;

/**
 * @deprecated Use `\Filament\Actions\StaticAction` instead.
 */
class Action extends \Filament\Actions\Action implements HasTree
{
    use BelongsToTree;
}
