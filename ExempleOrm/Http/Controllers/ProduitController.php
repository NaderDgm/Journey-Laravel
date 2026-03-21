<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(){
        $produit=Produit::all();
        $totalprix=Produit::sum(\DB::raw('prix * quantite_stock'));
        return view('produits.index',compact('produit','totalprix'));
    }
    public function store(Request $request){
        Produit::create($request->all());
        return back()->with('succes','produits Ajoute');
    }
    public function destroy(string $id){
        $produit=Produit::findOrfail($id);
        $produit->delete();
        return redirect()->route('Prods.index')->with('succes','produit supprime avec succes');
    }
}
