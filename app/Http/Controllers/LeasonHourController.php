<?php

namespace App\Http\Controllers;

use App\Models\LeasonHour;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\RoomClass;
use Illuminate\Http\Request;

class LeasonHourController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        $classes  = RoomClass::all();

        return view('admin.pages.schedule.index', compact('teachers', 'subjects', 'classes'));
    }

    public function events(Request $request)
    {
        $query = LeasonHour::with(['teacher.user', 'subject', 'classes']);

        if ($request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $events = $query->get()->map(function ($lh) {
            return [
                'id'    => $lh->id,
                'title' => $lh->title,
                'extendedProps' => [
                    'teacher'     => $lh->teacher->user->name ?? '-',
                    'subject'     => $lh->subject->name ?? '-',
                    'class'       => $lh->classes->name ?? '-',
                    'color'       => $lh->color,
                    'day'         => $lh->day,
                    'lesson_hour' => $lh->lesson_hour,
                    'room'        => $lh->room,
                    'colorHex'    => $lh->color_hex,
                ],
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id'  => 'required',
            'subject_id'  => 'nullable',
            'class_id'    => 'nullable',
            'title'       => 'required|string|max:255',
            'color'       => 'required|in:Danger,Success,Primary,Warning',
            'day'         => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'lesson_hour' => 'required|integer|min:1|max:12',
            'room'        => 'nullable|string|max:50',
        ]);

        // Map class_id ke room_class_id
        if (isset($validated['class_id'])) {
            $validated['room_class_id'] = $validated['class_id'];
            unset($validated['class_id']);
        }

         // Set start_date & end_date default null
        $validated['start_date'] = null;
        $validated['end_date']   = null;

        $lh = LeasonHour::create($validated);

        return response()->json(['success' => true, 'message' => 'Jadwal berhasil ditambahkan!', 'data' => $lh]);
    }

    public function update(Request $request, string $id)
    {
        $lh = LeasonHour::findOrFail($id);

        $validated = $request->validate([
            'teacher_id'  => 'sometimes',
            'subject_id'  => 'nullable',
            'class_id'    => 'nullable',
            'title'       => 'sometimes|required|string|max:255',
            'color'       => 'sometimes|in:Danger,Success,Primary,Warning',
            'day'         => 'sometimes|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'lesson_hour' => 'sometimes|integer|min:1|max:12',
            'room'        => 'nullable|string|max:50',
        ]);

        if (isset($validated['class_id'])) {
            $validated['room_class_id'] = $validated['class_id'];
            unset($validated['class_id']);
        }

        $lh->update($validated);

        return response()->json(['success' => true, 'message' => 'Jadwal berhasil diupdate!', 'data' => $lh]);
    }

    public function destroy(string $id)
    {
        LeasonHour::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Jadwal berhasil dihapus!']);
    }
}