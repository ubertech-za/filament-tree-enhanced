<?php

namespace UbertechZa\FilamentTreeEnhanced\Widgets;

use Filament\Support\Contracts\TranslatableContentDriver;
use Illuminate\Database\Eloquent\Model;
use UbertechZa\FilamentTreeEnhanced\Actions\Action;
use UbertechZa\FilamentTreeEnhanced\Actions\DeleteAction;
use UbertechZa\FilamentTreeEnhanced\Actions\EditAction;
use UbertechZa\FilamentTreeEnhanced\Actions\ViewAction;
use UbertechZa\FilamentTreeEnhanced\Components\Tree as TreeComponent;
use UbertechZa\FilamentTreeEnhanced\Concern\InteractWithTree;
use UbertechZa\FilamentTreeEnhanced\Contract\HasTree;

class Tree extends BaseWidget implements HasTree
{
    use InteractWithTree;

    protected string $view = 'filament-tree-enhanced::widgets.tree';

    protected int|string|array $columnSpan = 'full';

    protected static string $model;

    protected static int $maxDepth = 2;

    public static function getMaxDepth(): int
    {
        return static::$maxDepth;
    }

    public static function tree(TreeComponent $tree): TreeComponent
    {
        return $tree;
    }

    public function getModel(): string
    {
        return static::$model ?? class_basename(static::class);
    }

    protected function getFormModel(): Model|string|null
    {
        return $this->getModel();
    }

    protected function getFormSchema(): array
    {
        return [];
    }

    protected function getViewFormSchema(): array
    {
        return [];
    }

    protected function getEditFormSchema(): array
    {
        return [];
    }

    protected function getTreeActions(): array
    {
        return array_merge(
            ($this->hasEditAction() ? [$this->getEditAction()] : []),
            ($this->hasViewAction() ? [$this->getViewAction()] : []),
            ($this->hasDeleteAction() ? [$this->getDeleteAction()] : []),
        );
    }

    protected function configureTreeAction(Action $action): void
    {
        match (true) {
            $action instanceof DeleteAction => $this->configureDeleteAction($action),
            $action instanceof EditAction => $this->configureEditAction($action),
            $action instanceof ViewAction => $this->configureViewAction($action),
            default => null,
        };
    }

    protected function hasDeleteAction(): bool
    {
        return false;
    }

    protected function hasEditAction(): bool
    {
        return false;
    }

    protected function hasViewAction(): bool
    {
        return false;
    }

    protected function getDeleteAction(): DeleteAction
    {
        return DeleteAction::make();
    }

    protected function getEditAction(): EditAction
    {
        return EditAction::make();
    }

    protected function getViewAction(): ViewAction
    {
        return ViewAction::make();
    }

    protected function configureDeleteAction(DeleteAction $action): DeleteAction
    {
        $action->tree($this->getCachedTree());

        $action->iconButton();

        $this->afterConfiguredDeleteAction($action);

        return $action;
    }

    protected function configureEditAction(EditAction $action): EditAction
    {
        $action->tree($this->getCachedTree());

        $action->iconButton();

        $schema = $this->getEditFormSchema();

        if (empty($schema)) {
            $schema = $this->getFormSchema();
        }

        $action->schema($schema);

        $action->model($this->getModel());

        $this->afterConfiguredEditAction($action);

        return $action;
    }

    protected function configureViewAction(ViewAction $action): ViewAction
    {
        $action->tree($this->getCachedTree());

        $action->iconButton();

        $schema = $this->getViewFormSchema();

        if (empty($schema)) {
            $schema = $this->getFormSchema();
        }

        $action->schema($schema);

        // $isInfoList = count(array_filter($schema, fn($component) => $component instanceof Component)) > 0;

        // if ($isInfoList) {
        //     $action->schema($schema);
        // }

        $action->model($this->getModel());

        $this->afterConfiguredViewAction($action);

        return $action;
    }

    protected function afterConfiguredDeleteAction(DeleteAction $action): DeleteAction
    {
        return $action;
    }

    protected function afterConfiguredEditAction(EditAction $action): EditAction
    {
        return $action;
    }

    protected function afterConfiguredViewAction(ViewAction $action): ViewAction
    {
        return $action;
    }

    protected function callHook(string $hook): void
    {
        if (! method_exists($this, $hook)) {
            return;
        }

        $this->{$hook}();
    }

    public function makeTranslatableContentDriver(): ?TranslatableContentDriver
    {
        return null;
    }
}
