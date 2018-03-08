<?php
/**
 * Item
 */

Breadcrumbs::register('admin.client.transaction.create', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push('Create Transaction', route('admin.client.transaction.create', $client));
});