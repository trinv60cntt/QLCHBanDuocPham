<?php

namespace App\Policies;

use App\Models\BinhLuan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BinhLuanPolicy
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
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkQuyenAccess('binhluan_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $nhanVien)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $nhanVien, BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $nhanVien, BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $nhanVien, BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\BinhLuan  $binhLuan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $nhanVien, BinhLuan $binhLuan)
    {
        //
    }
}
