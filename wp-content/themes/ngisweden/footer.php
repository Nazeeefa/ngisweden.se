    <footer>
      <div class="container">
        <div class="row footer-widgets">
          <?php
          for ($i = 1; $i <= 5; $i++){
            if (is_active_sidebar('footer-widget-area-'.$i)){
              echo '<div class="col">';
              dynamic_sidebar( 'footer-widget-area-'.$i );
              echo '</div>';
            }
          }
          ?>
          <div class="col text-right">
            <a href="https://www.scilifelab.se" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()  ?>/img/SciLifeLab-logo.svg" class="footer-scilifelab-logo" alt="SciLifeLab logo"></a>
            <br>
            <a href="https://www.ki.se" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()  ?>/img/KI-logo.svg" class="footer-uni-logo" alt="KI logo"></a>
            <a href="https://www.kth.se" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()  ?>/img/KTH-logo.svg" class="footer-uni-logo" alt="KTH logo"></a>
            <a href="https://www.su.se" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()  ?>/img/SU-logo.svg" class="footer-uni-logo" alt="SU logo"></a>
            <a href="https://www.uu.se" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()  ?>/img/UU-logo.svg" class="footer-uni-logo" alt="UU logo"></a>
          </div>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
