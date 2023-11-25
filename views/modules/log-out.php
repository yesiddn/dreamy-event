<script>
  localStorage.removeItem('user');
  window.location.href = 'home';
</script>

<?php
session_destroy();
