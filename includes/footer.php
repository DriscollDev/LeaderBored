    </div>
</body>

<footer class=" footer w3-container w3-padding-16 w3-black w3-center">
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
            ?>
</footer>
 


</html>