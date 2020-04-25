<?php

namespace App\Http\Controllers\Rev\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Rev\Backend\ShoppingCartsDataTable;
use App\Models\Rev\rev_shoppingcarts;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShoppingCartsDataTable $dataTable)
    {
        return $dataTable->render('rev.backend.shoppingcart.index');
    }
	
    public function destroy($id)
    {
        rev_shoppingcarts::find($id)->delete();
    }
}
