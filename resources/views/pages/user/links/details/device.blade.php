<div class="details-content details-device">
    <h5 class="title">Devices</h5>
    <table class="table">
        <thead>
            <tr>
                <td>Device</td>
                <td>Clicks</td>
                <td>% Clicks</td>
                <td></td>
            </tr>
        </thead>
        <tbody>

            @php
                $totalClicks = count($stats);
            @endphp

            @if ($totalClicks > 0)
                @php
                    $desktopOccurrences = $stats->where('is_desktop', '1')->count();
                    $robotOccurrences = $stats->where('is_robot', '1')->count();
                    $tabletOccurrences = $stats->where('is_tablet', '1')->count();
                    $mobileOccurrences = $stats->where('is_mobile', '1')->count();

                    $desktopPercentage = ($desktopOccurrences / $totalClicks) * 100;
                    $robotPercentage = ($robotOccurrences / $totalClicks) * 100;
                    $tabletPercentage = ($tabletOccurrences / $totalClicks) * 100;
                    $mobilePercentage = ($mobileOccurrences / $totalClicks) * 100;
                @endphp
                <tr>
                    <td>Desktop</td>
                    <td>{{ $desktopOccurrences }}</td>
                    <td>{{ $desktopPercentage }}%</td>
                    <td><progress value="{{ $desktopPercentage }}" max="100"></progress>
                    </td>
                </tr>
                <tr>
                    <td>Robot</td>
                    <td>{{ $robotOccurrences }}</td>
                    <td>{{ $robotPercentage }}%</td>
                    <td><progress value="{{ $robotPercentage }}" max="100"></progress>
                    </td>
                </tr>
                <tr>
                    <td>Tablet</td>
                    <td>{{ $tabletOccurrences }}</td>
                    <td>{{ $tabletPercentage }}%</td>
                    <td><progress value="{{ $tabletPercentage }}" max="100"></progress>
                    </td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>{{ $mobileOccurrences }}</td>
                    <td>{{ $mobilePercentage }}%</td>
                    <td><progress value="{{ $mobilePercentage }}" max="100"></progress>
                    </td>
                </tr>
                {{-- @endforeach --}}
            @else
                <tr>
                    <td colspan="3">No clicks data available.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
