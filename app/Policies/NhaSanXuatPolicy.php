<?php

namespace App\Policies;

use App\Models\NhaSanXuat;
use App\Models\NhanVien;
use Illuminate\Auth\Access\HandlesAuthorization;

class NhaSanXuatPolicy
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
     * @param  \App\Models\NhaSanXuat  $nhaSanXuat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(NhanVien $user)
    {
        return $user->checkQuyenAccess('nhasanxuat_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(NhanVien $user)
    {
        return $user->checkQuyenAccess('nhasanxuat_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\NhaSanXuat  $nhaSanXuat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(NhanVien $user)
    {
        return $user->checkQuyenAccess('nhasanxuat_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\NhaSanXuat  $nhaSanXuat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(NhanVien $user)
    {
        return $user->checkQuyenAccess('nhasanxuat_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\NhaSanXuat  $nhaSanXuat
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
     * @param  \App\Models\NhaSanXuat  $nhaSanXuat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(NhanVien $user)
    {
        //
    }
}
