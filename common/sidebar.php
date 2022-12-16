<?php require_once('../model/permission_declare.php');  ?>
<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
            <a href="#">
                                <img src="../assets/images/logo.png" alt="snehaenterprises">
                            </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="../view/dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <!-- <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul> -->
                        </li>
                        <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok ):?>
                        <li>
                            <a href="../view/employee-list.php">
                                <i class="far fa-check-square"></i>Employee List</a>
                        </li>
                        <?php endif ?>
                        <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_hr'] == $ok ):?>
                        <li>
                            <a href="../view/region-office-list.php">
                                <i class="far fa-check-square"></i>Regional Office</a>
                        </li>
                        <?php endif ?>
                        <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_accounts'] == $ok ):?>
                        <li>
                            <a href="../view/account-ledger.php">
                            <i class="zmdi zmdi-money"></i>Account Details</a>
                        </li>
                        <?php endif ?>
                        <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_complaint'] == $ok ):?>
                        <li>
                            <a href="../view/complaint-register.php">
                                <i class="fas fa-table"></i>Complaint Register</a>
                        </li>
                        <?php endif ?>
                        
                        <?php if($loginPermit[0]['username']==$varUserName && $loginPermit[0]['dept_store'] == $ok ):?>
                   
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Purchase Details</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="vendor-details.php">Vendor Details</a>
                                </li>
                                <li>
                                    <a href="item-modal.php">Item Modal Code</a>
                                </li>
                            <li>
                                    <a href="item-brand.php">Item Brand</a>
                                </li>
                                <li>
                                    <a href="item-name.php">Item Name</a>
                                </li>
                                                     
                            </ul>
                        </li> 
                        <li class="has-sub">                          
                            <a href="stock-inventory.php"> <i class="fas fa-copy"></i>Stock Details</a>
                        </li>
                        
                        <?php endif ?>
                        <!-- <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </aside>