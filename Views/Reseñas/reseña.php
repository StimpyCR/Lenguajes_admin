<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reseñas</title>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/perfil.css">
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/reseñas.css">
</head>

<body>
    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid py-4">

                <!-- ===== HERO / RESUMEN ===== -->
                <section class="reviews-hero mb-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h1 class="h3 mb-2">Reseñas del Restaurante</h1>
                            <div class="d-flex align-items-center gap-2">


                            </div>
                        </div>


                    </div>
                </section>

                <div class="row g-4">
                    <!-- ===== LISTADO ===== -->
                    <div class="col-lg-7">
                        <?php foreach($comentarios as $c): ?>
                            <article class="card-review p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar"><span class="fw-bold">K</span></div>
                                        <div>
                                            <div class="fw-semibold"><?= $c['usuario'] ?></div>
                                            <div class="text-muted small"><?= $c['fechaHora'] ?></div>
                                        </div>
                                    </div>
                                    <div class="stars" aria-label="Calificación <?= $c['calificacion'] ?> de 10">
                                        <?php for($i = 0; $i < $c['calificacion']; $i++): ?>
                                            <span class="star fill">★</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0"><?= $c['comentario'] ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <!-- ===== FORM NUEVA RESEÑA (POST) ===== -->
                    <div class="col-lg-5">
                        <form class="card p-3" method="POST" action="/tu-endpoint/de-resenas">
                            <div class="mb-2">
                                <h2 class="h5 mb-1">Deja tu reseña</h2>
                                <div class="rate-legend">Selecciona una calificación del <strong id="rateValue">10</strong> / 10</div>
                            </div>

                            <!-- Calificación 1–10 con radios -->
                            <div class="rate-10 mb-3" role="radiogroup" aria-label="Calificación del 1 al 10">
                                <input type="radio" id="rate10" name="CALIFICACION" value="10" checked><label for="rate10" title="10"></label>
                                <input type="radio" id="rate9" name="CALIFICACION" value="9"><label for="rate9" title="9"></label>
                                <input type="radio" id="rate8" name="CALIFICACION" value="8"><label for="rate8" title="8"></label>
                                <input type="radio" id="rate7" name="CALIFICACION" value="7"><label for="rate7" title="7"></label>
                                <input type="radio" id="rate6" name="CALIFICACION" value="6"><label for="rate6" title="6"></label>
                                <input type="radio" id="rate5" name="CALIFICACION" value="5"><label for="rate5" title="5"></label>
                                <input type="radio" id="rate4" name="CALIFICACION" value="4"><label for="rate4" title="4"></label>
                                <input type="radio" id="rate3" name="CALIFICACION" value="3"><label for="rate3" title="3"></label>
                                <input type="radio" id="rate2" name="CALIFICACION" value="2"><label for="rate2" title="2"></label>
                                <input type="radio" id="rate1" name="CALIFICACION" value="1"><label for="rate1" title="1"></label>
                            </div>

                            <!-- Comentario -->
                            <div class="form-floating mb-2">
                                <textarea class="form-control" id="comentario" name="COMENTARIO"
                                    placeholder="Escribe tu reseña" style="height:140px" maxlength="500" required></textarea>
                                <label for="comentario">Tu experiencia</label>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <small class="counter"><span id="chars">0</span>/500</small>
                                <span class="text-muted small">Sé respetuoso. No incluyas datos sensibles.</span>
                            </div>

                            <!-- Campos ocultos que usará tu backend -->
                            <input type="hidden" name="IDPEDIDO" value="">
                            <input type="hidden" name="IDUSUARIO" value="">
                            <input type="hidden" name="IDESTADO" value="1">
                            <input type="hidden" name="IDRESTAURANTE" value="">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Enviar reseña</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

            <?php ShowFooter(); ?>
        </div>

        <div class="chat-windows"></div>
        <?php AddJs(); ?>
    </div>

    <!-- JS mínimo (solo UI) -->
    <script>
        // Contador de caracteres
        (function() {
            const t = document.getElementById('comentario');
            const c = document.getElementById('chars');
            if (!t || !c) return;
            const u = () => c.textContent = t.value.length;
            t.addEventListener('input', u);
            u();
        })();

        // Mostrar calificación seleccionada en el texto
        (function() {
            const radios = document.querySelectorAll('input[name="CALIFICACION"]');
            const out = document.getElementById('rateValue');
            if (!radios.length || !out) return;
            const set = () => {
                const sel = document.querySelector('input[name="CALIFICACION"]:checked');
                if (sel) out.textContent = sel.value;
            };
            radios.forEach(r => r.addEventListener('change', set));
            set();
        })();
    </script>
</body>

</html>