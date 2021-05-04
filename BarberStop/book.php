<?php
echo "<p>";
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo"</p>";

  include_once 'includes/headerinc.php';
  include_once 'includes/databhandler.php';
  include_once 'includes/functionsinc.php';
  
  
  
  
?>
<script>
   $(document).ready(function(){
      var today = new Date();
      var minDate = new Date(today);
      minDate.setDate(minDate.getDate()+1);
      var Loadcount = 1;
      var barbch = "<?php echo $_POST['barberid']; ?>";
      var closeddates = [];
      var closedtimes =[];
      var atimes = [];

      $.ajax({
         
         url:'includes/disabledate.php',
         type:'post',
         data:{closed:barbch},
         
         success:function(response){
            if ($.trim(response) == '' ) {
            // Do stuff when null/undefined/empty... 
            } 
            else { 
               var arraydates = JSON.parse(response);
               
            
            
         
               for(let i = 0 ; i < arraydates.length; i++) {
      
                  closeddates.push(arraydates[i]['appointmentDate']);
               }
               console.log(closeddates);
            } 
            
            
         }
      });
      $("#bookDate").change(function(){
         var datech = $(this).val();
         
         $.ajax({
         url:'includes/disabletime.php',
         type:'post',
         data:{date:datech, barbid:barbch},
         success:function(response){
            var a = response;
            JSON.stringify(a);
            console.log(a); //Check array output
            $.ajax({
               url:'includes/printtimes.php',
               type:'post',
               data:{arr:a},
               success:function(f){
                  $("#time").html(f);
                  
               }
            })
         }
      })
      })
      $("#bookDate").datepicker({
         beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ closeddates.indexOf(string) == -1 ]
         },
         
         showAnim:'drop',
         numberOfMonth:1,
         minDate: minDate,
         dateFormat:'yy/mm/dd',
         onClose: function(dateSelected){
         }
      })

      $.ajax({
         url:'includes/serviceinc.php',
         type:'post',
         data:{change:barbch},
         
         success:function(response){
            
            $("#serv").html(response);
            
            
         }
      })
      
      /*$("#submit").click(function(){
        $.ajax({
          url:"includes/bookinc.php",
          type:"post",
          data:$("#bookform").serialize(),
          success:function(d){
            alert(d);
            
          }
        })
      })  */
      
   });
</script>

<section class="bookform" >
          <div class="container-fluid" id="sign1">
              <div class="card text-center">
                  <div class="card-header">
                    <h2>Book</h2>
                      <p></p>
                  </div>
                  <div class="card-body">
                    <form class = "row g-3" action="includes/bookinc.php" method="post" >
                    <div id="comments"></div>
                    <h5 class="card-title text-center"> Your booking for <?php echo $_POST['barbername']?> </h5>
                    <input type="hidden" name="barber" value= <?php echo $_POST["barberid"]?> >
                     
                    
                     <input type ="text" name="date" id ="bookDate" placeholder = "Please select date" pattern ="\d{4}/\d{2}/\d{2}" "required>
                     
                    <div  class = "col-3">
                    </div>
                    <div class = "col-6 text-center">
                         <label for="sel">Select time:</label>
                        <select class="form-control" name = "time" id="time" required>
                        
                        </select>

                    </div>
                  
                    <div  class = "col-3">
                    </div>
                    <div  class = "col-3">
                    </div>
                    <div class = "col-6 text-center">
                         <label for="sel">Select required service (select one):</label>
                        <select class="form-control" name = "serv" id="serv" required>
                        
                        </select>

                    </div>
                    <input type="hidden" name="userid" value="<?php echo ($_SESSION['userid']) ?>" >
                    <input type="hidden" name="bname" value="<?php echo $_POST['barbername']?>" >
                    
                    <div class="card-footer text-muted">

                            <button class="btn btn-primary" type ="submit" name="submit">Book Now</button>

                    </div>
                    
                    
                     
                       

                     
                    </form>
      
                    </section>
                    <?php
include_once 'includes/footerinc.php';
?>