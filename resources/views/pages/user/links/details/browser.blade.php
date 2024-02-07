<div class="details-content details-browser">
    <h5 class="title">Browsers</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Browser</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniqueBrowsers = collect($stats)->unique('browser');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniqueBrowsers as $browserStat)
                    @php
                        $browser = $browserStat->browser;
                        $browserOccurrences = $stats->where('browser', $browser)->count();
                        $browserPercentage = ($browserOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td>{{ $browser }}</td>
                        <td>{{ $browserOccurrences }}</td>
                        <td>{{ $browserPercentage }}%</td>
                        <td><progress value="{{ $browserPercentage }}" max="100"></progress>
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
