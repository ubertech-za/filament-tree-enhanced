@php
    $containerKey = 'filament_tree_container_' . $this->getId();
    $maxDepth = $getMaxDepth() ?? 1;
    $records = collect($this->getRootLayerRecords() ?? []);
    $canUpdateOrder = $getCanUpdateOrder();
@endphp

<div class="filament-tree-component"
    wire:disabled="updateTree"
    {{-- x-ignore --}}
    ax-load
    ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-tree-component', 'ubertech-za/filament-tree-enhanced') }}"
    x-data="treeNestableComponent({
        containerKey: {{ $containerKey }},
        maxDepth: {{ $maxDepth }},
        canUpdateOrder: {{ $canUpdateOrder ? 'true' : 'false' }}
    })">
    <x-filament::section :heading="($this->displayTreeTitle() ?? false) ? $this->getTreeTitle() : null">
        <menu class="nestable-menu" id="nestable-menu">
            <div class="btn-group">
                <x-filament::button color="gray" tag="button" data-action="expand-all" x-on:click="expandAll()" wire:loading.attr="disabled" wire:loading.class="cursor-wait opacity-70">
                    {{ __('filament-tree-enhanced::filament-tree.button.expand_all') }}
                </x-filament::button>
                <x-filament::button color="gray" tag="button" data-action="collapse-all" x-on:click="collapseAll()" wire:loading.attr="disabled" wire:loading.class="cursor-wait opacity-70">
                    {{ __('filament-tree-enhanced::filament-tree.button.collapse_all') }}
                </x-filament::button>
            </div>
            @if($canUpdateOrder)
            <div class="btn-group">
                <x-filament::button tag="button" data-action="save" x-on:click="save()" wire:loading.attr="disabled" wire:loading.class="cursor-wait opacity-70">
                    <x-filament::loading-indicator class="h-4 w-4" wire:loading wire:target="updateTree"/>
                    <span wire:loading.remove wire:target="updateTree">
                        {{ __('filament-tree-enhanced::filament-tree.button.save') }}
                    </span>

                </x-filament::button>
            </div>
            @endif
        </menu>
        <div class="filament-tree dd" id="{{ $containerKey }}" x-ref="treeContainer">
            <x-filament-tree-enhanced::tree.list :records="$records" :containerKey="$containerKey" :tree="$tree"/>
        </div>
    </x-filament::section>
</div>
