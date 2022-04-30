<?php 

echo "
<script>

(function (jQuerOs){

    jQuerOs(window).on('load', function () {
        var preloader = jQuerOs('#preloader'),
            spinner   = preloader.find('.os-spinner');
        spinner.fadeOut();
        preloader.delay().fadeOut('slow');
    });

})(jQuerOs);

</script>
";

?>
