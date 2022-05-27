<?php

namespace App\Policies;

use App\Models\NhanVien;
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
    public function viewAny(NhanVien $nhanVien)
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
    public function view(NhanVien $nhanVien, ThongKe $thongKe)
    {
        //
    }

    public function theoSanPham(NhanVien $user)
    {
        return $user->checkQuyenAccess('tktheosanpham_index');
    }

    
    public function theoHinhThucKD(NhanVien $user)
    {
        return $user->checkQuyenAccess('tktheohinhthuckinhdoanh_index');
    }

    public function doanhThu(NhanVien $user)
    {
        return $user->checkQuyenAccess('tktongdoanhthu_index');
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
     * @param  \App\Models\ThongKe  $thongKe
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(NhanVien $nhanVien, ThongKe $thongKe)
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
    public function delete(NhanVien $nhanVien, ThongKe $thongKe)
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
    public function restore(NhanVien $nhanVien, ThongKe $thongKe)
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
    public function forceDelete(NhanVien $nhanVien, ThongKe $thongKe)
    {
        //
    }
}
