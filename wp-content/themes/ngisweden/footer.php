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
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
