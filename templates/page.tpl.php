<!--.page -->
<div role="document" class="page">

  <!--.l-header region -->
  <header role="banner" class="l-header">

    <?php if ($top_bar): ?>
      <!--.top-bar -->
      <?php if ($top_bar_classes): ?>
      <div class="<?php print $top_bar_classes; ?>">
      <?php endif; ?>
        <nav class="top-bar"<?php print $top_bar_options; ?>>
          <ul class="title-area">
            <li class="name"><h1><?php print $linked_site_name ?></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
          </ul>
          <section class="top-bar-section">
            <?php if ($top_bar_main_menu) :?>
              <?php print $top_bar_main_menu; ?>
            <?php endif; ?>
            <?php if ($top_bar_secondary_menu) :?>
              <?php print $top_bar_secondary_menu; ?>
            <?php endif; ?>
            <?php if ($top_bar_profile_nav) :?>
              <?php print $top_bar_profile_nav; ?>
            <?php endif; ?>
          </section>
        </nav>
      <?php if ($top_bar_classes): ?>
      </div>
      <?php endif; ?>
      <!--/.top-bar -->
    <?php endif; ?>

    <!-- Title, slogan and menu -->
    <?php if ($is_front || $alt_header): ?>
    <section class="site-banner <?php if (!empty($alt_header_classes)) { print $alt_header_classes;} ?>">
      <div class="row">
        <div class="site-logo">
          <?php if ($linked_logo): print $linked_logo; endif; ?>
        </div>
        <div class="site-banner-details">
          <div class="site-banner-text">
            <?php if ($site_name): ?>
              <?php if ($title): ?>
                <div id="site-name" class="element-invisible">
                  <strong>
                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                  </strong>
                </div>
              <?php else: /* Use h1 when the content title is empty */ ?>
                <h1 id="site-name">
                  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                </h1>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <h3 title="<?php print $site_slogan; ?>" class="site-slogan"><?php print $site_slogan; ?></h3>
            <?php endif; ?>

            <?php if ($site_slogan): ?>
              <span class="site-learn-more"><a href="<?php global $base_url; print $base_url; ?>/about-us">Learn more</a></span>
            <?php endif; ?>

            <?php if (!$top_bar && $alt_main_menu): ?>
              <nav id="main-menu" class="navigation" role="navigation">
                <?php print ($alt_main_menu); ?>
              </nav> <!-- /#main-menu -->
            <?php endif; ?>

            <?php if (!$top_bar && $alt_secondary_menu): ?>
              <nav id="secondary-menu" class="navigation" role="navigation">
                <?php print $alt_secondary_menu; ?>
              </nav> <!-- /#secondary-menu -->
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
    <!-- End title, slogan and menu -->

    <?php if (!empty($page['header'])): ?>
      <!--.l-header-region -->
      <section class="l-header-region">
          <?php print render($page['header']); ?>
      </section>
      <!--/.l-header-region -->
    <?php endif; ?>

  </header>
  <!--/.l-header -->

  <?php if ($is_front): ?>
    <section class="join-mail top">
      <div class="row">
        <span class="join-link-wrapper">
          <a class="join-link" href="<?php global $base_url; print $base_url; ?>/register">Register</a>
          <span class="join-label">Join the mailing list</span>
        </span>
      </div>
    </section>
  <?php endif; ?>

  <?php if (!empty($page['featured'])): ?>
    <!--/.featured -->
    <section class="l-featured row">
      <div class="large-12 columns">
        <?php print render($page['featured']); ?>
      </div>
    </section>
    <!--/.l-featured -->
  <?php endif; ?>

  <?php if ($messages && !$zurb_foundation_messages_modal): ?>
    <!--/.l-messages -->
    <section class="l-messages row">
      <div class="large-12 columns">
        <?php if ($messages): print $messages; endif; ?>
      </div>
    </section>
    <!--/.l-messages -->
  <?php endif; ?>

  <?php if (!empty($page['help'])): ?>
    <!--/.l-help -->
    <section class="l-help row">
      <div class="large-12 columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>

  <main role="main" class="row l-main">
    <div class="<?php print $main_grid; ?> main columns">
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlight panel callout">
          <?php print render($page['highlighted']); ?>
        </div>
      <?php endif; ?>

      <a id="main-content"></a>

      <?php /*if ($breadcrumb): print $breadcrumb; endif; */ ?>
      
      <?php if ($show_title): ?>
        <?php if ($title && !$is_front): ?>
          <section class="title-region" >
            <div class="row">
              <div class='prefix-wrapper'>
                <?php print render($title_prefix); ?>
              </div>
              <div class='title-wrapper'>
                <h3 id="page-title" class="title"><?php print $title; ?></h3>
              </div>
              <div class='suffix-wrapper'>
                <?php print render($title_suffix); ?>
              </div>
            </div>
          </section>
        <?php endif; ?>
      <?php endif; ?>

      <div role="content" class="contextual-links-region">

        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
          <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
        <?php endif; ?>

        <?php if ($action_links): ?>
          <ul class="action-links">
            <?php print render($action_links); ?>
          </ul>
        <?php endif; ?>

        <?php print render($page['content']); ?>
      </div>
    </div>
    <!--/.main region -->

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside role="complementary" class="<?php print $sidebar_first_grid; ?> sidebar-first columns sidebar">
        <?php print render($page['sidebar_first']); ?>
      </aside>
    <?php endif; ?>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside role="complementary" class="<?php print $sidebar_sec_grid; ?> sidebar-second columns sidebar">
        <?php print render($page['sidebar_second']); ?>
      </aside>
    <?php endif; ?>
  </main>
  <!--/.main-->

  <?php if (!empty($page['split_first']) || !empty($page['split_second'])): ?>
    <!--.split-->
    <section class="l-split row">
      <?php if (!empty($page['split_first'])): ?>
        <div class="split-first large-6 columns">
          <?php print render($page['split_first']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['split_second'])): ?>
        <div class="split-first large-6 columns">
          <?php print render($page['split_second']); ?>
        </div>
      <?php endif; ?>
    </section>
    <!--/.split -->
  <?php endif; ?>

  <!--.banner-lower-->
  <section class="l-banner-lower" role="contentinfo">
    <?php if (!empty($page['banner-lower'])): ?>
      <div class="banner-lower">
        <?php print render($page['banner-lower']); ?>
      </div>
    <?php endif; ?>

  </section>
  <!--/.banner-lower-->

  <?php if (!empty($page['triptych_first']) || !empty($page['triptych_middle']) || !empty($page['triptych_last'])): ?>
    <!--.triptych-->
    <section class="l-triptych row">
      <div class="triptych-first large-4 columns">
        <?php print render($page['triptych_first']); ?>
      </div>
      <div class="triptych-middle large-4 columns">
        <?php print render($page['triptych_middle']); ?>
      </div>
      <div class="triptych-last large-4 columns">
        <?php print render($page['triptych_last']); ?>
      </div>
    </section>
    <!--/.triptych -->
  <?php endif; ?>

  <?php if (!empty($page['footer_firstcolumn']) || !empty($page['footer_secondcolumn']) || !empty($page['footer_thirdcolumn']) || !empty($page['footer_fourthcolumn'])): ?>
    <!--.footer-columns -->
    <section class="row l-footer-columns">
      <?php if (!empty($page['footer_firstcolumn'])): ?>
        <div class="footer-first large-3 columns">
          <?php print render($page['footer_firstcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_secondcolumn'])): ?>
        <div class="footer-second large-3 columns">
          <?php print render($page['footer_secondcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_thirdcolumn'])): ?>
        <div class="footer-third large-3 columns">
          <?php print render($page['footer_thirdcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_fourthcolumn'])): ?>
        <div class="footer-fourth large-3 columns">
          <?php print render($page['footer_fourthcolumn']); ?>
        </div>
      <?php endif; ?>
    </section>
    <!--/.footer-columns-->
  <?php endif; ?>

  <?php if (!$is_front): ?>
    <section class="join-mail bottom">
      <div class="row">
        <span class="join-link-wrapper">
          <a class="join-link" href="http://somehwere">Register</a>
          <span class="join-label">Join the mailing list</span>
        </span>
      </div>
    </section>
  <?php endif; ?>

  <!--.footer-->
  <footer class="l-footer" role="contentinfo">
    <?php if (!empty($page['footer'])): ?>
      <div class="footer">
        <?php print render($page['footer']); ?>
      </div>
    <?php endif; ?>

    <?php if ($linked_site_name) :?>
      <div class="site-info-wrapper">
        <div class="site-info">
          <div class="site-name">
            <?php if ($linked_favicon) { print $linked_favicon; } ?> 
            <?php print $linked_site_name?> 
          </div>
          <a class="copyright" href="https://creativecommons.org/licenses/by-sa/3.0/"> 
            <img src="/<?php print path_to_theme() . '/images/cc.png'?>" width="32" height="32">
            <?php print t('Creative Commons Attribution ShareAlike (CC-BY-SA 3.0) license'); ?>
            <?php print ' ' . date('Y') . ' '?> 
          </a>
        </div>
      </div>
    <?php endif; ?>
  </footer>
  <!--/.footer-->

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->
