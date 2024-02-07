<div class="details-content details-city">
    <h5 class="title">Cities</h5>
    <table class="table">
        <thead>
            <tr>
                <td>City</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniqueCities = collect($stats)->unique('city');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniqueCities as $cityStat)
                    @php
                        $city = $cityStat->city;
                        $cityOccurrences = $stats->where('city', $city)->count();
                        $cityPercentage = ($cityOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td>{{ $city }}</td>
                        <td>{{ $cityOccurrences }}</td>
                        <td>{{ $cityPercentage }}%</td>
                        <td><progress value="{{ $cityPercentage }}" max="100"></progress>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No clicks data available.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
