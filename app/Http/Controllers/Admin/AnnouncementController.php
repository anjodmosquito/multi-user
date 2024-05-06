<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Retrieve all medicines using the Medicine model
        $announcements = Announcement::all();

        // Pass the retrieved data to the view using Inertia
        return Inertia::render('Admin/Announcements/Index', [
            'announcements' => $announcements
        ]);
    }
}
