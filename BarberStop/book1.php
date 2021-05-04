<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  include_once 'includes/headerinc.php';
  include_once 'includes/databhandler.php';
  include_once 'includes/functionsinc.php';
?>
<script>
$(document).ready(function(){
    $.ajax({
        url:'includes/fetchbarbersinc.php',
        type:'post',
        success:function(d){
            $("#barberrow").html(d);
        }
    })
})

</script>

<section>
    <div class = "container-fluid" id="barberscontainer">
        <div class = "row g-2" id="barberrow">
        
        </div>
    </div>
</section>

<?php
include_once 'includes/footerinc.php';
?>