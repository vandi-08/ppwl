<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Data blog sementara
        $blogs = [
            [
                'title' => 'Cara Bahagia dalam Hubungan',
                'category' => 'DiUtamakan',
                'excerpt' => 'Hubungan yang bahagia dibangun dari kepercayaan, komunikasi, dan rasa saling menghormati...',
                'image' => asset('images/blog/blog1.png'),
                'url' => route('blog.happy'),
            ],
            [
                'title' => 'Kebiasaan Tidur yang Lebih Baik',
                'category' => 'Goals',
                'excerpt' => 'Tidur berkualitas dapat meningkatkan suasana hati dan produktivitas sehari-hari...',
                'image' => asset('images/blog/blog2.png'),
                'url' => route('blog.sleep'),
            ],
            [
                'title' => 'Panduan Cara Menghentikan Kebiasaan Buruk',
                'category' => 'Goals',
                'excerpt' => 'Mengubah kebiasaan buruk membutuhkan kesadaran diri dan strategi yang tepat...',
                'image' => asset('images/blog/blog3.png'),
                'url' => route('blog.habits'),
            ],
            [
                'title' => 'Waktu Terbaik untuk Memantau Suasana Hati di Siang Hari',
                'category' => 'Tips',
                'excerpt' => 'Mencatat suasana hati di waktu yang tepat membantu memahami pola emosi harianmu...',
                'image' => asset('images/blog/blog4.png'),
                'url' => route('blog.track'),
            ],
            [
                'title' => 'Cara Mulai Memantau Suasana Hati Anda',
                'category' => 'Tips',
                'excerpt' => 'Mulai perjalanan memahami diri sendiri lewat pelacakan mood harian dengan YoMooD...',
                'image' => asset('images/blog/blog5.png'),
                'url' => route('blog.start'),
            ],
        ];

        return view('blog.index', compact('blogs'));
    }

    // ===== Halaman per artikel =====
    public function happyRelationship() { return view('blog.blog1'); }
    public function betterSleep() { return view('blog.blog2'); }
    public function breakHabits() { return view('blog.blog3'); }
    public function trackMood() { return view('blog.blog4'); }
    public function startTracking() { return view('blog.blog5'); }
}
