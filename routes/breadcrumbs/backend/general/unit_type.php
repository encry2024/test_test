<?php
/**
 * Item
 */
Breadcrumbs::register('admin.inventory.unit_type.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.unit_types.management'), route('admin.inventory.unit_type.index'));
});

Breadcrumbs::register('admin.inventory.unit_type.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.create'), route('admin.inventory.unit_type.create'));
});

Breadcrumbs::register('admin.inventory.unit_type.edit', function ($breadcrumbs, $unit_tye) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.unit_types.edit', ['unit_type' => $unit_type->name]), route('admin.inventory.unit_type.edit', $unit_tye));
});

Breadcrumbs::register('admin.inventory.unit_type.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.deleted'), route('admin.inventory.unit_type.deleted'));
});