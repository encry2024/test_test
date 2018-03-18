<?php
/**
 * Item
 */

Breadcrumbs::register('admin.transactions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('Transactions', route('admin.transactions.index'));
});

Breadcrumbs::register('admin.client.transaction.create', function ($breadcrumbs, $client) {
    $breadcrumbs->parent('admin.client.index');
    $breadcrumbs->push(__('labels.backend.clients.transact_to', ['client' => $client->name]), route('admin.client.show', $client));
    $breadcrumbs->push('Make a Transaction');
});

Breadcrumbs::register('admin.client.transaction.show', function ($breadcrumbs, $transaction) {
    $breadcrumbs->parent('admin.transactions.index');
    $breadcrumbs->push(("Transaction #$transaction->reference_id"), route('admin.client.transaction.show', $transaction));
});