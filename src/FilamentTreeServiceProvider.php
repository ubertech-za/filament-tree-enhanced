<?php

namespace UbertechZa\FilamentTreeEnhanced;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Schema\Blueprint;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use UbertechZa\FilamentTreeEnhanced\Commands\MakeTreePageCommand;
use UbertechZa\FilamentTreeEnhanced\Commands\MakeTreeResourceCommand;
use UbertechZa\FilamentTreeEnhanced\Commands\MakeTreeWidgetCommand;
use UbertechZa\FilamentTreeEnhanced\Macros\BlueprintMarcos;

class FilamentTreeServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-tree-enhanced';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasTranslations()
            ->hasCommands([
                MakeTreePageCommand::class,
                MakeTreeResourceCommand::class,
                MakeTreeWidgetCommand::class,
            ]);
    }

    public function boot()
    {
        parent::boot();

        $this->registerBlueprintMacros();
        $this->registerPublishableStubs();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('filament-tree-min', __DIR__.'/../resources/dist/filament-tree.css'),
            AlpineComponent::make('filament-tree-component', __DIR__.'/../resources/dist/components/filament-tree-component.js')->loadedOnRequest(),
            Js::make('filament-tree', __DIR__.'/../resources/dist/filament-tree.js'),
        ], 'ubertech-za/filament-tree-enhanced');
    }

    protected function registerBlueprintMacros()
    {
        Blueprint::mixin(new BlueprintMarcos);
    }

    protected function registerPublishableStubs(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/filament-tree' => base_path('stubs/filament-tree'),
            ], 'filament-tree-enhanced-stubs');
        }
    }
}
