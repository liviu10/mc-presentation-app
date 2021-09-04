<template>
  <div class="main-layout">
    <navbar />

    <div class="container-lg">
      <child />
    </div>

    <Footer />
  </div>
</template>

<script>
import Navbar from '~/components/navbar/Navbar'
import Footer from '~/components/footer/Footer'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    Footer
  }
}
</script>
