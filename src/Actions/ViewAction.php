<?php

namespace UbertechZa\FilamentTreeEnhanced\Actions;

use Closure;
use Illuminate\Database\Eloquent\Model;
use UbertechZa\FilamentTreeEnhanced\Components\Tree;

class ViewAction extends Action
{
    protected ?Closure $mutateRecordDataUsing = null;

    public static function getDefaultName(): ?string
    {
        return 'view';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-actions::view.single.label'));

        $this->modalHeading(fn (): string => __('filament-actions::view.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalSubmitAction(false);
        $this->modalCancelAction(fn (\Filament\Actions\Action $action) => $action->label(__('filament-actions::view.single.modal.actions.close.label')));

        $this->color('gray');

        $this->icon('heroicon-m-eye');

        $this->disabledForm();

        $this->fillForm(function (Model $record, Tree $tree): array {
            // Execute before hook for data preparation
            $hookData = $this->callBeforeActionHook($record, []);

            // Apply record mutations
            $record = $this->getMutatedRecord($record);

            if ($translatableContentDriver = $tree->makeFilamentTranslatableContentDriver()) {
                $data = $translatableContentDriver->getRecordAttributesToArray($record);
            } else {
                $data = $record->attributesToArray();
            }

            if ($this->mutateRecordDataUsing) {
                $data = $this->evaluate($this->mutateRecordDataUsing, ['data' => $data, 'record' => $record]);
            }

            // Apply form data mutations
            $data = $this->getMutatedFormData($data);

            return $data;
        });

        $this->action(static function (): void {});
    }

    public function mutateRecordDataUsing(?Closure $callback): static
    {
        $this->mutateRecordDataUsing = $callback;

        return $this;
    }
}
