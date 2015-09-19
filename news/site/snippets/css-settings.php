<?php
  $primaryColor = $site->design_primary_color()
  ?>

<style>

/* Primary color
/*--------------------------------------------------*/

/* Color */
a,
h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover,
footer#app-footer a:hover,
header#app-header .brand a:hover,
.accordion dt a:hover,
.nav-primary .np-toggle:hover,
.nav-primary>ul>li:hover>:first-child,
.nav-primary>ul ul li:hover>:first-child,
.nav-primary>ul>li.np-active:hover>:first-child,
.nav-primary>ul ul li.np-active:hover>:first-child,
.blog-archives .nav-side>ul a,
.pagination a:hover,
.piece-meta a:hover,
.piece-meta .icons a:hover,
.piece-short a:hover,
.piece-short .client a:hover,
.post-meta a:hover,
.post-meta .avatar a:hover img,
.post-short .post-meta a:hover,
.tabs .tab-title:hover {
  color: <?php echo $primaryColor ?>;
}

/* Background */
.audioplayer-bar-played,
.audioplayer-volume-adjust div div {
  background-color: <?php echo $primaryColor ?>;
}

/* Border */
.post-meta .avatar a:hover img,
.fancybox-origin .fancybox-close:active,
.fancybox-origin .fancybox-close:hover,
.fancybox-origin .fancybox-nav-next:active,
.fancybox-origin .fancybox-nav-next:hover,
.fancybox-origin .fancybox-nav-prev:active,
.fancybox-origin .fancybox-nav-prev:hover {
  border-color: <?php echo $primaryColor ?>;
}

.nav-primary>ul>li.np-node:hover>:first-child:after,
.nav-primary>ul ul li.np-node:hover>:first-child:after {
  border-top-color: <?php echo $primaryColor ?>;
}

/* Selection */
::selection {
  background: <?php echo $primaryColor ?>;
}

::-moz-selection {
  background: <?php echo $primaryColor ?>;
}

img::selection {
  background: <?php echo $primaryColor ?>;
}

img::-moz-selection {
  background: <?php echo $primaryColor ?>;
}

</style>