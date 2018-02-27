<?php
/**
 * Item
 */
Breadcrumbs::register('admin.inventory.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.inventories.management'), route('admin.inventory.index'));
});

Breadcrumbs::register('admin.inventory.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.create'), route('admin.inventory.create'));
});

Breadcrumbs::register('admin.inventory.show', function ($breadcrumbs, $inventory) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.show', ['inventory' => $inventory->name]), route('admin.inventory.show', $inventory));
});

Breadcrumbs::register('admin.inventory.edit', function ($breadcrumbs, $inventory) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.edit', ['inventory' => $inventory->name]), route('admin.inventory.edit', $inventory));
});

Breadcrumbs::register('admin.inventory.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.inventory.index');
    $breadcrumbs->push(__('labels.backend.inventories.deleted'), route('admin.inventory.deleted'));
});