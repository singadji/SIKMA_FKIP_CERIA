<?php
    $identitas = DB::table('identitas')->first();
?>

<!-- Footer -->
<footer class="footer pt-10 text-center">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-12">
        <div class="copyright text-center text-muted">
        &copy;     {{$identitas->nama_website}}, <script>
                        document.write(new Date().getFullYear())
                    </script>
          - Coded by <a target="_blank" rel="noopener noreferrer" href="#">Diskominfo Kabupaten Tangerang</a>.
        </div>
      </div>
    </div>
  </footer>
