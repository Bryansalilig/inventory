<div class="sidebar">
  <div class="sidebar-wrapper">
    <!-- Logo -->
    <div class="logo text-center">
      <img class="logoimg" src="{{ asset('images/logo.png') }}" style="width: 200px" />
    </div>

    <ul class="nav">
      <li class="{{ isActiveRoute(['dashboard']) }}">
        <a href="#">
          <p>
            <img width="22" src="{{ asset('images/icon-dashboard.png') }}" />
            &nbsp;&nbsp;Dashboard
          </p>
        </a>
      </li>

      <li class="{{ isActiveRoute(['assets.*']) }}">
        <a href="{{ route('assets.index') }}">
          <p>
            <img width="22" src="{{ asset('images/icon-asset.png') }}" />
            &nbsp;&nbsp;Assets
          </p>
        </a>
      </li>

      <li class="{{ isActiveRoute(['components.*']) }}">
        <a href="{{ route('components.index') }}">
          <p>
            <img width="22" src="{{ asset('images/icon-component.png') }}" />
            &nbsp;&nbsp;Components
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="22" src="{{ asset('images/icon-maintenance.png') }}" />
            &nbsp;&nbsp;Maintenance
          </p>
        </a>
      </li>

      <li class="{{ isActiveRoute(['cubicles.*']) }}">
        <a href="{{ route('cubicles.index') }}">
          <p>
            <img width="22" src="{{ asset('images/icon-type.png') }}" />
            &nbsp;&nbsp;Cubicles
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="25" src="{{ asset('images/icon-manufacturer.png') }}" />
            &nbsp;&nbsp;Brands
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="25" src="{{ asset('images/icon-supplier.png') }}" />
            &nbsp;&nbsp;Suppliers
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="25" src="{{ asset('images/icon-location.png') }}" />
            &nbsp;&nbsp;Locations
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="25" src="{{ asset('images/icon-employee.png') }}" />
            &nbsp;&nbsp;Employees
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="20" src="{{ asset('images/icon-department.png') }}" />
            &nbsp;&nbsp;Departments
          </p>
        </a>
      </li>

      <li>
        <a href="#">
          <p>
            <img width="25" src="{{ asset('images/icon-report.png') }}" />
            &nbsp;&nbsp;Reports
          </p>
        </a>
      </li>

      <!-- Settings -->
      <li>
        <a href="#settingsMenu">
          <p>
            <img width="25" src="{{ asset('images/icon-setting.png') }}" />
            &nbsp;&nbsp;Settings
          </p>
        </a>

        <div id="settingsMenu" class="collapse">
          <ul class="nav">
            <li>
              <a href="#">
                <span class="sidebar-normal">Users</span>
              </a>
            </li>

            <li>
              <a href="#">
                <span class="sidebar-normal">Application Settings</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
