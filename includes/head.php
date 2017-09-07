<head>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <title>
        <?php echo $pageTitle; ?>
    </title>
    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/Styles/style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script type="text/javascript" src="components/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="components/bootstrap/dist/js/bootstrap.js"></script>
    <?php
    if($needtologin===true){
        echo "<script>var needtologin = true; </script>";
    }
    ?>
</head>