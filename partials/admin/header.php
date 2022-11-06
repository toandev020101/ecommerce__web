<!-- header -->
<header class="header">
  <div class="badge">
    <a href="#" class="link">
      <i class='bx bx-bell header__icon'></i>
    </a>
    <span class="badge__count badge__count--primary">3</sp>
  </div>

  <div class="header__user">
    <img
      src="<?php echo $_SESSION['user']['avatar'] != 'no_avatar.jpg' ? "../uploads/" . $_SESSION['user']['avatar'] : '../assets/images/no_avatar.jpg'?>"
      alt="<?php echo $_SESSION['user']['avatar']?>" class="header__avatar">
    <span class="header__fullname">Đức Toàn</span>
  </div>
</header>
<!-- end header -->