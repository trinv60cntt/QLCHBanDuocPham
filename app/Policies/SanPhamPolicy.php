<?php

namespace App\Policies;

use App\Models\NhanVien;
use App\Models\SanPham;
use Illuminate\Auth\Access\HandlesAuthorization;

class SanPhamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(NhanVien $nhanVien)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(NhanVien $user)
    {
        return $user->checkQuyenAccess('sanpham_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(NhanVien $user)
    {
        return $user->checkQuyenAccess('sanpham_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(NhanVien $user)
    {
        return $user->checkQuyenAccess('sanpham_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(NhanVien $user)
    {
        return $user->checkQuyenAccess('sanpham_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(NhanVien $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\SanPham  $sanPham
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(NhanVien $user)
    {
        //
    }
}
