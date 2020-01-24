<?php // Custom Dashboard page ?>

<div class="wrap about-wrap full-width-layout">

  <h1>Welcome to the <?php bloginfo('name'); ?> administration pages</h1>
  <div class="about-text">
    You can manage all of the content on the <?php bloginfo('name'); ?> website from these pages.
  </div>

  <h3>Your Content</h3>
  <p class="description">We assign each web page to a person by setting them as an author.
  Follow these links to see only the content where you are set as author.</p>
  <?php
    echo '<ul style="list-style-type: inherit; margin-left: 2rem;">';
    $pcounts = array(
      'methods' => 0,
      'technologies' => 0,
      'bioinformatics' => 0,
      'page' => 0,
      'post' => 0,
    );
    $posts = get_posts(array(
      'author' => get_current_user_id(),
      'post_type' => array_keys($pcounts)
    ));
    foreach($posts as $post) {
      $pcounts[$post->post_type] += 1;
    }
    if(isset($posts) && !empty($posts)) {
      foreach($pcounts as $pt => $pcount){
        echo '<li><a href="/wp-admin/edit.php?post_type='.$pt.'&author='.get_current_user_id().'">'.ucfirst($pt).' ('.$pcount.')</a></li>';
      }
    }
    echo '</ul>';
  ?>

  <h3>
    <a class="button button-primary" style="float:right; margin-bottom: 10px;" href="https://docs.google.com/document/d/1wXarUg1JlxSmDLZwmhZs5ChV1Kq28pV-dBniaASlPWA/edit?usp=sharing" target="_blank">Open docs in new tab</a>
    Website walkthrough for editors
  </h3>
  <div style="background-color: white; padding: 0 2rem;">
    <iframe style="width:100%; height: 600px;" src="https://docs.google.com/document/d/e/2PACX-1vTty9lSxiX0O9dgNO8v6jEftdxilRH-oVGuTpxLqCR5Ta1IULbIgcDKOvoWa-Hft4RADVxaSJhZYrFa/pub"></iframe>
  </div>

  <h3>Administrators</h3>
  <p>The code for the website is available on GitHub:
    <a href="https://github.com/NationalGenomicsInfrastructure/ngisweden.se/" target="_blank">https://github.com/NationalGenomicsInfrastructure/ngisweden.se/</a></p>
  <p>Please contact <a href="mailto:it-support@scilifelab.se">SciLifeLab IT support</a> for help regarding the server.</p>

</div>
<hr style="margin-top:3rem;">
