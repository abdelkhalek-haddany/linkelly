<div class="details-content details-country">
    <h5 class="title">Countries</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Country</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniqueCountries = collect($stats)->unique('country');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniqueCountries as $countryStat)
                    @php
                        $country = $countryStat->country;
                        $countryOccurrences = $stats->where('country', $country)->count();
                        $countryPercentage = ($countryOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td>{{ $country }}</td>
                        <td>{{ $countryOccurrences }}</td>
                        <td>{{ $countryPercentage }}%</td>
                        <td><progress value="{{ $countryPercentage }}" max="100"></progress>
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
