<footer class="container-fluid py-4 mt-5 border-top">
    <div class="text-center">
        <p class="small text-uppercase opacity-50 mb-0" style="letter-spacing: 0.15em; font-size: 0.7rem;">
            L'abus d'alcool est dangereux pour la santé, à consommer avec modération.
        </p>
        <p class="mt-2 mb-0 small opacity-25">
            &copy; <?= date('Y') ?> KerDrink - Kozh Spirit. Tous droits réservés.
        </p>
    </div>
</footer>

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