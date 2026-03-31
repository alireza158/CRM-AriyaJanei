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
        $this->authorizeManage();

        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $this->authorizeManage();

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


    public function edit(Announcement $announcement)
    {
        $this->authorizeManage();

        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeManage();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $announcement->update([
            'title' => $data['title'],
            'message' => $data['message'],
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return redirect()->route('announcements.index')->with('success', 'اطلاعیه با موفقیت ویرایش شد.');
    }

    public function toggleActive(Announcement $announcement)
    {
        $this->authorizeManage();

        $announcement->update([
            'is_active' => !$announcement->is_active,
        ]);

        $message = $announcement->is_active ? 'اطلاعیه فعال شد.' : 'اطلاعیه غیرفعال شد.';

        return redirect()->route('announcements.index')->with('success', $message);
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorizeManage();

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'اطلاعیه حذف شد.');
    }

    private function authorizeManage(): void
    {
        $user = auth()->user();

        abort_unless(
            $user && $user->hasAnyRole(['Admin', 'internalManager', 'InternalManager']),
            403
        );
    }
}
