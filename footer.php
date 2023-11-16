        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            const darkModeToggle = document.getElementById('darkModeToggle');
            const blackModeToggle = document.getElementById('blackModeToggle');
            const body = document.body;

            // Function to toggle dark mode
            function toggleDarkMode() {
                body.classList.remove('black-mode');
                body.classList.toggle('dark-mode');
                
                // Store user preference in localStorage
                const darkModePreference = body.classList.contains('dark-mode') ? 'enabled' : 'disabled';
                localStorage.setItem('darkMode', darkModePreference);
            }

            // Function to toggle black mode
            function toggleBlackMode() {
                body.classList.remove('dark-mode');
                body.classList.toggle('black-mode');
                
                // Store user preference in localStorage
                const blackModePreference = body.classList.contains('black-mode') ? 'enabled' : 'disabled';
                localStorage.setItem('blackMode', blackModePreference);
            }

            // Event listeners for the toggle switches
            darkModeToggle.addEventListener('change', toggleDarkMode);
            blackModeToggle.addEventListener('change', toggleBlackMode);

            // Check the user's preference from localStorage
            const darkModePreference = localStorage.getItem('darkMode');
            const blackModePreference = localStorage.getItem('blackMode');

            if (darkModePreference === 'enabled') {
                body.classList.add('dark-mode');
                darkModeToggle.checked = true;
            }

            if (blackModePreference === 'enabled') {
                body.classList.add('black-mode');
                blackModeToggle.checked = true;
            }
        </script>
    </body>
    </html>
