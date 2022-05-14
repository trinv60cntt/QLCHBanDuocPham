<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class QuyenGateAndPolicyAccess {

  public function setGateAndPolicyAccess() {
    $this->defineGateDanhMuc();
  }

  public function defineGateDanhMuc() {
    Gate::define('danhmuc-index', 'App\Policies\DanhMucPolicy@view');
    Gate::define('danhmuc-add', 'App\Policies\DanhMucPolicy@create');
    Gate::define('danhmuc-edit', 'App\Policies\DanhMucPolicy@update');
    Gate::define('danhmuc-delete', 'App\Policies\DanhMucPolicy@delete');
  }

}