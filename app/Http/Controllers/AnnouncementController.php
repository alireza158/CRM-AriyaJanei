<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()
            ->with('creator:id,name')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        $this->authorizeCreate();

        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $this->authorizeCreate();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Announcement::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'is_active' => (bool) ($data['is_active'] ?? true),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'اطلاعیه با موفقیت ثبت شد.');
    }

    private function authorizeCreate(): void
    {
        $user = auth()->user();

        abort_unless(
            $user && $user->hasAnyRole(['Admin', 'internalManager', 'InternalManager']),
            403
        );
    }
}
