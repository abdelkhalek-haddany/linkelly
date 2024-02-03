<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
</head>

<body>
    <h1>hello world</h1>
    <script>
        function getUserInfo() {
            // Browser information
            var browserInfo = {
                appName: navigator.appName,
                appVersion: navigator.appVersion,
                userAgent: navigator.userAgent,
                platform: navigator.platform,
                language: navigator.language || navigator.userLanguage,
                cookiesEnabled: navigator.cookieEnabled,
                online: navigator.onLine,
            };

            // Screen information
            var screenInfo = {
                screenWidth: window.screen.width,
                screenHeight: window.screen.height,
                screenColorDepth: window.screen.colorDepth,
                screenPixelDepth: window.screen.pixelDepth,
            };

            // Location information (requires user consent)
            function getLocation() {
                return new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(
                        position => resolve(position.coords),
                        error => reject(error)
                    );
                });
            }

            // Device information
            var deviceInfo = {
                deviceType: getDeviceType(), // You need to implement getDeviceType function
                deviceModel: getDeviceModel(), // You need to implement getDeviceModel function
                batteryLevel: getBatteryLevel(), // Requires user consent
            };

            // Network information
            var networkInfo = {
                connectionType: navigator.connection ? navigator.connection.type : 'unknown',
                effectiveType: navigator.connection ? navigator.connection.effectiveType : 'unknown',
                downlinkSpeed: navigator.connection ? navigator.connection.downlink : 'unknown',
            };

            // Document information
            var documentInfo = {
                documentWidth: document.documentElement.clientWidth,
                documentHeight: document.documentElement.clientHeight,
            };

            // Timezone information
            var timezoneInfo = {
                timezoneOffset: new Date().getTimezoneOffset(),
                timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            };

            // Fetching geolocation data asynchronously
            getLocation()
                .then(coords => {
                    // Combine all user information
                    var userInfo = {
                        browser: browserInfo,
                        screen: screenInfo,
                        geolocation: {
                            latitude: coords.latitude,
                            longitude: coords.longitude,
                            accuracy: coords.accuracy,
                        },
                        device: deviceInfo,
                        network: networkInfo,
                        document: documentInfo,
                        timezone: timezoneInfo,
                        // Add other fields as needed
                    };

                    // Send the user information to the server (you need to implement this part)
                    sendUserInfoToServer(userInfo);
                })
                .catch(error => {
                    console.error('Error fetching geolocation:', error);

                    // If geolocation fails, still send other available information
                    var userInfoWithoutGeolocation = {
                        browser: browserInfo,
                        screen: screenInfo,
                        device: deviceInfo,
                        network: networkInfo,
                        document: documentInfo,
                        timezone: timezoneInfo,
                        // Add other fields as needed
                    };

                    // Send the user information to the server
                    sendUserInfoToServer(userInfoWithoutGeolocation);
                });
        }
        getUserInfo();
    </script>
</body>

</html>
