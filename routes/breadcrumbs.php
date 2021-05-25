<?php

use Tabuna\Breadcrumbs\Trail;

//Account
Breadcrumbs::for('account.profile', function (Trail $trail) {
    $trail->push(__('Profile'), route('account.profile'));
});
Breadcrumbs::for('account.change_password', function (Trail $trail) {
    $trail->push(__('Change Password'), route('account.change_password'));
});

//Role
Breadcrumbs::for('access_management.roles.index', function (Trail $trail) {
    $trail->push(__('Role'), route('access_management.roles.index'));
});
Breadcrumbs::for('access_management.roles.show', function (Trail $trail, $role) {
    $trail->parent('access_management.roles.index')->push(__('Role Detail'), route('access_management.roles.show', compact('role')));
});
Breadcrumbs::for('access_management.roles.create', function (Trail $trail) {
    $trail->parent('access_management.roles.index')->push(__('Create Role'), route('access_management.roles.create'));
});
Breadcrumbs::for('access_management.roles.edit', function (Trail $trail, $role) {
    $trail->parent('access_management.roles.index')->push(__('Edit Role'), route('access_management.roles.edit', compact('role')));
});

//User
Breadcrumbs::for('access_management.users.index', function (Trail $trail) {
    $trail->push(__('User'), route('access_management.users.index'));
});
Breadcrumbs::for('access_management.users.show', function (Trail $trail, $user) {
    $trail->parent('access_management.users.index')->push(__('User Detail'), route('access_management.users.show', compact('user')));
});
Breadcrumbs::for('access_management.users.create', function (Trail $trail) {
    $trail->parent('access_management.users.index')->push(__('Create User'), route('access_management.users.create'));
});
Breadcrumbs::for('access_management.users.edit', function (Trail $trail, $user) {
    $trail->parent('access_management.users.index')->push(__('Edit User'), route('access_management.users.edit', compact('user')));
});
Breadcrumbs::for('access_management.users.change_password', function (Trail $trail, $user) {
    $trail->parent('access_management.users.index')->push(__('Change User Password'), route('access_management.users.change_password', compact('user')));
});
Breadcrumbs::for('access_management.users.deleted.index', function (Trail $trail) {
    $trail->parent('access_management.users.index')->push(__('Deleted User'), route('access_management.users.deleted.index'));
});
