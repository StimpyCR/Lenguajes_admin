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
                    <!-- Hero Banner -->
                    <div class="about-hero">
                        <video autoplay muted loop playsinline class="hero-video">
                            <source src="/sobreNosotros.mp4" type="video/mp4">
                            Tu navegador no soporta video HTML5.
                        </video>
                        <div class="hero-text animate-fade">
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

                    <!-- Consejo Asesor -->
                    <div class="advisory-section animate-fade">
                        <h2>Conocé a nuestro Consejo de Calidad</h2>
                        <div class="advisors">
                            <div class="advisor">
                                <img src="https://www.teletica.com/_next/image?url=https%3A%2F%2Fstatic3.teletica.com%2FFiles%2FSizes%2F2024%2F7%2F26%2Fedgar-silva_1662055358_760x520.png&w=640&q=75" alt="Consejero 1">
                                <h5>Edgar Silva</h5>
                                <p class="title">Asesor en Seguridad Alimentaria</p>
                                <p>Especialista en inocuidad alimentaria con más de 15 años en regulación, formación y certificación internacional.</p>
                                <a href="#">LEER MÁS</a>
                            </div>
                            <div class="advisor">
                                <img src="/img/advisor2.jpg" alt="Consejero 2">
                                <h5>Daniel Rivera</h5>
                                <p class="title">Director de Calidad</p>
                                <p>Veterinario y auditor en procesos de manufactura, ha liderado iniciativas de trazabilidad, bienestar animal y seguridad alimentaria.</p>
                                <a href="#">LEER MÁS</a>
                            </div>
                        </div>
                        <div class="advisors">
                            <div class="advisor">
                                <img src="/img/advisor3.jpg" alt="Consejero 3">
                                <h5>Valeria no se que</h5>
                                <p class="title">Investigadora y Consultora</p>
                                <p>Doctora en microbiología alimentaria, participa en investigaciones sobre control de patógenos en alimentos listos para consumo.</p>
                                <a href="#">LEER MÁS</a>
                            </div>
                            <div class="advisor">
                                <img src="/img/advisor4.jpg" alt="Consejero 4">
                                <h5>Nicolas</h5>
                                <p class="title">Jefe de Aseguramiento de Calidad</p>
                                <p>Ingeniero en alimentos con certificaciones HACCP y SQF, coordina equipos de validación de procesos y mejora continua.</p>
                                <a href="#">LEER MÁS</a>
                            </div>
                        </div>
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