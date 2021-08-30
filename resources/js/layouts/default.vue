<template>
  <div class="main-layout">
    <navbar />

    <div class="container-lg mt-4">
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
