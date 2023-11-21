<script>
  localStorage.removeItem('customer');
  window.location.href = 'home';
</script>

<?php
session_destroy();
