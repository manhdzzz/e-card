<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\KnowledgeArticle;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function showKnowledge($slug)
    {
        $article = KnowledgeArticle::where('slug', $slug)->firstOrFail();
        return view('knowledge.show', compact('article'));
    }
}
