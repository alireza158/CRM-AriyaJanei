<?php
namespace App\Http\Controllers;

use App\Models\RequestTicket;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest; // جلوگیری از تداخل نام

class RequestTicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $tickets = RequestTicket::latest()->paginate(15);
        } elseif ($user->hasRole('Manager')) {
            $tickets = RequestTicket::where('manager_id', $user->id)
                        ->latest()->paginate(15);
        } elseif ($user->hasAnyRole(['internalManager','InternalManager'])) {
            $tickets = RequestTicket::where('status', 'manager_approved')
                        ->latest()->paginate(15);
        } else { // User عادی
            $tickets = RequestTicket::where('user_id', $user->id)
                        ->latest()->paginate(15);
        }

        return view('requests.index', compact('tickets'));
    }

    public function create()
    {
        $user = Auth::user();
        $users = [];
        if ($user->hasRole('Admin') || $user->hasRole('Manager')) {
            $users = User::orderBy('name')->get();
        }
        return view('requests.create', compact('users'));
    }

    public function store(HttpRequest $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id'     => 'nullable|exists:users,id',
        ]);

        $actor = Auth::user();
        $ownerId = ($actor->hasRole('Admin') || $actor->hasRole('Manager')) && !empty($data['user_id'])
            ? (int) $data['user_id']
            : $actor->id;

        $owner = User::findOrFail($ownerId);

        $ticket = RequestTicket::create([
            'user_id'  => $ownerId,
            'title'    => $data['title'],
            'description' => $data['description'] ?? null,
            'status'   => 'pending',
            'manager_id' => $owner->manager_id, // فرض بر وجود ستون manager_id در users
        ]);

        // اگر خود ثبت‌کننده مدیر واحد باشد، مرحله اول را خودکار تایید می‌کنیم
        if ($actor->hasRole('Manager') && $ticket->manager_id == $actor->id) {
            $ticket->update([
                'status'     => 'manager_approved',
                'manager_id' => $actor->id,
            ]);
        }

        // ساخت اعلان برای مدیران و ادمین‌ها
        $allIds = User::role(['Admin','Manager','InternalManager'])->pluck('id')->unique()->values()->toArray();
        foreach ($allIds as $id) {
            Notification::create([
                'user_id' => $id,
                'title'   => 'درخواست جدید',
                'message' => "یک درخواست جدید با عنوان '{$ticket->title}' ثبت شد.",
                'seen'    => false,
            ]);
        }

        return redirect()->route('requests.index')->with('success','درخواست ثبت شد.');
    }

    public function edit(RequestTicket $requestTicket)
    {
        $this->authorize('update', $requestTicket);
        return view('requests.edit', ['ticket' => $requestTicket]);
    }

    public function update(HttpRequest $request, RequestTicket $requestTicket)
    {
        $this->authorize('update', $requestTicket);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $requestTicket->update($data);
        return redirect()->route('requests.index')->with('success','درخواست به‌روزرسانی شد.');
    }

    public function destroy(int $ticket)
    {
        $model = RequestTicket::findOrFail($ticket);
        $this->authorize('delete', $model);

        try {
            // $model->delete(); // اگر SoftDeletes فعال است
            $model->forceDelete();
            return redirect()->route('requests.index')->with('success','درخواست حذف شد.');
        } catch (\Throwable $e) {
            return back()->with('error','حذف با خطا مواجه شد.');
        }
    }

    public function approve(RequestTicket $requestTicket)
    {
        $user = Auth::user();

        if ($user->hasRole('Manager') && $requestTicket->status === 'pending' && $requestTicket->manager_id == $user->id) {
            $requestTicket->update(['status' => 'manager_approved', 'manager_id' => $user->id]);
        } elseif (($user->hasRole('Admin') || $user->hasAnyRole(['internalManager','InternalManager'])) && $requestTicket->status === 'manager_approved') {
            $requestTicket->update(['status' => 'final_approved', 'super_manager_id' => $user->id]);
        } else {
            abort(403, 'شما مجوز تایید این درخواست را ندارید.');
        }

        return back()->with('success','درخواست تایید شد.');
    }

    public function reject(RequestTicket $requestTicket)
    {
        $user = Auth::user();

        if ($user->hasRole('Manager') && $requestTicket->status === 'pending') {
            $requestTicket->update(['status' => 'manager_rejected', 'manager_id' => $user->id]);
        } elseif (($user->hasRole('Admin') || $user->hasAnyRole(['internalManager','InternalManager'])) && $requestTicket->status === 'manager_approved') {
            $requestTicket->update(['status' => 'internal_rejected', 'super_manager_id' => $user->id]);
        } else {
            abort(403, 'شما مجوز رد این درخواست را ندارید.');
        }

        return back()->with('error','درخواست رد شد.');
    }

    public function show(RequestTicket $requestTicket)
{
 
    return view('requests.show', ['ticket' => $requestTicket]);
}

public function printView(RequestTicket $requestTicket)
{
    $this->authorize('view', $requestTicket);
    return view('requests.print', ['ticket' => $requestTicket]);
}
}