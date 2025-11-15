<?php

namespace App\Http\Controllers;

use App\Models\LearningItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningItemController extends Controller
{
    public function index()
    {
        $learningItems = LearningItem::where('user_id', Auth::id())
            ->orderBy('target_date', 'asc')
            ->orderBy('priority', 'desc')
            ->get();
        
        return view('learning-items.index', compact('learningItems'));
    }

    public function create()
    {
        return view('learning-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'links' => 'nullable|string',
            'target_date' => 'nullable|date',
            'week' => 'nullable|integer',
            'day' => 'nullable|string',
            'time' => 'nullable',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        $links = [];
        if ($request->links) {
            $linksArray = explode("\n", $request->links);
            foreach ($linksArray as $link) {
                $link = trim($link);
                if (!empty($link)) {
                    $links[] = $link;
                }
            }
        }

        $learningItem = LearningItem::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => !empty($validated['description']) ? $validated['description'] : null,
            'links' => !empty($links) ? $links : null,
            'target_date' => !empty($validated['target_date']) ? $validated['target_date'] : null,
            'week' => !empty($validated['week']) ? (int)$validated['week'] : null,
            'day' => !empty($validated['day']) ? $validated['day'] : null,
            'time' => !empty($validated['time']) ? $validated['time'] : null,
            'priority' => $validated['priority'] ?? 'medium',
        ]);

        return redirect()->route('learning-items.index')
            ->with('success', 'Learning item created successfully!');
    }

    public function show(LearningItem $learningItem)
    {
        $this->authorize('view', $learningItem);
        return view('learning-items.show', compact('learningItem'));
    }

    public function edit(LearningItem $learningItem)
    {
        $this->authorize('update', $learningItem);
        return view('learning-items.edit', compact('learningItem'));
    }

    public function update(Request $request, LearningItem $learningItem)
    {
        $this->authorize('update', $learningItem);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'links' => 'nullable|string',
            'target_date' => 'nullable|date',
            'week' => 'nullable|integer',
            'day' => 'nullable|string',
            'time' => 'nullable',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        $links = [];
        if ($request->links) {
            $linksArray = explode("\n", $request->links);
            foreach ($linksArray as $link) {
                $link = trim($link);
                if (!empty($link)) {
                    $links[] = $link;
                }
            }
        }

        $learningItem->update([
            'title' => $validated['title'],
            'description' => !empty($validated['description']) ? $validated['description'] : null,
            'links' => !empty($links) ? $links : null,
            'target_date' => !empty($validated['target_date']) ? $validated['target_date'] : null,
            'week' => !empty($validated['week']) ? (int)$validated['week'] : null,
            'day' => !empty($validated['day']) ? $validated['day'] : null,
            'time' => !empty($validated['time']) ? $validated['time'] : null,
            'priority' => $validated['priority'] ?? 'medium',
        ]);

        return redirect()->route('learning-items.index')
            ->with('success', 'Learning item updated successfully!');
    }

    public function destroy(LearningItem $learningItem)
    {
        $this->authorize('delete', $learningItem);
        $learningItem->delete();
        return redirect()->route('learning-items.index')
            ->with('success', 'Learning item deleted successfully!');
    }

    public function toggleComplete(LearningItem $learningItem)
    {
        $this->authorize('update', $learningItem);
        
        if ($learningItem->is_completed) {
            $learningItem->markAsIncomplete();
            $message = 'Learning item marked as incomplete.';
        } else {
            $learningItem->markAsCompleted();
            $message = 'Learning item marked as completed!';
        }

        return redirect()->back()->with('success', $message);
    }
}

