<!-- Footer Scripts -->
<?php
  echo js('assets/js/theme-vendor.min.js');
  echo js('assets/js/theme.js');
  echo js('assets/js/theme-custom-scripts.js');
  echo $site->custom_html_footer()->html();
  ?>

<script type="text/javascript">

  // Google analytics
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '<?php echo $site->google_analytics_id() ?>', 'auto');
  ga('send', 'pageview');

  // Disqus
  var disqus_shortname  = "<?php echo $site->disqus_shortname() ?>";
  var disqus_identifier = '<?php echo $page->hash() ?>';
  (function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = '//' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
  }());

</script>

</body>