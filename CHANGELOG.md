# Changelog

All notable changes to `filament-tree-enhanced` will be documented in this file.

## 5.0.1 - 2026-05-31

### Fixed

- **Tree node actions no longer crash when the resource has no `view`/`edit` page.**
  `BaseTree` now defaults `$hasViewAction` to `false` (consistent with the tree page trait and
  with resources generated without `--view`), and guards the view/edit node-action URLs behind
  a check that the resource actually registers that page. Previously, rendering a populated tree
  for a resource generated without view pages threw `Route [...view] not defined`.

## 5.0.0 - 2026-05-31

### What's New in 5.0.0

Support for **Filament v5**. The package now supports `filament/filament: ^4.0 || ^5.0`.

#### 🚀 Changes

- **Filament v5 support**: bumped the `filament/filament` constraint to `^4.0 || ^5.0`.
- **Console command compatibility**: the `configure()` methods on the `make:filament-tree-*`
  commands now declare the `: void` return type required by newer Symfony Console / PHP.
- **Generated resource imports fixed**: the tree-resource generator now emits form components
  from `Filament\Forms\Components\*` (TextInput, Textarea, Select, Hidden) instead of the
  non-existent `Filament\Schemas\Components\*`.
- **Generator namespace fixes**: the generator's import list and view/soft-delete imports now
  reference `UbertechZa\FilamentTreeEnhanced\*` (and Filament's built-in
  `Filament\Actions\RestoreAction`) instead of the stale `SolutionForest\FilamentTree\*`.

#### ⚠️ Upgrade notes

- Requires Filament v4 or v5. No API changes to your tree resources/pages/widgets are needed.

## 4.0.0 - 2025-XX-XX

### What's New in 4.0.0

This marks the first independent release of the enhanced Filament Tree package by Uber Technologies cc.

#### 🚀 Major Changes

- **Package Independence**: Now maintained independently as `ubertech-za/filament-tree-enhanced`
- **Namespace Update**: Changed from `SolutionForest\FilamentTree` to `UbertechZa\FilamentTreeEnhanced`
- **Enhanced Features**: Includes all the policy authorization and tree resource enhancements
- **Full Backward Compatibility**: All original features remain fully supported

#### ⚠️ Breaking Changes

- Package name changed to `ubertech-za/filament-tree-enhanced`
- PHP namespace changed to `UbertechZa\FilamentTreeEnhanced`
- Config publishing tag updated to `filament-tree-enhanced-config`

#### 📝 Attribution

This package is built upon the excellent work of Solution Forest. All original features and functionality remain intact, with additional enhancements for policy authorization and dedicated tree resources.

**Full Changelog**: First independent release

---

## Previous Versions (Original Package)

The following versions were released under the original `solution-forest/filament-tree` package:

## 3.0.2 - 2025-08-22

### What's Changed in 3.0.2

#### 🐛 Bug fixes

- fix: update getModel() method signature for Filament v4 compatibility (225c2db)

**Full Changelog**: https://github.com/solutionforest/filament-tree/compare/3.0.1...3.0.2

## 3.0.1 - 2025-08-22

<!-- Release notes generated using configuration in .github/release.yml at 3.x -->
### What's Changed

#### 🐛 Bug fixes

* fix: replace blade component namespace with Filament 4 version by @codelikesuraj in https://github.com/solutionforest/filament-tree/pull/79
* 

#### Other Changes

* Bump aglipanci/laravel-pint-action from 2.5 to 2.6 by @dependabot[bot] in https://github.com/solutionforest/filament-tree/pull/75
* Bump actions/checkout from 4 to 5 by @dependabot[bot] in https://github.com/solutionforest/filament-tree/pull/76

### New Contributors

* @dependabot[bot] made their first contribution in https://github.com/solutionforest/filament-tree/pull/75
* @codelikesuraj made their first contribution in https://github.com/solutionforest/filament-tree/pull/79

**Full Changelog**: https://github.com/solutionforest/filament-tree/compare/3.0.0...3.0.1

## 3.0.0 - 2025-08-13

### Support Filament v4🎉

### Installation

```bash
composer require solution-forest/filament-tree:^3.0.0



```