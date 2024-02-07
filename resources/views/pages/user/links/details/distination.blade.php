<div class="details-content details-distination">
    <h5 class="title">Distinations</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Distination</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniqueDistinations = collect($stats)->unique('distination_id');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniqueDistinations as $distinationStat)
                    @php
                        $distination = App\Models\Distination::where('id', $distinationStat->distination_id)
                            ->get()
                            ->first();
                        $distinationOccurrences = $stats->where('distination_id', $distinationStat->distination_id)->count();
                        $distinationPercentage = ($distinationOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td><a href="{{ $distination->distination }}">{{ $distination->distination }}</a></td>
                        <td>{{ $distinationOccurrences }}</td>
                        <td>{{ $distinationPercentage }}%</td>
                        <td><progress value="{{ $distinationPercentage }}" max="100"></progress>
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
