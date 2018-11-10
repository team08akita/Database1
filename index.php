<?php
    $title = "ProDict";
?>


<!DOCTYPE html>
<html>

<?php (require "./components/meta.php"); ?>

<body id="page-top">
    <?php (require "./components/nav.html"); ?>
    <header class="masthead" style="background-color: #262424;">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"></div>
                <div class="intro-heading text-uppercase"><span>What's favorite?</span></div><a class="btn btn-dark btn-xl text-uppercase js-scroll-trigger" role="button" href="list.php" style="background-color: rgb(92,92,92);color: rgb(255,255,255);">Let's See!</a></div>
        </div>
    </header>
    <section id="services">
        <div class="container">
            <div class="row" style="margin-bottom: 50px;">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading" style="margin-bottom: 8px;font-size: 50px;">What's ProDict?</h2>
                    <h3 class="text-muted" style="font-size: 20px;">このサイトについて</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <p style="margin-top: 20px;margin-bottom: 0px;">僕たちだけのプログラミング辞典を作ろう。</p>
                    <p style="margin: 0px;">批判も称賛もアナタ次第。</p>
                    <p style="margin: 0px;">気に入らないなら書き換えろ。</p>
                </div>
            </div>
        </div>
    </section>
    <?php (require "./components/footer.html"); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/agency.js"></script>
</body>
</html>