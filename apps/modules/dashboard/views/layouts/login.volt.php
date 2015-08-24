<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>SPECTRUM | Iniciar sesión</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--Meta Google-->
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="nofollow">
    <meta name="googlebot" content="nofollow">
    <meta name="google" content="notranslate" />
    <meta name="author" content="Chontal Developers" />
    <meta name="copyright" content="2015 c-develpers.com Todos los derechos reservados." />
    <meta name="application-name" content="C-Developers" />
    <link rel="author" href="https://plus.google.com/u/0/101316577346995540804/posts"/>

    <!-- CSS INCLUDE -->
    
        <?php echo $this->assets->outputCss('functions'); ?>
    
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo $this->url->get('dash/css/theme-default.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $this->url->get('dash/css/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo $this->url->get('dash/css/fontawesome/font-awesome.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $this->url->get('front/assets/css/formValidation.min.css'); ?>" media="screen">
    <!-- EOF CSS INCLUDE -->
</head>
<body>
<?php echo $this->getContent(); ?>
    
        <?php echo $this->assets->outputJs('JsIndexLogin'); ?>
    
</body>
</html>