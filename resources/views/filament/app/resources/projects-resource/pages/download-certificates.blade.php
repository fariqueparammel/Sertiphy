<x-filament-panels::page>
    {{-- Loading Indicator --}}
    <div id="loading-indicator" style="display: none;">
        <x-filament::loading-indicator class="h-5 w-5" />
        <p>Preparing your download...</p>
    </div>

    {{-- Download Button --}}
    <x-filament::button id="download-button" class="download">
        Download
    </x-filament::button>

    <script>
        // Retrieve the partial URI from sessionStorage
        const partialUri = sessionStorage.getItem("downloadUri");

        if (!partialUri) {
            console.error('Download URI not found.');
            new FilamentNotification()
                .title('Error')
                .body('The download link is not available.')
                .danger()
                .seconds(5)
                .send();
        } else {
            // Base URL of the FastAPI backend
            const baseUrl = "http://127.0.0.1:8080";

            // Construct the full download URI
            const fullUri = `${baseUrl}${partialUri}`;

            // Add a click event listener to the button
            document.getElementById('download-button').addEventListener('click', () => {
                // Show the loading indicator
                document.getElementById('loading-indicator').style.display = 'block';

                // Programmatically trigger the file download
                setTimeout(() => {
                    // Create a temporary anchor element
                    const anchor = document.createElement('a');
                    anchor.href = fullUri;
                    anchor.download = true; // Optional: Forces the browser to treat it as a download
                    anchor.style.display = 'none'; // Hide the anchor element
                    document.body.appendChild(anchor); // Append it to the DOM
                    anchor.click(); // Simulate a click to trigger the download
                    document.body.removeChild(anchor); // Remove the anchor after the click

                    // Hide the loading indicator after the download starts
                    document.getElementById('loading-indicator').style.display = 'none';
                }, 1000); // Simulate a delay (remove this if no delay is needed)
            });
        }
    </script>
</x-filament-panels::page>
