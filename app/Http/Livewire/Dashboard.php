<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tautan;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $recentTautans;
    public $statistics;
    public $totalTautans;
    public $activeTautans;
    public $totalLinks;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $userId = Auth::id();

        // Get recent tautans
        $this->recentTautans = Tautan::byUser($userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Calculate links count for each tautan
        $this->recentTautans = $this->recentTautans->map(function ($tautan) {
            $tautan->links_count = is_array($tautan->links) ? count($tautan->links) : 0;
            return $tautan;
        });

        // Calculate statistics
        $this->totalTautans = Tautan::byUser($userId)->count();
        $this->activeTautans = Tautan::byUser($userId)->where('is_active', true)->count();
        $this->totalLinks = Tautan::byUser($userId)->get()->sum(function ($tautan) {
            return is_array($tautan->links) ? count($tautan->links) : 0;
        });

        $this->statistics = [
            'total' => $this->totalTautans,
            'active' => $this->activeTautans,
            'inactive' => $this->totalTautans - $this->activeTautans,
            'total_links' => $this->totalLinks,
            'avg_links' => $this->totalTautans > 0 ? round($this->totalLinks / $this->totalTautans, 1) : 0,
            'this_month' => Tautan::byUser($userId)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'uploaded_images' => Tautan::byUser($userId)->where('use_uploaded_logo', true)->count(),
            'this_week' => Tautan::byUser($userId)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'recentTautans' => $this->recentTautans,
            'statistics' => $this->statistics,
        ]);
    }
}
