<?php

namespace App\Policies;

use App\Models\BinhLuan;
use App\Models\NhanVien;
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
    public function viewAny(NhanVien $nhanVien)
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
    public function view(NhanVien $user)
    {
        return $user->checkQuyenAccess('binhluan_list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(NhanVien $nhanVien)
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
    public function update(NhanVien $nhanVien, BinhLuan $binhLuan)
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
    public function delete(NhanVien $nhanVien, BinhLuan $binhLuan)
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
    public function restore(NhanVien $nhanVien, BinhLuan $binhLuan)
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
    public function forceDelete(NhanVien $nhanVien, BinhLuan $binhLuan)
    {
        //
    }
}
