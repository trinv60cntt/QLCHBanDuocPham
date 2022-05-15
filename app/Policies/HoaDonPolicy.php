<?php

namespace App\Policies;

use App\Models\HoaDon;
use App\Models\NhanVien;
use Illuminate\Auth\Access\HandlesAuthorization;

class HoaDonPolicy
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
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(NhanVien $user)
    {
        return $user->checkQuyenAccess('hoadon_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(NhanVien $user)
    {
        return $user->checkQuyenAccess('hoadon_add');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(NhanVien $user)
    {
        return $user->checkQuyenAccess('hoadon_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(NhanVien $user)
    {
        return $user->checkQuyenAccess('hoadon_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\HoaDon  $hoaDon
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
     * @param  \App\Models\HoaDon  $hoaDon
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(NhanVien $user)
    {
        //
    }
}
