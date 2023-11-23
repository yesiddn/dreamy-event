<script>
  localStorage.removeItem('customer');
  localStorage.removeItem('supplier');
  window.location.href = 'home';
</script>

<?php
session_destroy();
