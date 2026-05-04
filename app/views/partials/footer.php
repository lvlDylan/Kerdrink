<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashElement = document.getElementById('flash-toast');

        if (flashElement) {
            setTimeout(() => {
                const alert = new bootstrap.Alert(flashElement);
                alert.close();
            }, 5000);
        }
    });
</script>