<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KnowledgeController extends Controller
{
    public function index()
    {
        $articles = KnowledgeArticle::orderBy('sort_order')->get();
        return view('admin.knowledge.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.knowledge.form', ['article' => null]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $data = $request->only('title','short_desc','full_desc','sort_order');
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('public/knowledge'));
        }
        KnowledgeArticle::create($data);
        return redirect()->route('admin.knowledge.index')->with('success', 'Thêm bài kiến thức thành công!');
    }

    public function edit(KnowledgeArticle $knowledge)
    {
        return view('admin.knowledge.form', ['article' => $knowledge]);
    }

    public function update(Request $request, KnowledgeArticle $knowledge)
    {
        $request->validate(['title' => 'required']);
        $data = $request->only('title','short_desc','full_desc','sort_order');
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('public/knowledge'));
        }
        $knowledge->update($data);
        return redirect()->route('admin.knowledge.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(KnowledgeArticle $knowledge)
    {
        $knowledge->delete();
        return redirect()->route('admin.knowledge.index')->with('success', 'Đã xóa bài viết!');
    }
}
