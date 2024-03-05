<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.2.0/jquery-migrate.min.js" integrity="sha256-04lIChOgWF7jIOxGWaIMJE5y+W/0xUVDlh2+nwJuB28=" crossorigin="anonymous"></script>


<!-- popper -->
<script src="assets/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- plugin js-->
<script src="assets/js/plugin.js"></script>

<!-- MpusemoverParallax JS-->
<script src="assets/js/TweenMax.js"></script>
<script src="assets/js/mousemoveparallax.js"></script>
<!-- main -->
<script src="assets/js/main.js"></script>


<script src="dist/jquery.bracket.min.js" type="text/javascript"></script>

<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=b8c5d838-220c-412a-b848-cef14dbb949a"> </script>


<script src='https://js.sentry-cdn.com/cd61cb6879454e569d1d62574bb96c6b.min.js' crossorigin="anonymous"></script>
<script>
    Sentry.init({ dsn: 'https://cd61cb6879454e569d1d62574bb96c6b@o382843.ingest.sentry.io/5212339' });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166613972-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?=getenv('GOOGLE_TRACKING_ID')?>');
</script>

<!-- Hotjar Tracking Code -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:<?=getenv('HOTJAR_ID')?>,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

