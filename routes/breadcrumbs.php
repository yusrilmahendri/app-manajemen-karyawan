<?php 
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

# ADMIN 
  Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

  Breadcrumbs::for('admin.order.create', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
    $trail->push('Daftarkan Order', route('admin.order.create'));
});

Breadcrumbs::for('admin.orders', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Riwayat Order', route('admin.orders'));
});

Breadcrumbs::for('admin.order.edit', function ($trail, $order) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Riwayat Order', route('admin.orders'));
  $trail->push('Detail Informasi Order', route('admin.order.edit', $order));
});


# USER
 Breadcrumbs::for('user.dashboard', function ($trail) {
  $trail->push('Dashboard', route('user.dashboard'));
});

Breadcrumbs::for('user.todo', function ($trail) {
  $trail->push('Dashboard', route('user.dashboard'));
  $trail->push('List Pekerjaan Saya', route('user.todo'));
});

Breadcrumbs::for('user.todo.show', function ($trail, $order) {
  $trail->push('Dashboard', route('user.dashboard'));
  $trail->push('List Pekerjaan Saya', route('user.todo'));
  $trail->push('Detail list pekerjaan saya', route('user.todo.show',  $order ));
});

Breadcrumbs::for('user.settings', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
  $trail->push('Informasi Tentang Saya', route('user.settings'));
});



# ROUTE OWNER
Breadcrumbs::for('owner.dashboard', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
});

Breadcrumbs::for('owner.setting.admin', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Dashboard', route('owner.setting.admin'));
});

Breadcrumbs::for('owner.information.admin', function($trail, $admin){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Dashboard', route('owner.setting.admin'));
  $trail->push('Detail Data Pengguna', route('owner.information.admin', $admin));
});

Breadcrumbs::for('owner.admin.edit', function($trail, $admin){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Dashboard', route('owner.setting.admin'));
  $trail->push('Detail Data Pengguna', route('owner.admin.edit', $admin));
});

Breadcrumbs::for('owner.users', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Data Pengguna', route('owner.users'));
});

Breadcrumbs::for('owner.user', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Data Pengguna', route('owner.users'));
  $trail->push('Daftarkan Pengguna', route('owner.user'));
});

Breadcrumbs::for('owner.user.show', function($trail, $user){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Data Pengguna', route('owner.users'));
  $trail->push('Detail Data Pengguna', route('owner.user.show', $user));
});

Breadcrumbs::for('owner.user.edit', function($trail, $user){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Data Pengguna', route('owner.users'));
  $trail->push('Ubah Data Pengguna', route('owner.user.edit', $user));
});

Breadcrumbs::for('owner.setting', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Data Saya', route('owner.setting'));
});

Breadcrumbs::for('owner.record', function($trail){
  $trail->push('Dashboard', route('owner.dashboard'));
  $trail->push('Informasi Data Record', route('owner.record'));
});
