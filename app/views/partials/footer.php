<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alert = document.getElementById('error-alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => {
                    alert.remove();
                }, 150);
            }, 3500);
        }
    });
</script>