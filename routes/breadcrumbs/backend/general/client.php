<?php
/**
 * Item
 */
Breadcrumbs::register('admin.client.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('labels.backend.clients.management'), route('admin.client.index'));
});

Breadcrumbs::register('admin.client.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.create'), route('admin.client.create'));
});

Breadcrumbs::register('admin.client.show', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.show', ['client' => $client->name]), route('admin.client.show', $client));
});

Breadcrumbs::register('admin.client.order', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.order', ['client' => $client->name]), route('admin.client.order', $client));
});

Breadcrumbs::register('admin.client.edit', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.edit', ['client' => $client->name]), route('admin.client.edit', $client));
});

Breadcrumbs::register('admin.client.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.deleted'), route('admin.client.deleted'));
});