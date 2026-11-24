<?php

namespace App\Modules\Event\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Http\Requests\EventRequest;
use App\Modules\Event\Models\Category;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\Speaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->orderByDesc('event_date')->get();

        return view('event::admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('event::admin.events.create', [
            'event' => new Event(),
            'categories' => Category::orderBy('name')->get(),
            'speakers' => Speaker::orderBy('name')->get(),
        ]);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $event = Event::create($request->safe()->except('speaker_ids'));
            $event->speakers()->sync($this->speakerSyncData($request->validated('speaker_ids', [])));
        });

        return redirect()->route('admin.events.index')->with('status', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        return view('event::admin.events.edit', [
            'event' => $event->load('speakers'),
            'categories' => Category::orderBy('name')->get(),
            'speakers' => Speaker::orderBy('name')->get(),
        ]);
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        DB::transaction(function () use ($request, $event) {
            $event->update($request->safe()->except('speaker_ids'));
            $event->speakers()->sync($this->speakerSyncData($request->validated('speaker_ids', [])));
        });

        return redirect()->route('admin.events.index')->with('status', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('status', 'Event berhasil dihapus.');
    }

    private function speakerSyncData(array $speakerIds): array
    {
        return collect($speakerIds)
            ->mapWithKeys(fn($id) => [$id => ['role' => 'Pemateri']])
            ->all();
    }
}
