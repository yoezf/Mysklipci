<footer class="bg-white border-t mt-8">
    <div class="max-w-6xl mx-auto px-4 py-4 text-xs text-slate-500 flex justify-between items-center">

        <span class="flex items-center gap-1">
            <!-- Heroicon: Calendar -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 9.75h18M4.5 6.75h15a1.5 1.5 0 011.5 1.5v10.5a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5z" />
            </svg>
            &copy; <?= date('Y'); ?> SIPKS – SKLIPCI
        </span>

        <span class="flex items-center gap-2">
            <!-- Heroicon: Code Bracket -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 6.75L3 12l5.25 5.25M15.75 6.75L21 12l-5.25 5.25" />
            </svg>
            PHP Native · MySQL · TailwindCSS
        </span>

    </div>
</footer>

</div> <!-- end of min-h-screen -->

<script src="<?= BASE_URL; ?>/public/js/app.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleBtn = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('adminSidebar');
        var overlay = document.getElementById('sidebarOverlay');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                var isHidden = sidebar.classList.contains('-translate-x-full');

                if (isHidden) {
                    sidebar.classList.remove('-translate-x-full');
                    if (overlay) overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    if (overlay) overlay.classList.add('hidden');
                }
            });
        }

        if (overlay && sidebar) {
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('input[name="no_hp"]').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
            });
        });
    });
</script>

</body>
</html>
