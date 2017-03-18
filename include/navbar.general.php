<!-- Navigation -->
<style>
    .logo {
      margin-top: -5px;
      margin-right: -10px;
      height: 70px;
    }
    .clock {
      font-size: 3em;
    }

    @media (max-width: 768px) {
      .clock {
        font-size: 2em;
        text-align: center;
      }
      .logo {
        height: 50px;
        margin-left: 50%; 
      }
    }
</style>

<nav class="navbar navbar-static-top" >
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img class="logo" alt="Brand" src="../img/logo-waposat.png">
      </a>
    </div>
    <p class="clock navbar-text navbar-right"></div>
  </div>
</nav>

<script type="text/javascript">
    
    function clock() {// We create a new Date object and assign it to a variable called "time".
    var time = new Date(),
        
        // Access the "getHours" method on the Date object with the dot accessor.
        hours = time.getHours(),
        
        // Access the "getMinutes" method with the dot accessor.
        minutes = time.getMinutes(),
        
        
        seconds = time.getSeconds();

    document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
      
      function harold(standIn) {
        if (standIn < 10) {
          standIn = '0' + standIn
        }
        return standIn;
      }
    }
    setInterval(clock, 1000);
</script>