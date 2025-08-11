<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/LENGUAJES_ADMIN/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html lang="es">

<?php
AddCss();
?>

<head>
    <link rel="stylesheet" href="/LENGUAJES_ADMIN/Views/Estilos/sobreNosotros.css">
</head>

<body>
    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowSideBar();
        ?>

        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Sección Sobre Nosotros -->
                <section class="about-section">
                    <div class="about-hero hero-wide">
                        <video class="hero-video" autoplay muted loop playsinline preload="metadata">
                            <source src="/LENGUAJES_ADMIN/Views/Videos/nosotros.mp4" type="video/mp4">
                        </video>
                        <div class="hero-text">
                            <h1>Calidad y Seguridad en Kerat</h1>
                        </div>
                    </div>


                    <!-- Bloque Compromiso -->
                    <div class="about-block animate-slide-up">
                        <h2>Comprometidos con la calidad</h2>
                        <hr class="divider">
                        <p>En Kerat, la excelencia en la seguridad alimentaria es el centro de todo lo que hacemos. Nos comprometemos a ofrecer alimentos seguros y de alta calidad que nuestros clientes puedan disfrutar con confianza.</p>
                        <p>Nuestros rigurosos estándares y protocolos abarcan desde los procesos internos hasta los proveedores. Todo el personal recibe capacitación constante, y fomentamos una cultura sólida de calidad en cada paso. Además, cumplimos con normas internacionales como la GFSI y certificaciones reconocidas que garantizan buenas prácticas alimentarias.</p>
                    </div>

                    <!-- Proceso de Seguridad -->
                    <div class="about-block animate-slide-up">
                        <h2>Visión del proceso de calidad</h2>
                        <h4>Manteniendo la excelencia en seguridad alimentaria</h4>
                        <hr class="divider">
                        <p>Nuestros programas de calidad cubren desde auditorías externas, capacitaciones, tecnología avanzada y certificaciones exigentes. Nos enfocamos en la mejora continua para garantizar los estándares más altos del sector, siempre respaldados por nuestro equipo especializado en inocuidad y calidad.</p>
                    </div>
                </section>
            </div>

            <?php ShowFooter(); ?>
        </div>
    </div>

    <div class="chat-windows"></div>

    <?php AddJs(); ?>
</body>

</html>