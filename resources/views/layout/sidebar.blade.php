<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link " href="/admin/users">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/moods">
                <i class="bi bi-person"></i>
                <span>Moods</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/mood-results">
                <i class="bi bi-person"></i>
                <span>Mood Result</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-pc-display-horizontal"></i><span>Questions</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/questions">
                        <i class="bi bi-circle-fill"></i><span>List Questions</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/questions/create">
                        <i class="bi bi-circle-fill"></i><span>Add Questions</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-tags-fill"></i><span>Mood Configurations</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/mood-configurations">
                        <i class="bi bi-circle-fill"></i><span>List Mood Config</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/mood-configurations/create">
                        <i class="bi bi-circle-fill"></i><span>Add Mood Config</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/avatar-moods">
                <i class="bi bi-person"></i>
                <span>Avatar Moods</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/mood-range">
                <i class="bi bi-person"></i>
                <span>Mood Range Percentage</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/article">
                <i class="bi bi-person"></i>
                <span>Article</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="/admin/game">
                <i class="bi bi-person"></i>
                <span>Game</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-pc-display-horizontal"></i><span>Article</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/article">
                        <i class="bi bi-circle-fill"></i><span>List Article</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/article/create">
                        <i class="bi bi-circle-fill"></i><span>Add Article</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- End Components Nav -->
    </ul>
</aside><!-- End Sidebar-->
