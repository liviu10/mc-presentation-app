<template>
  <div class="main-layout">
    <navbar />

    <div class="container-lg">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/navbar/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
