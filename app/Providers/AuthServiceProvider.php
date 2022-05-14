<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\SanPham;
use App\services\QuyenGateAndPolicyAccess;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define Quyen
        $quyengateAndPolicy = new QuyenGateAndPolicyAccess();
        $quyengateAndPolicy->setGateAndPolicyAccess();
        
        // $this->defineGateDanhMuc();

        // Gate::define('sanpham-index', function ($user) {
        //     return $user->checkQuyenAccess('sanpham_list');
        // });

        // // for product has foreign key is nhanvien_id
        // Gate::define('sanpham-edit', function ($user, $sanPham_id) {
        //     $product = SanPham::find($sanPham_id);
        //     if($user->checkQuyenAccess('sanpham_edit') && $user->id === $sanPham_id->nhanvien_id) {
        //         return true;
        //     }
        //     else {
        //         return false;
        //     }
        // });
    }
}
