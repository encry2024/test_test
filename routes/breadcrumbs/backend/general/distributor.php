<?php
/**
 * Supplier
 */
Breadcrumbs::register('admin.distributor.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.distributors.management'), route('admin.distributor.index'));
});

Breadcrumbs::register('admin.distributor.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.distributor.index');
    $breadcrumbs->push(__('labels.backend.distributors.create'), route('admin.distributor.create'));
});

Breadcrumbs::register('admin.distributor.show', function ($breadcrumbs, $distributor) {
    $breadcrumbs->parent('admin.distributor.index');
    $breadcrumbs->push(__('labels.backend.distributors.show', ['distributor' => $distributor->name]), route('admin.distributor.show', $distributor));
});

Breadcrumbs::register('admin.distributor.edit', function ($breadcrumbs, $distributor) {
    $breadcrumbs->parent('admin.distributor.index');
    $breadcrumbs->push(__('labels.backend.distributors.edit', ['distributor' => $distributor->name]), route('admin.distributor.edit', $distributor));
});

Breadcrumbs::register('admin.distributor.cart', function ($breadcrumbs, $distributor) {
    $breadcrumbs->parent('admin.distributor.index');
    $breadcrumbs->push(__('labels.backend.distributors.cart', ['distributor' => $distributor->name]), route('admin.distributor.cart', $distributor));
});

Breadcrumbs::register('admin.distributor.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.distributor.index');
    $breadcrumbs->push(__('labels.backend.distributors.deleted'), route('admin.distributor.deleted'));
});