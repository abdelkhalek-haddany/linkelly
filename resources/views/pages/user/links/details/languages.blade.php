<div class="details-content details-language">
    <h5 class="title">Languages</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Language</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalClicks = count($stats);
                $uniqueLanguages = collect($stats)->unique('languages');
            @endphp
            @if ($totalClicks > 0)
                @foreach ($uniqueLanguages as $languageStat)
                    @php
                        $language = $languageStat->language;
                        $languageOccurrences = $stats->where('languages', $language)->count();
                        $languagePercentage = ($languageOccurrences / $totalClicks) * 100;
                    @endphp

                    <tr>
                        <td>{{ $language }}</td>
                        <td>{{ $languageOccurrences }}</td>
                        <td>{{ $languagePercentage }}%</td>
                        <td><progress value="{{ $languagePercentage }}" max="100"></progress>
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
