<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }
    public function destroy($id)
{
    $event = Event::find($id);

    if ($event) {
        $event->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

}
