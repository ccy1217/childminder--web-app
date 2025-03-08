<div class="p-4 rounded-lg"  style="background-color: #f0f8ff;">
    <!-- Month Navigation -->
    <div class="flex justify-between mb-4">
        <button wire:click="previousMonth" class="px-4 py-2 bg-gray-300 rounded">← Previous</button>
        <h3 class="text-xl font-bold">{{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}</h3>
        <button wire:click="nextMonth" class="px-4 py-2 bg-gray-300 rounded">Next →</button>
    </div>

    <!-- Calendar Grid -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-2 py-2">Mon</th>
                <th class="border border-gray-300 px-2 py-2">Tue</th>
                <th class="border border-gray-300 px-2 py-2">Wed</th>
                <th class="border border-gray-300 px-2 py-2">Thu</th>
                <th class="border border-gray-300 px-2 py-2">Fri</th>
                <th class="border border-gray-300 px-2 py-2">Sat</th>
                <th class="border border-gray-300 px-2 py-2">Sun</th>
            </tr>
        </thead>
        <tbody>
            @php
                $dayCounter = 1;
                $totalDays = $daysInMonth;
                $firstDayOfWeek = $firstDayOfMonth;
                $weeks = ceil(($totalDays + $firstDayOfWeek - 1) / 7);
            @endphp
            
            @for ($week = 0; $week < $weeks; $week++)
                <tr>
                    @for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++)
                        @php
                            $date = \Carbon\Carbon::create($currentYear, $currentMonth, $dayCounter)->format('Y-m-d');
                        @endphp
                        
                        @if (($week === 0 && $dayOfWeek < $firstDayOfWeek) || $dayCounter > $totalDays)
                            <td class="border border-gray-300 p-4 bg-gray-100"></td>
                        @else
                            <td class="border border-gray-300 p-4 align-top" style="background-color: #ffffff;">
                                <div class="font-bold">{{ $dayCounter }}</div>
                                @if(isset($bookingsByDate[$date]))
                                    <ul class="mt-2 text-sm" >
                                        @foreach($bookingsByDate[$date] as $booking)
                                            <li class="bg-blue-100 p-1 rounded mt-2">
                                                {{ $booking['start_time'] }} - {{ $booking['end_time'] }}<br>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @php $dayCounter++; @endphp
                            </td>
                        @endif
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</div>
