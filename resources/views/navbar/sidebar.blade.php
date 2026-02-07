  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ asset('dist') }}/index.html" class="brand-link">
              <!--begin::Brand Image-->
              <img src="{{ asset('dist') }}/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                  class="brand-image opacity-75 shadow" />
              <!--end::Brand Image-->
              <!--begin::Brand Text-->
              <span class="brand-text fw-light">SentinelOps</span>
              <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
          <nav class="mt-2">
              <!--begin::Sidebar Menu-->
              <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                  aria-label="Main navigation" data-accordion="false" id="navigation">
                  <li class="nav-item">
                      <a href="{{ route('myapp.show') }}"
                          class="nav-link  {{ request()->routeIs('myapp.show') ? 'active' : '' }}">
                          <i class="nav-icon bi bi-code-slash"></i>
                          <p>My App</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('ia.list') }}"
                          class="nav-link  {{ request()->routeIs('ia.list') ? 'active' : '' }}">
                          <i class="nav-icon bi bi-robot"></i>
                          <p>Incident Agent</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('mp.list') }}"
                          class="nav-link  {{ request()->routeIs('mp.list') ? 'active' : '' }}">
                          <i class="nav-icon bi bi-list-check"></i>
                          <p>Mitigation Plans</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('ri.list') }}"
                          class="nav-link  {{ request()->routeIs('ri.list') ? 'active' : '' }}">
                          <i class="nav-icon bi bi-check-circle"></i>
                          <p>Resolved Incident</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('ei.list') }}"
                          class="nav-link  {{ request()->routeIs('ei.list') ? 'active' : '' }}">
                          <i class="nav-icon bi bi-arrow-up-circle"></i>
                          <p>Escalated Incident</p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-speedometer"></i>
                          <p>
                              Dashboard
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/index.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Dashboard v1</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/index2.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Dashboard v2</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/index3.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Dashboard v3</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/generate/theme.html" class="nav-link">
                          <i class="nav-icon bi bi-palette"></i>
                          <p>Theme Generate</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-box-seam-fill"></i>
                          <p>
                              Widgets
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/widgets/small-box.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Small Box</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/widgets/info-box.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>info Box</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/widgets/cards.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Cards</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-clipboard-fill"></i>
                          <p>
                              Layout Options
                              <span class="nav-badge badge text-bg-secondary me-3">6</span>
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/unfixed-sidebar.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Default Sidebar</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/fixed-sidebar.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Fixed Sidebar</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/fixed-header.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Fixed Header</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/fixed-footer.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Fixed Footer</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/fixed-complete.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Fixed Complete</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/layout-custom-area.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Layout <small>+ Custom Area </small></p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/sidebar-mini.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Sidebar Mini</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/collapsed-sidebar.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Sidebar Mini <small>+ Collapsed</small></p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/logo-switch.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Sidebar Mini <small>+ Logo Switch</small></p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/layout/layout-rtl.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Layout RTL</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-tree-fill"></i>
                          <p>
                              UI Elements
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/UI/general.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>General</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/UI/icons.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Icons</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/UI/timeline.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Timeline</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-pencil-square"></i>
                          <p>
                              Forms
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/forms/general.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>General Elements</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-table"></i>
                          <p>
                              Tables
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/tables/simple.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Simple Tables</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-box-arrow-in-right"></i>
                          <p>
                              Auth
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                  <p>
                                      Version 1
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ asset('dist') }}/examples/login.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Login</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ asset('dist') }}/examples/register.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Register</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                  <p>
                                      Version 2
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ asset('dist') }}/examples/login-v2.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Login</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ asset('dist') }}/examples/register-v2.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Register</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/examples/lockscreen.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Lockscreen</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">DOCUMENTATIONS</li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/introduction.html" class="nav-link">
                          <i class="nav-icon bi bi-download"></i>
                          <p>Installation</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/layout.html" class="nav-link">
                          <i class="nav-icon bi bi-grip-horizontal"></i>
                          <p>Layout</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/color-mode.html" class="nav-link">
                          <i class="nav-icon bi bi-star-half"></i>
                          <p>Color Mode</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-ui-checks-grid"></i>
                          <p>
                              Components
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/docs/components/main-header.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Main Header</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/docs/components/main-sidebar.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Main Sidebar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-filetype-js"></i>
                          <p>
                              Javascript
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ asset('dist') }}/docs/javascript/treeview.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Treeview</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/browser-support.html" class="nav-link">
                          <i class="nav-icon bi bi-browser-edge"></i>
                          <p>Browser Support</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/how-to-contribute.html" class="nav-link">
                          <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                          <p>How To Contribute</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/faq.html" class="nav-link">
                          <i class="nav-icon bi bi-question-circle-fill"></i>
                          <p>FAQ</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ asset('dist') }}/docs/license.html" class="nav-link">
                          <i class="nav-icon bi bi-patch-check-fill"></i>
                          <p>License</p>
                      </a>
                  </li>
                  <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>Level 1</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>
                              Level 1
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Level 2</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>
                                      Level 2
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Level 2</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>Level 1</p>
                      </a>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-danger"></i>
                          <p class="text">Important</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-warning"></i>
                          <p>Warning</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-info"></i>
                          <p>Informational</p>
                      </a>
                  </li> --}}
              </ul>
              <!--end::Sidebar Menu-->
          </nav>
      </div>
      <!--end::Sidebar Wrapper-->
  </aside>
