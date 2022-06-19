<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VaiTro;
use Illuminate\Auth\Access\HandlesAuthorization;

class VaiTroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $nhanVien)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkQuyenAccess('nhomnhanvien_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkQuyenAccess('nhomnhanvien_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkQuyenAccess('nhomnhanvien_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkQuyenAccess('nhomnhanvien_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\VaiTro  $vaiTro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}