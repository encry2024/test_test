<?php
/**
 * Item
 */

Breadcrumbs::register('admin.client.transaction.create', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.transact_to', ['client' => $client->name]), route('admin.client.show', $client));
    $breadcrumbs->push('Make a Transaction');
});