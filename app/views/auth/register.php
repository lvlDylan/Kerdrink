<main class="container d-flex align-items-center justify-content-center min-vh-75 py-5">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

        <header class="text-center mb-5">
            <h1 class="h2 fw-bold text-premium mb-2">Création de votre compte client</h1>
            <p class="small opacity-50 text-uppercase tracking-widest">Identifiez-vous pour créer votre compte client.</p>
        </header>

        <section class="card product-card p-4 p-md-5 shadow-lg border-0">

            <?php if ($flash = Helper::getFlash()) : ?>
                <div class="alert alert-dismissible fade show d-flex align-items-center p-3 mb-4 rounded-3 border-start border-4 shadow-sm" id="flash-toast"
                    style="background: var(--acc-soft); border-color: var(--acc) !important;">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="color: var(--acc);"></i>
                    <div style="color: var(--txt); font-size: 0.85rem; font-weight: 500;">
                        <?= $flash["message"] ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="/inscription-exe" method="POST">

                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">NOM <span style="color: red">*</span></label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-file-earmark-person" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="lastName" class="form-control bg-transparent border-0 text-white"
                                placeholder="Dupont" required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">PRENOM <span style="color: red">*</span></label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-file-earmark-person" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="firstName" class="form-control bg-transparent border-0 text-white"
                                placeholder="Pierre" required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">PSEUDO <span style="color: red">*</span></label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-person text-info" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="pseudo" class="form-control bg-transparent border-0 text-white"
                                placeholder="Pseudonyme" required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">MOT DE PASSE <span style="color: red">*</span></label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-key" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="password" name="password" class="form-control bg-transparent border-0 text-white"
                                placeholder="••••••••" required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">E-MAIL</label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-envelope" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="email" class="form-control bg-transparent border-0 text-white"
                                placeholder="E-mail..." style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">TELEPHONE</label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-telephone" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="telephone" class="form-control bg-transparent border-0 text-white"
                                placeholder="" style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <div class="captcha-container">
                        <canvas id="captchaCanvas" width="250" height="70"></canvas>
                        <button id="refreshBtn" type="button">↻</button>

                        <input type="text" id="userInput" placeholder="Entrez le texte" autocomplete="off"/>
                        <button id="validateBtn" type="button">Valider</button>
                        <p id="message"></p>

                    </div>
                </div>

                <button type="submit" class="btn-premium w-100 py-3 text-uppercase shadow-sm" id="registerBtn" disabled>
                    Initialiser la session <i class="bi bi-key ms-2"></i>
                </button>
            </form>

            <footer class="mt-4 text-center">
                <a href="/connexion" class="small text-decoration-none opacity-75 hover-opacity-100" style="color: var(--txt);">
                    Vous avez déjà un compte ? <span style="color: var(--acc);">Se connecter</span>
                </a>
            </footer>
        </section>

    </div>
</main>

<script src="/js/captcha.js"></script>