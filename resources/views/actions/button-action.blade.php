<x-filament-tree-enhanced::actions.action
    :action="$action"
    dynamic-component="filament::button"
    :outlined="$isOutlined()"
    :labeled-from="$getLabeledFromBreakpoint()"
    :icon-position="$getIconPosition()"
    :icon-size="$getIconSize()"
    class="filament-tree-button-action"
>
    {{ $getLabel() }}
</x-filament-tree-enhanced::actions.action>

