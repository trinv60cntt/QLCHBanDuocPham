<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ThongKe;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThongKePolicy
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
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $nhanVien, ThongKe $thongKe)
    {
        //
    }

    public function theoSanPham(User $user)
    {
        return $user->checkQuyenAccess('tktheosanpham_index');
    }

    
    public function theoHinhThucKD(User $user)
    {
        return $user->checkQuyenAccess('tktheohinhthuckinhdoanh_index');
    }

    public function doanhThu(User $user)
    {
        return $user->checkQuyenAccess('tktongdoanhthu_index');
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
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $nhanVien, ThongKe $thongKe)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $nhanVien, ThongKe $thongKe)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $nhanVien, ThongKe $thongKe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\NhanVien  $nhanVien
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $nhanVien, ThongKe $thongKe)
    {
        //
    }
}
