<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Siteinfo;
use App\Models\Company;
use Str;
use Session;
use PDF;

class ReportController extends Controller
{
    public function report() {

        $products = Product::get();
        $brands = Brand::where('status', 1)->get();
        $subcategories = SubCategory::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();

        return view('admin.report.index', compact('products', 'brands', 'subcategories', 'categories', 'companies'));
    }
}
