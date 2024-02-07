<div class="details-content details-platform">
    <h5 class="title">Platforms</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Platform</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniquePlatforms = collect($stats)->unique('platform');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniquePlatforms as $platformStat)
                    @php
                        $platform = $platformStat->platform;
                        $platformOccurrences = $stats->where('platform', $platform)->count();
                        $platformPercentage = ($platformOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td>{{ $platform }}</td>
                        <td>{{ $platformOccurrences }}</td>
                        <td>{{ $platformPercentage }}%</td>
                        <td><progress value="{{ $platformPercentage }}" max="100"></progress>
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
