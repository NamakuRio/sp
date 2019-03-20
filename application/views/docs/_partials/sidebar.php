<div class="main-sidebar sidebar-style-2 do-nicescrol">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo site_url(); ?>">Dokumentasi</a>
          </div>
          <ul>
                <?php foreach($menu as $menu): ?>
                <li>
                    <?php echo $menu->nama_menu_dokumentasi; ?>
                    <?php foreach($submenu as $submenu): ?>
                    <ul>
                      <li><a href=""><?php echo $submenu->nama_submenu_dokumentasi; ?></a></li>
                    </ul>
                    <?php endforeach; ?>
                    <?php var_dump($submenu); ?>
                </li>
                <?php endforeach; ?>
              <li>
                  Welcome
                  <ul>
                      <li><a href="" class="active">Overview</a></li>
                      <li><a href="">License</a></li>
                      <li><a href="">Upgrade Guides</a></li>
                  </ul>
              </li>
              <li>
                  Starter
                  <ul>
                      <li><a href="">Third-party Libraries</a></li>
                      <li><a href="">Folder Structure</a></li>
                      <li><a href="">Technology</a></li>
                  </ul>
              </li>
              <li>
                  Development
                  <ul>
                      <li><a href="">Introduction</a></li>
                      <li><a href="">Layout</a></li>
                      <li><a href="">Sidebar</a></li>
                      <li><a href="">Navbar</a></li>
                      <li><a href="">Content</a></li>
                      <li><a href="">Card</a></li>
                  </ul>
              </li>
              <li>
                  Javascript
                  <ul>
                      <li><a href="">Introduction</a></li>
                      <li><a href="">Modal</a></li>
                      <li><a href="">Chat</a></li>
                      <li><a href="">Gallery</a></li>
                      <li><a href="">Follow Button</a></li>
                      <li><a href="">Custom Tab</a></li>
                      <li><a href="">Utilities</a></li>
                  </ul>
              </li>
              <li>
                  Other
                  <ul>
                      <li><a href="">Support</a></li>
                  </ul>
              </li>
          </ul>
          <!-- Menu -->
        </aside>
      </div>