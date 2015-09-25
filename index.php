<?
srand ((float) microtime() * 10000000);
$input = array ("001", "003", "005", "006", "008", "010","011","013");
$randKey = array_rand($input);
?>

<html>
<head>
<title>Jason Silverstein</title>

<meta charset="UTF-8">
<meta name="description" content="The personal website of Jason B. Silverstein.">
<meta name="keywords" content="Jason Silverstein, Silverstein, Jason, Silverstein Kirkland, Jason Silverstein Dallas, product development">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<style>

/* Webfont: Lato-Regular */@font-face {
    font-family: 'LatoWeb';
    src: url('css/Lato-Regular.eot'); /* IE9 Compat Modes */
    src: url('css/Lato-Regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
         url('css/Lato-Regular.woff2') format('woff2'), /* Modern Browsers */
         url('css/Lato-Regular.woff') format('woff'), /* Modern Browsers */
         url('css/Lato-Regular.ttf') format('truetype');
    font-style: normal;
    font-weight: normal;
    text-rendering: optimizeLegibility;
}

* { margin: 0; padding: 0; }

body {
	background: url(img/<? echo $input[$randKey]; ?>.jpg);
	background-position: center center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;
	background-color: black;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	}

#top {
	padding: 20px 30px 25px 25px;
	margin-top:0px;
	position: absolute;
  top: 20px;
  left: 20px;
	background: black;
	opacity: 0.7;
  -moz-box-shadow: 0 0 3px #000;
  -webkit-box-shadow: 0 0 3px #000;
  box-shadow: 0 0 3px #000;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
	}

p {	font: 17px LatoWeb, Helvetica, Arial, Sans Serif; color: #fff; line-height: 24px; margin-bottom:20px; }
a { color: #fff; text-decoration: none; border-bottom: 1px solid; }
a:hover { color: #5ea9dd; text-decoration: none; border-bottom: 1px solid #5ea9dd; }
h1 { display: none; }
h2 { font: 20px LatoWeb, Helvetica, Arial, Sans Serif; color: #fff; line-height: 24px; margin-bottom:20px; }

</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5936341-2']);
  _gaq.push(['_setDomainName', 'jasonsilverstein.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
	<body>
			<div id="top">
				<p><a href="mailto:jason.silverstein+sitequestion@gmail.com?subject=site_question" title="Send an email"><strong>contact/email</strong> &raquo;</a></p>
        <p>Husband. Dad.<br />
        VP, Product &amp; Engineering, <a href="http://rightside.co">Rightside</a>.<br />
        Board, <a href="http://f3nation.com">F3</a>/<a href="http://theironproject.com">The Iron Project</a>.</p>
        <p>Elsewhere (<a href="https://www.evernote.com/l/AASwPxi5YXJIIqRDPF8JC_jatYbZFvYZF7Y" title="Learn about these domain names and what they mean">?</a>):</p>
        <p><!-- lazy lis -->
					&middot; <a href="http://jason.news">jason.news</a> (twitter)<br />
					&middot; <a href="http://jason.engineering">jason.engineering</a> (linkedin)<br />
					&middot; <a href="http://jason.team">jason.team</a> (quora)<br />
				</p>
			</div>
	</body>
</html>
