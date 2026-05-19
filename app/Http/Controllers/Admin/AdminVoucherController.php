<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
    public function vouchers()
    {
        $vouchers = Voucher::latest()->paginate(15);
        return view('admin.vouchers', compact('vouchers'));
    }
}
