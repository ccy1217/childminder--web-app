<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Carbon\Carbon;

class ChildminderTimetable extends Component
{
    public $childminderId;
    public $currentMonth;
    public $currentYear;
    public $daysInMonth;
    public $firstDayOfMonth;
    public $bookingsByDate = [];

    public function mount($childminderId)
    {
        $this->childminderId = $childminderId;
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $startDate = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endDate = $startDate->copy()->endOfMonth();
        
        $this->daysInMonth = $startDate->daysInMonth;
        $this->firstDayOfMonth = $startDate->startOfMonth()->format('N'); // 1 (Monday) to 7 (Sunday)

        $bookings = Booking::where('childminder_id', $this->childminderId)
            ->whereBetween('start_time', [$startDate, $endDate])
            ->where('status', 'Confirmed')
            ->orderBy('start_time')
            ->get();

        $this->bookingsByDate = [];

        foreach ($bookings as $booking) {
            $date = Carbon::parse($booking->start_time)->format('Y-m-d');
            $this->bookingsByDate[$date][] = [
                'start_time' => Carbon::parse($booking->start_time)->format('H:i'),
                'end_time' => Carbon::parse($booking->end_time)->format('H:i'),
                'client' => $booking->client ? $booking->client->name : 'Unknown'
            ];
        }
    }

    public function previousMonth()
    {
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
        $this->loadBookings();
    }

    public function nextMonth()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        $this->loadBookings();
    }

    public function render()
    {
        return view('livewire.childminder-timetable');
    }
}
