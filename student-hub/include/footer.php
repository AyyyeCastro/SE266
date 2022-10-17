<hr />          
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
        //date.timezone = "Europe/Athens"
    ?>
 <p> <i>code used from NIET's SE266.05 course.</i>
</body>

</html>