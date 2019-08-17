
<!-- Footer -->
    <footer class="py-5 bg-dark" id="footer">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; shima@2019</p>
      </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

<?php
    if(isset($connection)){
        mysqli_close($connection);
    }
?>